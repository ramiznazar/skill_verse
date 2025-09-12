<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.pages.dashboard.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.dashboard.teacher.create');
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
            'skill'         => 'required|string|max:255',
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
            'skill'         => $request->skill,
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
        return view('admin.pages.dashboard.teacher.update', compact('teacher'));
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
            'skill'         => 'required|string|max:255',
            'experience'    => 'required|string|max:255',

            // NEW payout fields
            'pay_type'      => 'required|in:percentage,fixed',
            'percentage'    => 'nullable|integer|min:0|max:100',
            'fixed_salary'  => 'nullable|integer|min:0',

            'joining_date'  => 'nullable|date',
            'status'        => 'nullable|in:active,inactive',
            'notes'         => 'nullable|string',
        ]);

        // Enforce required-if manually, so `0` is allowed when intended
        if ($request->pay_type === 'percentage' && $request->percentage === null) {
            return back()->withErrors(['percentage' => 'Percentage is required when payout type is Percentage.'])->withInput();
        }
        if ($request->pay_type === 'fixed' && $request->fixed_salary === null) {
            return back()->withErrors(['fixed_salary' => 'Fixed salary is required when payout type is Fixed.'])->withInput();
        }

        $teacher = Teacher::findOrFail($id);

        // Handle Image Upload
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

        // Legacy compatibility:
        // - Your current fee submission uses $teacher->salary as %.
        // - To avoid accidental % payout for fixed teachers BEFORE you update the fee logic,
        //   set legacy 'salary' = percentage when mode = percentage, else 0.
        $legacySalary = $request->pay_type === 'percentage'
            ? (string)(int)($request->percentage ?? 0)
            : '0';

        // Update other fields
        $teacher->name          = $request->name;
        $teacher->email         = $request->email;
        $teacher->phone         = $request->phone;
        $teacher->qualification = $request->qualification;
        $teacher->skill         = $request->skill;
        $teacher->experience    = $request->experience;

        // NEW payout fields
        $teacher->pay_type      = $request->pay_type;
        $teacher->percentage    = $request->percentage !== null ? (int)$request->percentage : null;
        $teacher->fixed_salary  = $request->fixed_salary !== null ? (int)$request->fixed_salary : null;

        // Legacy column (temporary)
        $teacher->salary        = $legacySalary;

        $teacher->joining_date  = $request->joining_date;
        $teacher->status        = $request->status;
        $teacher->notes         = $request->notes;

        $teacher->save();

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
