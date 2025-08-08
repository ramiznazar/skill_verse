<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Event;
use App\Models\Counter;
use App\Models\PopularCourse;

class AboutController extends Controller
{
    public function about()
    {
        $feedbacks = Testimonial::all();
        $counters = Counter::all();
        $popularCourses = PopularCourse::all();
        $upcomingEvents = Event::whereDate('date', '>=', Carbon::today())
            ->orderBy('date')
            ->take(3)
            ->get();
        return view('website.pages.about', compact('feedbacks', 'counters', 'popularCourses', 'upcomingEvents'));
    }
}
