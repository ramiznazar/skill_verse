<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDiscussion;
use App\Models\EventLink;
use App\Models\EventParticipant;
use App\Models\PopularCourse;

class EventController extends Controller
{
    public function event()
    {
        $events = Event::all();
        $popularCourses = PopularCourse::all();
        return view('website.pages.event.event', compact('events', 'popularCourses'));
    }
    public function eventDetail($id)
    {
        $event = Event::find($id);
        $popularCourses = PopularCourse::all();
        $discussions = EventLink::where('event_id',$id)->get();
        $socialLinks = EventLink::where('event_id', $id)->get();
        $participants = EventParticipant::where('event_id',$id)->get();
        return view('website.pages.event.event-detail', compact( 'event','socialLinks','participants','popularCourses'));
    }
}
