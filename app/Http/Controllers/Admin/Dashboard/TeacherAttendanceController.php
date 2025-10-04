<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Batch;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TeacherAttendanceController extends Controller
{
    public function index(Request $request)
    {
        // Only show courses that have teachers
        $courseIds = Teacher::whereNotNull('course_id')->distinct()->pluck('course_id')->all();
        $courses = Course::whereIn('id', $courseIds)->select('id', 'title')->orderBy('title')->get();

        // Optional shift filter (by teacher's batches)
        $selectedCourseId = $request->input('course_id');
        $selectedShift = $request->input('shift'); // morning | evening (optional)
        $date = $request->input('date', now()->toDateString());
        $search = trim((string) $request->input('search', ''));

        $teachersQuery = Teacher::with(['course:id,title', 'batches:id,teacher_id,title,shift'])
            ->when($selectedShift, fn($q) => $q->whereHas('batches', fn($b) => $b->where('shift', $selectedShift)))
            ->when($selectedShift, fn($q) => $q->whereHas('batches', fn($b) => $b->where('shift', $selectedShift)))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            // ✅ joining date rule
            ->when($date, fn($q) => $q->whereDate('joining_date', '<=', $date))
            ->orderBy('name');

        $teachers = $teachersQuery->get(['id', 'name', 'course_id', 'joining_date']);

        // Attendance map for selected date
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
        $totalLeaves = $attendanceMap->where('status', 'leave')->count();
        $totalAbsents = max(0, $totalTeachers - $totalPresents - $totalLeaves);

        return view('admin.pages.dashboard.attendance.teacher.index', [
            'courses' => $courses,
            'teachers' => $teachers,
            'attendances' => $attendanceMap,
            'selectedCourseId' => $selectedCourseId,
            'selectedShift' => $selectedShift,
            'date' => $date,
            'search' => $search,
            'totalTeachers' => $totalTeachers,
            'totalPresents' => $totalPresents,
            'totalLeaves' => $totalLeaves,
            'totalAbsents' => $totalAbsents,
        ]);
    }

    // Quick actions
    public function markPresent(Request $request)
    {
        return $this->setStatus($request, 'present');
    }
    public function markAbsent(Request $request)
    {
        return $this->setStatus($request, 'absent');
    }
    public function markLeave(Request $request)
    {
        return $this->setStatus($request, 'leave');
    }
    public function markLate(Request $request)
    {
        return $this->setStatus($request, 'late');
    }

    protected function setStatus(Request $request, string $status)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'date' => 'required|date',
            'remarks' => 'nullable|string|max:255',
        ]);

        // Joining date guard: do not mark before joining date
        $teacher = Teacher::findOrFail($request->teacher_id);
        if ($teacher->joining_date && Carbon::parse($request->date)->lt(Carbon::parse($teacher->joining_date))) {
            return back()->with('success', 'Cannot mark before joining date.');
        }

        TeacherAttendance::updateOrCreate(
            ['teacher_id' => $teacher->id, 'date' => $request->date],
            ['status' => $status, 'remarks' => $request->remarks]
        );

        return back()->with('success', 'Attendance updated!');
    }

    // Bulk present (optional; only creates missing records)
    public function bulkMarkPresent(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'shift' => 'nullable|in:morning,evening',
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
                'date' => $request->date,
                'status' => 'present',
                'remarks' => null,
            ]);
        }

        return back()->with('success', 'All unmarked teachers set to Present.');
    }

    // History (month view)
    public function history(Request $request, Teacher $teacher)
    {
        $month = (int) $request->get('month', now()->month);
        $year = (int) $request->get('year', now()->year);

        // joining date guard
        $selectedFirst = Carbon::createFromDate($year, $month, 1);
        $joining = $teacher->joining_date ? Carbon::parse($teacher->joining_date) : null;

        if ($joining && $selectedFirst->lt($joining->startOfMonth())) {
            return view('admin.pages.dashboard.attendance.teacher.history', [
                'teacher' => $teacher->load('course:id,title', 'batches:id,teacher_id,title,shift'),
                'attendances' => collect(),
                'month' => $month,
                'year' => $year,
                'daysInMonth' => 0,
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
            'teacher' => $teacher->load('course:id,title', 'batches:id,teacher_id,title,shift'),
            'attendances' => $attendances,
            'month' => $month,
            'year' => $year,
            'daysInMonth' => $days,
            'joinedTooLate' => false,
        ]);
    }
}
