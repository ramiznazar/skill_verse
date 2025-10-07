<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TeacherAttendanceController extends Controller
{
    /**
     * 📋 Index: Filters + summary + quick actions
     */
    public function index(Request $request)
    {
        // Show only courses having teachers
        $courseIds = Teacher::whereNotNull('course_id')->distinct()->pluck('course_id')->all();
        $courses = Course::whereIn('id', $courseIds)
            ->select('id', 'title')
            ->orderBy('title')
            ->get();

        $selectedCourseId = $request->input('course_id');
        $selectedShift    = $request->input('shift');
        $date             = $request->input('date', now()->toDateString());
        $search           = trim((string) $request->input('search', ''));

        // Query teachers
        $teachersQuery = Teacher::with(['course:id,title', 'batches:id,teacher_id,title,shift'])
            ->when($selectedCourseId, fn($q) => $q->where('course_id', $selectedCourseId))
            ->when($selectedShift, fn($q) => $q->whereHas('batches', fn($b) => $b->where('shift', $selectedShift)))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($date, fn($q) => $q->whereDate('joining_date', '<=', $date))
            ->orderBy('name');

        $teachers = $teachersQuery->get(['id', 'name', 'course_id', 'joining_date']);

        // Attendance map
        $attendanceMap = collect();
        if ($teachers->isNotEmpty()) {
            $attendanceMap = TeacherAttendance::whereIn('teacher_id', $teachers->pluck('id'))
                ->whereDate('date', $date)
                ->get()
                ->keyBy('teacher_id');
        }

        // Summary
        $totalTeachers = $teachers->count();
        $totalPresents = $attendanceMap->whereIn('status', ['present', 'late'])->count();
        $totalLeaves   = $attendanceMap->where('status', 'leave')->count();
        $totalAbsents  = max(0, $totalTeachers - $totalPresents - $totalLeaves);

        return view('admin.pages.dashboard.attendance.teacher.index', [
            'courses'          => $courses,
            'teachers'         => $teachers,
            'attendances'      => $attendanceMap,
            'selectedCourseId' => $selectedCourseId,
            'selectedShift'    => $selectedShift,
            'date'             => $date,
            'search'           => $search,
            'totalTeachers'    => $totalTeachers,
            'totalPresents'    => $totalPresents,
            'totalLeaves'      => $totalLeaves,
            'totalAbsents'     => $totalAbsents,
        ]);
    }

    /**
     * 🔘 Quick mark buttons
     */
    public function markPresent(Request $request)
    {
        $result = $this->setStatus($request, 'present');
        return $this->respond($request, 'present', $result);
    }

    public function markAbsent(Request $request)
    {
        $result = $this->setStatus($request, 'absent');
        return $this->respond($request, 'absent', $result);
    }

    public function markLeave(Request $request)
    {
        $result = $this->setStatus($request, 'leave');
        return $this->respond($request, 'leave', $result);
    }

    public function markLate(Request $request)
    {
        $result = $this->setStatus($request, 'late');
        return $this->respond($request, 'late', $result);
    }

    /**
     * 🧩 Reusable attendance setter
     */
    protected function setStatus(Request $request, string $status)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'date'       => 'required|date',
            'remarks'    => 'nullable|string|max:255',
        ]);

        $teacher = Teacher::findOrFail($request->teacher_id);

        // Prevent marking before joining date
        if ($teacher->joining_date && Carbon::parse($request->date)->lt(Carbon::parse($teacher->joining_date))) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Cannot mark before joining date.'], 422);
            }
            return back()->with('error', 'Cannot mark before joining date.');
        }

        TeacherAttendance::updateOrCreate(
            ['teacher_id' => $teacher->id, 'date' => $request->date],
            ['status' => $status, 'remarks' => $request->remarks]
        );

        return true;
    }

    /**
     * 🔄 Unified response for AJAX / normal form
     */
    protected function respond(Request $request, string $status, $result)
    {
        if ($request->ajax()) {
            if ($result !== true && isset($result['error'])) {
                return response()->json(['error' => $result['error']], 422);
            }
            return response()->json(['status' => $status]);
        }
        return back()->with('success', 'Attendance updated!');
    }

    /**
     * ✅ Bulk mark all present (no AJAX)
     */
    public function bulkMarkPresent(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'date'      => 'required|date',
            'shift'     => 'nullable|in:morning,evening',
        ]);

        $teachers = Teacher::when($request->course_id, fn($q) => $q->where('course_id', $request->course_id))
            ->when($request->shift, fn($q) => $q->whereHas('batches', fn($b) => $b->where('shift', $request->shift)))
            ->whereDate('joining_date', '<=', $request->date)
            ->get(['id']);

        if ($teachers->isEmpty()) {
            return back()->with('success', 'No teachers match this filter.');
        }

        $existing = TeacherAttendance::whereIn('teacher_id', $teachers->pluck('id'))
            ->whereDate('date', $request->date)
            ->pluck('id', 'teacher_id');

        $toCreate = $teachers->filter(fn($t) => !isset($existing[$t->id]));

        foreach ($toCreate as $t) {
            TeacherAttendance::create([
                'teacher_id' => $t->id,
                'date'       => $request->date,
                'status'     => 'present',
                'remarks'    => null,
            ]);
        }

        return back()->with('success', 'All unmarked teachers set to Present.');
    }

    /**
     * 🗓️ Monthly history view
     */
    public function history(Request $request, Teacher $teacher)
    {
        $month = (int) $request->get('month', now()->month);
        $year  = (int) $request->get('year', now()->year);

        $selectedFirst = Carbon::createFromDate($year, $month, 1);
        $joining       = $teacher->joining_date ? Carbon::parse($teacher->joining_date) : null;

        // If selected month is before joining month
        if ($joining && $selectedFirst->lt($joining->startOfMonth())) {
            return view('admin.pages.dashboard.attendance.teacher.history', [
                'teacher'       => $teacher->load('course:id,title', 'batches:id,teacher_id,title,shift'),
                'attendances'   => collect(),
                'month'         => $month,
                'year'          => $year,
                'daysInMonth'   => 0,
                'joinedTooLate' => true,
            ]);
        }

        $attendances = TeacherAttendance::where('teacher_id', $teacher->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get()
            ->keyBy(fn($a) => Carbon::parse($a->date)->day);

        $days = Carbon::createFromDate($year, $month, 1)->daysInMonth;

        return view('admin.pages.dashboard.attendance.teacher.history', [
            'teacher'       => $teacher->load('course:id,title', 'batches:id,teacher_id,title,shift'),
            'attendances'   => $attendances,
            'month'         => $month,
            'year'          => $year,
            'daysInMonth'   => $days,
            'joinedTooLate' => false,
        ]);
    }
}
