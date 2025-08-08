<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PopularCourse;

class PopularCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = PopularCourse::all();
        return view('admin.pages.website.popular-course.all-course',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.website.popular-course.add-course');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'    => 'nullable|image',
            'title'    => 'nullable|string|max:255',
        ]);
        $path = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName =  time() . '.' . $image->getClientOriginalName();
            $path = 'assets/admin/images/code/popular-course/' . $imageName ; //Define path for store
            //$image = $request->file('image)
            $image->move(public_path('assets/admin/images/code/popular-course/'),$imageName);
        }
        PopularCourse::create([
            'image' => $path,
            'title' => $request->title,
        ]);
        return redirect()->route('popular-course.index')->with('store','Course Added Successfully');
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
        $course = PopularCourse::find($id);
        return view('admin.pages.website.popular-course.update-course',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image'    => 'nullable|image',
            'title'    => 'nullable|string|max:255',
        ]);
        $course = PopularCourse::find($id);
        //Delete old Image if user insert new one
        if($request->hasFile('image')){
            if($course->image){
                $oldImagePath = public_path($course->image);
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
            }
            //Store new Image
            $image = $request->file('image');
            $imageName =   time() . '.' . $image->getClientOriginalName();
            $path = 'assets/admin/images/code/popular-course/' . $imageName;
            $image->move(public_path('assets/admin/images/code/popular-course'),$imageName);
            
            //store in database
            $course->image = $path;
        }
        $course->title = $request->title;
        $course->save();
        return redirect()->route('popular-course.index')->with('update','Course Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = PopularCourse::find($id); 
        $imagePath = public_path( $course->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $course->delete();
    return redirect()->route('popular-course.index')->with('delete', 'Course deleted successfully!');
    }
}
