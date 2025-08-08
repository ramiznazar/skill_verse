<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GallaryCategory;

class GallaryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = GallaryCategory::all();
        return view('admin.pages.website.gallary-image.gallary-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.website.gallary-image.gallary-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable',
        ]);
        GallaryCategory::create([
            'title' => $request->title,
        ]);
        return redirect()->route('gallary-category.index')->with('store', 'Gallary Category Added Successfully');
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
        $category = GallaryCategory::find($id);
        return view('admin.pages.website.gallary-image.gallary-category.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'nullable',
        ]);
        $category = GallaryCategory::find($id);
        $category->title = $request->title;
        $category->save();
        return redirect()->route('gallary-category.index')->with('update', 'Gallary Category Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = GallaryCategory::find($id);
        $category->delete();
        return redirect()->route('gallary-category.index')->with('delete','Gallary Category Deleted Successfully');
    }
}
