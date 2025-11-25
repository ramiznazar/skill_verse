<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseCategory;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('courseCategory')->get();
        return view('admin.pages.website.course.all-course', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CourseCategory::all();
        return view('admin.pages.website.course.add-course', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image',
            'title' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255',
            'duration' => 'nullable|string|max:100',
            'mode' => 'nullable',
            'level' => 'nullable',
            'short_description' => 'nullable',
            'description' => 'nullable',
            'full_fee' => 'nullable|string',
            'discount' => 'nullable|string',
            'min_fee' => 'nullable|string',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $path = 'assets/admin/images/course/' . $imageName;
            $image->move(public_path('assets/admin/images/course/'), $imageName);
        }

        Course::create([
            'image' => $path,
            'title' => $request->title,
            'slug' => $request->slug,
            'course_category_id' => $request->category_id,
            'duration' => $request->duration,
            'mode' => $request->mode,
            'level' => $request->level,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'full_fee' => $request->full_fee,
            'discount' => $request->discount,
            'min_fee' => $request->min_fee,
            'is_active' => $request->is_active,
            'discount_offer' => $request->discount_offer,
            'interview_discount_per' => $request->interview_discount_per,
            'interview_discount_amount' => $request->interview_discount_amount,
        ]);

        return redirect()->route('course.index')->with('store', 'Course Added Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $course = Course::with(['courseCategory', 'outline'])->findOrFail($id);
        return view('admin.pages.website.course.view', compact('course'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::find($id);
        $categories = CourseCategory::all();
        return view('admin.pages.website.course.update-course', compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|image',
            'title' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255',
            'duration' => 'nullable|string|max:100',
            'mode' => 'nullable',
            'level' => 'nullable',
            'short_description' => 'nullable',
            'description' => 'nullable',
            'full_fee' => 'nullable|string',
            'discount' => 'nullable|string',
            'min_fee' => 'nullable|string',
        ]);

        $course = Course::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($course->image) {
                $oldImagePath = public_path($course->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $path = 'assets/admin/images/course/' . $imageName;
            $image->move(public_path('assets/admin/images/course'), $imageName);
            $course->image = $path;
        }

        $course->title = $request->title;
        $course->slug = $request->slug;
        $course->course_category_id = $request->category_id;
        $course->duration = $request->duration;
        $course->mode = $request->mode;
        $course->level = $request->level;
        $course->short_description = $request->short_description;
        $course->description = $request->description;
        $course->full_fee = $request->full_fee;
        $course->discount = $request->discount;
        $course->min_fee = $request->min_fee;
        $course->is_active = $request->is_active;
        $course->discount_offer = $request->discount_offer;
        $course->interview_discount_per = $request->interview_discount_per;
        $course->interview_discount_amount = $request->interview_discount_amount;

        $course->save();

        return redirect()->route('course.index')->with('update', 'Course Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);
        $imagePath = public_path($course->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $course->delete();
        return redirect()->route('course.index')->with('delete', 'Course deleted successfully!');
    }
}
