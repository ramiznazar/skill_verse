<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\PopularCourse;

class BlogController extends Controller
{
    public function blog(){
        $blogs = Blog::latest()->paginate(3);
        $popularCourses = PopularCourse::all();
        return view('website.pages.blog.blog',compact('blogs','popularCourses'));
    }
}
