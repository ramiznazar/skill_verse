<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseLms;

class CourseLmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($course_id)
    {
        $course = Course::findOrFail($course_id);
        $courseLms = CourseLms::with('course')->where('course_id', $course_id)->get();
        return view('admin.pages.website.course.course-lms.index', compact('course', 'courseLms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('admin.pages.website.course.course-lms.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $course_id)
    {
        $request->validate([
            'price' => 'nullable',
            'duration' => 'nullable',
            'lecture' => 'nullable',
            'video_duration' => 'nullable',
        ]);
        CourseLms::create([
            'course_id' => $course_id,
            'price' => $request->price,
            'duration' => $request->duration,
            'lecture' => $request->lecture,
            'video_duration' => $request->video_duration
        ]);
        return redirect()->route('course-lms.index', compact('course_id'))->with('store', 'LMS Course Store Successfully');
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
    public function edit($course_id, $id)
    {
        $course = Course::find($course_id);
        $lms = CourseLms::find($id);
        return view('admin.pages.website.course.course-lms.update', compact('course','lms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $course_id, $id)
    {
        $request->validate([
            'price' => 'nullable',
            'duration' => 'nullable',
            'lecture' => 'nullable',
            'video_duration' => 'nullable',
        ]);
        $lms = CourseLms::findOrFail($id);
        $lms->update([
            'course_id' => $course_id,
            'price' => $request->price,
            'duration' => $request->duration,
            'lecture' => $request->lecture,
            'video_duration' => $request->video_duration,
        ]);
        return redirect()->route('course-lms.index',compact('course_id'))->with('update','LMS Course Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lms = CourseLms::find($id);
        $lms->delete();
        return redirect()->back()->with('delete', 'LMS Course deleted successfully!');
    }
}
