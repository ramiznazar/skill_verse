<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Course;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    /**
     * 📋 Index: filters + summary + quick action buttons (Present / Absent / Leave / Late)
     */
    public function index(Request $request)
    {
        // Filters
        $courses      = Course::select('id','title')->orderBy('title')->get();
        $selectedCourseId = $request->input('course_id');
        $selectedShift    = $request->input('shift');     // "morning" / "evening"
        $date             = $request->input('date', now()->toDateString());
        $search           = trim((string) $request->input('search', ''));

        // Pull admissions (students) by Course + Shift (+ optional search)
        $admissionsQuery = Admission::with(['course:id,title', 'batch:id,title,shift'])
            ->when($selectedCourseId, fn($q) => $q->where('course_id', $selectedCourseId))
            ->when($selectedShift, function ($q) use ($selectedShift) {
                $q->whereHas('batch', fn($b) => $b->where('shift', $selectedShift));
            })
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('name', 'like', "%{$search}%")
                       ->orWhere('phone', 'like', "%{$search}%")
                       ->orWhere('guardian_name', 'like', "%{$search}%");
                });
            })
            ->orderBy('name');

        // Get all admissions matching filter (we keep it simple + fast for action table)
        $admissions = $admissionsQuery->get(['id','name','course_id','batch_id']);

        // Attendance keyed by admission for the selected date
        $attendanceMap = collect();
        if ($admissions->isNotEmpty()) {
            $attendanceMap = StudentAttendance::whereIn('admission_id', $admissions->pluck('id'))
                ->whereDate('date', $date)
                ->get()
                ->keyBy('admission_id');
        }

        // Summary cards
        $totalStudents  = $admissions->count();
        $totalPresents  = $attendanceMap->whereIn('status', ['present','late'])->count(); // late counts as present
        $totalLeaves    = $attendanceMap->where('status', 'leave')->count();
        $totalAbsents   = max(0, $totalStudents - $totalPresents - $totalLeaves);

        return view('admin.pages.dashboard.attendance.student.index', [
            'courses'         => $courses,
            'admissions'      => $admissions,
            'attendances'     => $attendanceMap, // keyed by admission_id
            'selectedCourseId'=> $selectedCourseId,
            'selectedShift'   => $selectedShift,
            'date'            => $date,
            'search'          => $search,
            'totalStudents'   => $totalStudents,
            'totalPresents'   => $totalPresents,
            'totalLeaves'     => $totalLeaves,
            'totalAbsents'    => $totalAbsents,
        ]);
    }

    /**
     * 🔘 Helpers to set status for a single student
     */
    public function markPresent(Request $request) { return $this->setStatus($request, 'present'); }
    public function markAbsent(Request $request)  { return $this->setStatus($request, 'absent');  }
    public function markLeave(Request $request)   { return $this->setStatus($request, 'leave');   }
    public function markLate(Request $request)    { return $this->setStatus($request, 'late');    }

    protected function setStatus(Request $request, string $status)
    {
        $request->validate([
            'admission_id' => 'required|exists:admissions,id',
            'date'         => 'required|date',
        ]);

        $admission = Admission::with('batch:id')->findOrFail($request->admission_id);
        $teacherId = Auth::id();

        StudentAttendance::updateOrCreate(
            ['admission_id' => $admission->id, 'date' => $request->date],
            [
                'batch_id'   => $admission->batch_id,
                'teacher_id' => $teacherId,
                'status'     => $status,
                'remarks'    => $request->input('remarks') ?: null,
            ]
        );

        return back()->with('success', 'Attendance updated!');
    }

    /**
     * ✅ Bulk mark ALL filtered students as present (only those without a record yet)
     */
    public function bulkMarkPresent(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'shift'     => 'required|in:morning,evening',
            'date'      => 'required|date',
        ]);

        $teacherId = Auth::id();

        // Pull admissions matching filters
        $admissions = Admission::where('course_id', $request->course_id)
            ->whereHas('batch', fn($b) => $b->where('shift', $request->shift))
            ->get(['id','batch_id']);

        if ($admissions->isEmpty()) {
            return back()->with('success', 'No students found for this filter.');
        }

        // Existing attendance map for that date
        $existing = StudentAttendance::whereIn('admission_id', $admissions->pluck('id'))
            ->whereDate('date', $request->date)
            ->pluck('id','admission_id');

        // Only create for students WITHOUT existing record
        $toCreate = $admissions->filter(fn($a) => !isset($existing[$a->id]));

        foreach ($toCreate as $adm) {
            StudentAttendance::create([
                'admission_id' => $adm->id,
                'batch_id'     => $adm->batch_id,
                'teacher_id'   => $teacherId,
                'date'         => $request->date,
                'status'       => 'present',
                'remarks'      => null,
            ]);
        }

        return back()->with('success', 'All unmarked students set to Present for selected filter.');
    }
}
