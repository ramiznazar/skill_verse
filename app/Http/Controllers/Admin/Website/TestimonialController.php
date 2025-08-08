<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.pages.website.testimonial.all-testimonial',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.website.testimonial.add-testimonial');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'    => 'nullable|image',
            'name'    => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:255',
        ]);
        $path = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName =  time() . '.' . $image->getClientOriginalName();
            $path = 'assets/admin/images/code/testimonial/' . $imageName ; //Define path for store
            //$image = $request->file('image)
            $image->move(public_path('assets/admin/images/code/testimonial/'),$imageName);
        }
        Testimonial::create([
            'image' => $path,
            'name' => $request->name,
            'designation' => $request->designation,
            'message' => $request->message,
        ]);
        return redirect()->route('testimonial.index')->with('store','Feedback Added Successfully');
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
        $testimonial = Testimonial::find($id);
        return view('admin.pages.website.testimonial.update-testimonial',compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image'    => 'nullable|image',
            'name'    => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:255',
        ]);
        $testimonial = Testimonial::find($id);
        //Delete old Image if user insert new one
        if($request->hasFile('image')){
            if($testimonial->image){
                $oldImagePath = public_path($testimonial->image);
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
            }
            //Store new Image
            $image = $request->file('image');
            $imageName =   time() . '.' . $image->getClientOriginalName();
            $path = 'assets/admin/images/code/testimonial/' . $imageName;
            $image->move(public_path('assets/admin/images/code/testimonial'),$imageName);
            
            //store in database
            $testimonial->image = $path;
        }
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->message = $request->message;
        $testimonial->save();
        return redirect()->route('testimonial.index')->with('update','Feedback Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::find($id); 
  
        $imagePath = public_path( $testimonial->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    
        $testimonial->delete();
    return redirect()->route('testimonial.index')->with('delete', 'Testimonial deleted successfully!');
    }
}
