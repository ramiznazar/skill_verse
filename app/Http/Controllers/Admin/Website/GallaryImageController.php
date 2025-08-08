<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\GallaryCategory;
use App\Models\GallaryImage;

class GallaryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleryImages = GallaryImage::with('gallaryCategory')->latest()->get();
        return view('admin.pages.website.gallary-image.index', compact('galleryImages'));
    }

    public function create()
    {
        $categories = GallaryCategory::all();
        return view('admin.pages.website.gallary-image.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gallary_category_id' => 'nullable|exists:gallary_categories,id',
            'images.*' => 'nullable|image'
        ]);

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/admin/images/code/gallary-image/'), $filename);
                $imagePaths[] = 'assets/admin/images/code/gallary-image/' . $filename;
            }
        }

        GallaryImage::create([
            'gallary_category_id' => $request->gallary_category_id,
            'images' => $imagePaths
        ]);

        return response()->json(['success' => true, 'message' => 'Images uploaded successfully!']);
    }

    public function edit($id)
    {
        $image = GallaryImage::findOrFail($id);
        $categories = GallaryCategory::all();
        return view('admin.pages.website.gallary-image.update', compact('image', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $imageRecord = GallaryImage::findOrFail($id);

        $request->validate([
            'gallary_category_id' => 'nullable|exists:gallary_categories,id',
            'images.*' => 'nullable|image'
        ]);

        $data = [
            'gallary_category_id' => $request->gallary_category_id
        ];

        // If new images are uploaded, replace the old ones
        if ($request->hasFile('images')) {
            // Delete old images
            if ($imageRecord->images && is_array($imageRecord->images)) {
                foreach ($imageRecord->images as $oldImage) {
                    if (File::exists(public_path($oldImage))) {
                        File::delete(public_path($oldImage));
                    }
                }
            }

            // Upload new images
            $newImagePaths = [];
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/admin/images/code/gallary-image/'), $filename);
                $newImagePaths[] = 'assets/admin/images/code/gallary-image/' . $filename;
            }

            $data['images'] = $newImagePaths;
        }

        $imageRecord->update($data);

        return redirect()->route('gallary-image.index')->with('update', 'Image updated successfully!');
    }


    public function destroy($id)
    {
        $image = GallaryImage::findOrFail($id);

        // Delete all associated image files
        if ($image->images && is_array($image->images)) {
            foreach ($image->images as $imgPath) {
                if (File::exists(public_path($imgPath))) {
                    File::delete(public_path($imgPath));
                }
            }
        }
        // Delete the DB record
        $image->delete();

        return redirect()->route('gallary-image.index')->with('delete', 'Image deleted successfully!');
    }
}
