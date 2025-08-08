<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.pages.website.banner.all-banner', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.website.banner.add-banner');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'        => 'nullable|image',
            'main_title'   => 'nullable|string|max:255',
            'title'        => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'transition'   => 'nullable|string|max:255',
            'position'     => 'nullable|in:left,center,right',
            'button_text'  => 'nullable|string|max:255',
            'button_link'  => 'nullable|string' 
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = 'assets/admin/images/code/banner/' . $imageName;
            $image->move(public_path('assets/admin/images/code/banner/'), $imageName);
        }

        Banner::create([
            'image'        => $path,
            'main_title'   => $request->main_title,
            'title'        => $request->title,
            'description'  => $request->description,
            'transition'   => $request->transition,
            'position'     => $request->position,
            'button_text'  => $request->button_text,
            'button_link'  => $request->button_link,
        ]);

        return redirect()->route('banner.index')->with('store', 'Banner Added Successfully');
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
        $banner = Banner::find($id);
        return view('admin.pages.website.banner.update-banner', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image'    => 'nullable|image',
            'title'    => 'nullable|string|max:255',
            'main_title'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);
        $banner = Banner::find($id);
        //Delete old Image if user insert new one
        if ($request->hasFile('image')) {
            if ($banner->image) {
                $oldImagePath = public_path($banner->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            //Store new Image
            $image = $request->file('image');
            $imageName =   time() . '.' . $image->getClientOriginalName();
            $path = 'assets/admin/images/code/banner/' . $imageName;
            $image->move(public_path('assets/admin/images/code/banner'), $imageName);

            //store in database
            $banner->image = $path;
        }
        $banner->main_title = $request->main_title;
        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->save();
        return redirect()->route('banner.index')->with('update', 'Banner Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        $imagePath = public_path($banner->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $banner->delete();
        return redirect()->route('banner.index')->with('delete', 'Banner deleted successfully!');
    }
}
