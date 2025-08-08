<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::with(['course', 'teacher'])->get();
        return view('admin.pages.dashboard.batch.index', compact('batches'));
    }

    public function create()
    {
        $courses = Course::all();
        $teachers = Teacher::where('status', 'active')->get();
        return view('admin.pages.dashboard.batch.create', compact('courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'    => 'required|exists:courses,id',
            'teacher_id'   => 'required|exists:teachers,id',
            'title'        => 'nullable|string|max:255',
            'timing'       => 'nullable|string|max:255',
            'shift'        => 'required|in:morning,evening,night',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'status'       => 'required',
            'capacity'     => 'nullable|integer|min:0',
            'note'        => 'nullable|string',
        ]);

        Batch::create($request->all());

        return redirect()->route('batch.index')->with('store', 'Batch created successfully.');
    }

    public function edit(string $id)
    {
        $batch = Batch::findOrFail($id);
        $courses = Course::all();
        $teachers = Teacher::where('status', 'active')->get();
        return view('admin.pages.dashboard.batch.update', compact('batch', 'courses', 'teachers'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'course_id'    => 'required|exists:courses,id',
            'teacher_id'   => 'required|exists:teachers,id',
            'title'        => 'nullable|string|max:255',
            'timing'       => 'nullable|string|max:255',
            'shift'        => 'required|in:morning,evening,night',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'status'       => 'required',
            'capacity'     => 'nullable|integer|min:0',
            'note'        => 'nullable|string',
        ]);

        $batch = Batch::findOrFail($id);
        $batch->update($request->all());

        return redirect()->route('batch.index')->with('update', 'Batch updated successfully.');
    }

    public function destroy(string $id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();

        return redirect()->route('batch.index')->with('delete', 'Batch deleted successfully.');
    }

    public function getByCourse($id)
    {
        $batches = Batch::with('course')
            ->where('course_id', $id)
            ->get();

        return response()->json($batches);
    }
}
