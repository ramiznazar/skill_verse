<?php

namespace App\Http\Controllers\Website;

use App\Models\Blog;
use App\Models\Event;
use App\Models\Banner;
use App\Models\Course;
use App\Models\Counter;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\GallaryImage;
use Illuminate\Http\Request;
use App\Models\PopularCourse;
use App\Models\GallaryCategory;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $popularCourses = PopularCourse::all();
        $banners = Banner::all();
        $courses = Course::with('courseCategory')->latest()->get();
        $feedbacks = Testimonial::all();
        $events = Event::all();
        $blogs = Blog::all();
        $projects = Project::latest()->get();
        $counters = Counter::all();
        $categories = GallaryCategory::all();
        $galleryImages = GallaryImage::with('gallaryCategory')->get();
        return view('website.index', compact('courses', 'feedbacks', 'banners', 'blogs', 'popularCourses', 'events', 'projects', 'counters','categories','galleryImages'));
    }
}
