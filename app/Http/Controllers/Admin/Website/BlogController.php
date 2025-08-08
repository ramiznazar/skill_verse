<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.pages.website.blog.all-blog', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.website.blog.add-blog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'       => 'nullable|image',
            'title'       => 'nullable|string|max:255',
            'date'        => 'nullable|date',
            'best_for'    => 'nullable|string|max:255',
            'duration'    => 'nullable|string|max:100',
            'is_certified' => 'nullable|boolean',
            'description' => 'nullable|string',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $path = 'assets/admin/images/code/blog/' . $imageName; // Define path for storage
            $image->move(public_path('assets/admin/images/code/blog'), $imageName);
        }
        Blog::create([
            'image'       => $path,
            'title'       => $request->title,
            'date'        => $request->date,
            'best_for'    => $request->best_for,
            'duration'    => $request->duration,
            'is_certified' => $request->is_certified ?? 1, //select 1 if is default
            'description' => $request->description,
        ]);

        return redirect()->route('blog.index')->with('store', 'Post Added Successfully');
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
        $blog = Blog::find($id);
        return view('admin.pages.website.blog.update-blog', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image'       => 'nullable|image',
            'title'       => 'nullable|string|max:255',
            'date'        => 'nullable|date',
            'best_for'    => 'nullable|string|max:255',
            'duration'    => 'nullable|string|max:100',
            'is_certified' => 'nullable|boolean',
            'description' => 'nullable|string',
        ]);
        $blog = Blog::find($id);
        //Delete old Image if user insert new one
        if ($request->hasFile('image')) {
            if ($blog->image) {
                $oldImagePath = public_path($blog->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            //Store new Image
            $image = $request->file('image');
            $imageName =   time() . '.' . $image->getClientOriginalName();
            $path = 'assets/admin/images/code/blog/' . $imageName;
            $image->move(public_path('assets/admin/images/code/blog'), $imageName);
            //store in database
            $blog->image = $path;
        }
        $blog->title = $request->title;
        $blog->date = $request->date;
        $blog->best_for = $request->best_for;
        $blog->duration = $request->duration;
        $blog->is_certified = $request->is_certified;
        $blog->description = $request->description;
        $blog->save();
        return redirect()->route('blog.index')->with('update', 'Blog Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);
        $imagePath = public_path($blog->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $blog->delete();
        return redirect()->route('blog.index')->with('delete', 'Blog deleted successfully!');
    }
}
