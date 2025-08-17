<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseOutline;

class CourseOutlineController extends Controller
{
    /**
     * Display a listing of the outlines for a specific course.
     */
    public function index($course_id)
    {
        $course = Course::findOrFail($course_id);
        $outlines = CourseOutline::where('course_id', $course_id)->get();
        return view('admin.pages.website.course.course-outline.index', compact('course', 'outlines'));
    }

    /**
     * Show the form for creating a new outline for a course.
     */
    public function create($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('admin.pages.website.course.course-outline.create', compact('course'));
    }

    /**
     * Store a newly created course outline.
     */
    public function store(Request $request, $course_id)
    {
        $request->validate([
            'week' => 'required|string|max:255',
            'topics' => 'required|array',
            'topics.*.topic' => 'required|string|max:255',
            'topics.*.time' => 'nullable|string|max:255',
        ]);

        CourseOutline::create([
            'course_id' => $course_id,
            'week' => $request->week,
            'topics' => $request->topics, // JSON column
        ]);

        return redirect()->route('course-outline.index', $course_id)->with('store', 'Course Outline added successfully!');
    }

    /**
     * Show the form for editing an existing outline.
     */
    public function edit($course_id, $id)
    {
        $course = Course::findOrFail($course_id);
        $outline = CourseOutline::findOrFail($id);
        return view('admin.pages.website.course.course-outline.update', compact('outline', 'course'));
    }

    /**
     * Update the specified course outline.
     */
    public function update(Request $request, $course_id, $id)
    {
        $request->validate([
            'week' => 'required|string|max:255',
            'topics' => 'required|array',
            'topics.*.topic' => 'required|string|max:255',
            'topics.*.time' => 'nullable|string|max:255',
        ]);

        $outline = CourseOutline::findOrFail($id);
        $outline->update([
            'course_id' => $course_id,
            'week' => $request->week,
            'topics' => $request->topics,
        ]);

        return redirect()->route('course-outline.index', $course_id)->with('update', 'Course Outline updated successfully!');
    }

    /**
     * Remove the specified course outline.
     */
    public function destroy($id)
    {
        $outline = CourseOutline::findOrFail($id);
        $outline->delete();

        return redirect()->back()->with('delete', 'Course Outline deleted successfully!');
    }
}
