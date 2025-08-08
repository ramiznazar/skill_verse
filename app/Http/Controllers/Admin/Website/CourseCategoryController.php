<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseCategory;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CourseCategory::all();
        return view('admin.pages.website.course.course-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.website.course.course-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable',
        ]);
        CourseCategory::create([
            'name' => $request->name,
        ]);
        return redirect()->route('course-category.index')->with('store', 'Course Category Added Successfully');
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
        $category = CourseCategory::find($id);
        return view('admin.pages.website.course.course-category.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'nullable',
        ]);
        $category = CourseCategory::find($id);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('course-category.index')->with('update', 'Course Category Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CourseCategory::find($id);
        $category->delete();
        return redirect()->route('course-category.index')->with('delete','Course Category Deleted Successfully');
    }
}
