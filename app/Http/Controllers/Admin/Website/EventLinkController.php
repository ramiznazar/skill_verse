<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventLink;

class EventLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($event_id)
    {
        $event = Event::findOrFail($event_id);
        $links = EventLink::with('event')->where('event_id', $event_id)->get();
        return view('admin.pages.website.event.event-link.index', compact('event', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($event_id)
    {
        $event = Event::findOrFail($event_id);
        return view('admin.pages.website.event.event-link.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $event_id)
    {
        $request->validate([
            'title' => 'nullable',
            'link' => 'nullable',
        ]);
        EventLink::create([
            'event_id' => $event_id,
            'title' => $request->title,
            'link' => $request->link,
        ]);
        return redirect()->route('event-link.index', compact('event_id'))->with('store', 'Event Link Added Successfully ');
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
    public function edit($event_id, $id)
    {
        $event = Event::findOrFail($event_id);
        $link = EventLink::findOrFail($id);
        return view('admin.pages.website.event.event-link.update', compact('event', 'link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $event_id, $id)
    {
         $request->validate([
            'title' => 'nullable',
            'link' => 'nullable',
        ]);
        $link = EventLink::findOrFail($id);
        $link->update([
            'event_id' => $event_id,
            'title' => $request->title,
            'link' => $request->link,
        ]);
        return redirect()->route('event-link.index', compact('event_id'))->with('update', 'Event Link Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link = EventLink::findOrFail($id);
        $link->delete();
        return redirect()->back()->with('delete', 'Event Link Deleted Successfully');
    }
}
