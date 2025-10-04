<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\TeacherSalary;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('course')->get();
        return view('admin.pages.dashboard.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::orderBy('title')->get(['id', 'title']);
        return view('admin.pages.dashboard.teacher.create',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|unique:teachers,email',
            'phone'         => 'required|string|max:20',
            'qualification' => 'nullable|string|max:255',
            'course_id'     => 'required|exists:courses,id',
            'experience'    => 'required|string|max:255',

            // NEW payout fields
            'pay_type'      => 'required|in:percentage,fixed',
            'percentage'    => 'nullable|integer|min:0|max:100',   // required if pay_type=percentage (see below)
            'fixed_salary'  => 'nullable|integer|min:0',           // required if pay_type=fixed (see below)

            'joining_date'  => 'nullable|date',
            'status'        => 'nullable|in:active,inactive',
            'notes'         => 'nullable|string',
        ]);

        // Enforce required-if rules manually (so 0 is allowed when intended)
        if ($request->pay_type === 'percentage' && $request->percentage === null) {
            return back()->withErrors(['percentage' => 'Percentage is required when payout type is Percentage.'])->withInput();
        }
        if ($request->pay_type === 'fixed' && $request->fixed_salary === null) {
            return back()->withErrors(['fixed_salary' => 'Fixed salary is required when payout type is Fixed.'])->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'assets/admin/images/code/teacher/' . $imageName;
            $image->move(public_path('assets/admin/images/code/teacher/'), $imageName);
        }

        // Legacy compatibility:
        // - Your current fee submission uses $teacher->salary as %.
        // - To AVOID wrong payouts for fixed teachers before we update that logic,
        //   we will set legacy 'salary' = percentage only for percentage mode; otherwise 0.
        $legacySalary = $request->pay_type === 'percentage'
            ? (string)(int)($request->percentage ?? 0)
            : '0';

        Teacher::create([
            'image'         => $imagePath,
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'qualification' => $request->qualification,
            'course_id'     => $request->course_id,
            'experience'    => $request->experience,

            // NEW fields
            'pay_type'      => $request->pay_type,
            'percentage'    => $request->percentage !== null ? (int)$request->percentage : null,
            'fixed_salary'  => $request->fixed_salary !== null ? (int)$request->fixed_salary : null,

            // Legacy column kept for now (will remove after fee logic update)
            'salary'        => $legacySalary,

            'joining_date'  => $request->joining_date,
            'status'        => $request->status ?? 'active',
            'notes'         => $request->notes,
        ]);

        return redirect()->route('teacher.index')->with('store', 'Teacher added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $courses = Course::orderBy('title')->get(['id', 'title']);
        return view('admin.pages.dashboard.teacher.update', compact('teacher','courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|unique:teachers,email,' . $id,
            'phone'         => 'required|string|max:20',
            'qualification' => 'nullable|string|max:255',
            'course_id'     => 'required|exists:courses,id',
            'experience'    => 'required|string|max:255',

            // payout fields
            'pay_type'      => 'required|in:percentage,fixed',
            'percentage'    => 'nullable|integer|min:0|max:100',
            'fixed_salary'  => 'nullable|integer|min:0',

            'joining_date'  => 'nullable|date',
            'status'        => 'nullable|in:active,inactive',
            'notes'         => 'nullable|string',
        ]);

        // Required-if checks (allow 0)
        if ($request->pay_type === 'percentage' && $request->percentage === null) {
            return back()->withErrors(['percentage' => 'Percentage is required when payout type is Percentage.'])->withInput();
        }
        if ($request->pay_type === 'fixed' && $request->fixed_salary === null) {
            return back()->withErrors(['fixed_salary' => 'Fixed salary is required when payout type is Fixed.'])->withInput();
        }

        $teacher = Teacher::findOrFail($id);

        // Image upload
        if ($request->hasFile('image')) {
            if ($teacher->image) {
                $oldImagePath = public_path($teacher->image);
                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }
            $image      = $request->file('image');
            $imageName  = time() . '.' . $image->getClientOriginalExtension();
            $imagePath  = 'assets/admin/images/code/teacher/' . $imageName;
            $image->move(public_path('assets/admin/images/code/teacher/'), $imageName);
            $teacher->image = $imagePath;
        }

        // Legacy safety: keep old 'salary' (used as %) only for percentage mode
        $legacySalary = $request->pay_type === 'percentage'
            ? (string)(int)($request->percentage ?? 0)
            : '0';

        // Update fields
        $teacher->name          = $request->name;
        $teacher->email         = $request->email;
        $teacher->phone         = $request->phone;
        $teacher->qualification = $request->qualification;
        $teacher->course_id     = $request->course_id;
        $teacher->experience    = $request->experience;

        // New payout fields
        $teacher->pay_type      = $request->pay_type;
        $teacher->percentage    = $request->percentage !== null ? (int)$request->percentage : null;
        $teacher->fixed_salary  = $request->fixed_salary !== null ? (int)$request->fixed_salary : null;

        // legacy column
        $teacher->salary        = $legacySalary;

        $teacher->joining_date  = $request->joining_date;
        $teacher->status        = $request->status;
        $teacher->notes         = $request->notes;

        $teacher->save();

        /* ------------------- SYNC CURRENT MONTH SNAPSHOT ------------------- */
        // Create or update the current month's UNPAID salary row so the salary table reflects changes immediately
        /* ------------------- SYNC CURRENT MONTH SNAPSHOT ------------------- */
        $month = now()->month;
        $year  = now()->year;

        // Create or update the current month row for this teacher
        $row = TeacherSalary::firstOrNew([
            'teacher_id' => $teacher->id,
            'month'      => $month,
            'year'       => $year,
        ]);

        // If row is already closed, don't rewrite history
        if (!in_array(strtolower($row->status ?? 'unpaid'), ['paid', 'balance'], true)) {

            // Initialize if new
            if (!$row->exists) {
                $row->status                      = 'unpaid';
                $row->total_fee_collected         = 0;
                $row->total_students              = 0;
                $row->salary_amount               = 0;
                $row->computed_percentage_amount  = 0;
                $row->computed_fixed_amount       = 0;
            }

            // Snapshot latest teacher settings
            $row->pay_type   = $teacher->pay_type ?? 'percentage';
            $row->percentage = (int) ($teacher->percentage ?? (is_numeric($teacher->salary) ? $teacher->salary : 0)); // legacy fallback

            // Recompute both amounts using current totals
            $collected          = (int) ($row->total_fee_collected ?? 0);
            $computedPercentage = (int) round($collected * ($row->percentage / 100));
            $computedFixed      = (int) ($teacher->fixed_salary ?? 0);

            $row->computed_percentage_amount = $computedPercentage;
            $row->computed_fixed_amount      = $computedFixed;

            // Payable according to updated pay_type
            $row->salary_amount = $row->pay_type === 'fixed'
                ? $computedFixed
                : $computedPercentage;

            $row->save();
        }
        /* ----------------- END SYNC CURRENT MONTH SNAPSHOT ----------------- */

        /* ----------------- END SYNC CURRENT MONTH SNAPSHOT ----------------- */

        return redirect()->route('teacher.index')->with('update', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::find($id);
        $imagePath = public_path($teacher->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $teacher->delete();
        return redirect()->route('teacher.index')->with('delete', 'Course deleted successfully!');
    }
}
