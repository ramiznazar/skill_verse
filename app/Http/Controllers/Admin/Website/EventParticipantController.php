<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventParticipant;

class EventParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($event_id)
    {
        $event = Event::findOrFail($event_id);
        $participants = EventParticipant::with('event')->where('event_id', $event_id)->get();
        return view('admin.pages.website.event.event-participant.index', compact('event', 'participants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($event_id)
    {
        $event = Event::findOrFail($event_id);
        return view('admin.pages.website.event.event-participant.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $event_id)
    {
        $request->validate([
            'image' => 'nullable|image',
            'name' => 'nullable|string|max:255',
            'post' => 'nullable|string|max:255',
        ]);
        $path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName =  time() . '.' . $image->getClientOriginalName();
            $path = 'assets/admin/images/code/event-participant/' . $imageName; //Define path for store
            $image->move(public_path('assets/admin/images/code/event-participant/'), $imageName);
        }
        EventParticipant::create([
            'event_id' => $event_id,
            'image' => $path,
            'name' => $request->name,
            'post' => $request->post,
        ]);
        return redirect()->route('event-participant.index', $event_id)->with('store', 'Event Participant Added Successfully');
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
    public function edit(string $event_id, $id)
    {
        $event = Event::findOrFail($event_id);
        $participant = EventParticipant::findOrFail($id);
        return view('admin.pages.website.event.event-participant.update', compact('event', 'participant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $event_id, $id)
    {
        $request->validate([
            'image' => 'nullable|image',
            'name' => 'nullable|string|max:255',
            'post' => 'nullable|string|max:255',
        ]);
        $participant = EventParticipant::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($participant->image) {
                $oldImagePath = public_path($participant->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            //Store new Image
            $image = $request->file('image');
            $imageName =   time() . '.' . $image->getClientOriginalName();
            $path = 'assets/admin/images/code/event-participant/' . $imageName;
            $image->move(public_path('assets/admin/images/code/event-participant/'), $imageName);

            $participant->image = $path;
        }
        $participant->event_id = $event_id;
        $participant->name = $request->name;
        $participant->post = $request->post;
        $participant->save();
        return redirect()->route('event-participant.index', compact('event_id'))->with('update', 'Event Participant Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $participant = EventParticipant::find($id);
        $imagePath = public_path($participant->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $participant->delete();
        return redirect()->back()->with('delete', 'Event Participant Deleted Successfully');
    }
}
