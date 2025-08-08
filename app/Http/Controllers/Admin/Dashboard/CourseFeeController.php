<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseFee;

class CourseFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fees = CourseFee::with('course')->get();
        return view('admin.pages.dashboard.course-fee.index', compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.pages.dashboard.course-fee.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'full_fee' => 'required|string',
            'installment_1' => 'nullable|string',
            'installment_2' => 'nullable|string',
            'installment_3' => 'nullable|string',
        ]);

        CourseFee::create($validated);

        return redirect()->route('course-fee.index')->with('store', 'Fee structure added successfully.');
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
        $courses = Course::all();
        $courseFee = CourseFee::findOrFail($id);
        return view('admin.pages.dashboard.course-fee.update', compact('courses','courseFee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'full_fee' => 'required|string',
            'installment_1' => 'nullable|string',
            'installment_2' => 'nullable|string',
            'installment_3' => 'nullable|string',
        ]);

        $fee = CourseFee::findOrFail($id);
        $fee->update($validated);

        return redirect()->route('course-fee.index')->with('update', 'Fee structure updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fee = CourseFee::findOrFail($id);
        $fee->delete();
        return redirect()->back()->with('delete','Fee Structure Deleted Successfully');
    }
}
