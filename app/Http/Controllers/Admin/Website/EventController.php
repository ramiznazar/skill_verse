<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\CourseCategory;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('courseCategory')->get();
        return view('admin.pages.website.event.all-event', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CourseCategory::all();
        return view('admin.pages.website.event.add-event', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'              => 'nullable|image',
            'additional_images.*' => 'nullable|image', // validate each file
            'title'              => 'nullable|string|max:255',
            'map'                => 'nullable|string',
            'date'               => 'nullable|date',
            'address'            => 'nullable|string|max:255',
            'start_time'         => 'nullable|string|max:100',
            'end_time'           => 'nullable|string|max:100',
            'description'        => 'nullable|string',
            'topics'             => 'nullable|string',
            'speakers'           => 'nullable|string',
            'audience'           => 'nullable|string',
            'quote'              => 'nullable|string',
            'quote_by'           => 'nullable|string|max:255',
        ]);

        // Store main image
        $path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = 'assets/admin/images/code/event/' . $imageName;
            $image->move(public_path('assets/admin/images/code/event/'), $imageName);
        }

        // Store additional images
        $additionalImages = [];
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $index => $file) {
                $fileName = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/admin/images/code/event/'), $fileName);
                $additionalImages[] = $fileName;
            }
        }

        // Create event
        Event::create([
            'image'             => $path,
            'additional_images' => json_encode($additionalImages),
            'title'             => $request->title,
            'date'              => $request->date,
            'start_time'        => $request->start_time,
            'end_time'          => $request->end_time,
            'map'               => $request->map,
            'address'           => $request->address,
            'description'       => $request->description,
            'topics'            => $request->topics,
            'speakers'          => $request->speakers,
            'audience'          => $request->audience,
            'quote'             => $request->quote,
            'quote_by'          => $request->quote_by,
        ]);

        return redirect()->route('event.index')->with('store', 'Event Added Successfully');
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
        $event = Event::find($id);
        $categories = CourseCategory::all();
        return view('admin.pages.website.event.update-event', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image'                => 'nullable|image',
            'additional_images.*'  => 'nullable|image',
            'title'                => 'nullable|string|max:255',
            'map'                  => 'nullable|string',
            'date'                 => 'nullable|date',
            'address'              => 'nullable|string|max:255',
            'start_time'           => 'nullable|string|max:100',
            'end_time'             => 'nullable|string|max:100',
            'description'          => 'nullable|string',
            'topics'               => 'nullable|string',
            'speakers'             => 'nullable|string',
            'audience'             => 'nullable|string',
            'quote'                => 'nullable|string',
            'quote_by'             => 'nullable|string|max:255',
        ]);

        $event = Event::findOrFail($id);

        // Update main image
        if ($request->hasFile('image')) {
            if ($event->image && file_exists(public_path($event->image))) {
                unlink(public_path($event->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = 'assets/admin/images/code/event/' . $imageName;
            $image->move(public_path('assets/admin/images/code/event/'), $imageName);
            $event->image = $path;
        }

        // Update additional images (append to existing ones)
        $existingImages = $event->additional_images ? json_decode($event->additional_images, true) : [];

        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $index => $file) {
                $fileName = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/admin/images/code/event/'), $fileName);
                $existingImages[] = $fileName;
            }

            $event->additional_images = json_encode($existingImages);
        }

        // Update other fields
        $event->title        = $request->title;
        $event->start_time   = $request->start_time;
        $event->end_time     = $request->end_time;
        $event->date         = $request->date;
        $event->map          = $request->map;
        $event->address      = $request->address;
        $event->description  = $request->description;
        $event->topics       = $request->topics;
        $event->speakers     = $request->speakers;
        $event->audience     = $request->audience;
        $event->quote        = $request->quote;
        $event->quote_by     = $request->quote_by;

        $event->save();

        return redirect()->route('event.index')->with('update', 'Event Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);

        // Delete main image
        if ($event->image) {
            $imagePath = public_path($event->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete additional images
        if ($event->additional_images) {
            $additionalImages = json_decode($event->additional_images, true);
            foreach ($additionalImages as $imageFile) {
                $imagePath = public_path('assets/admin/images/code/event/' . $imageFile);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        // Delete event record
        $event->delete();

        return redirect()->route('event.index')->with('delete', 'Event deleted successfully!');
    }
}
