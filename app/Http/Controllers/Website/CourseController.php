<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseOutline;
use App\Models\CourseLms;
use App\Models\PopularCour

class CourseController extends Controller
{
    public function course()
    {
        $courses = Course::with('courseCategory')->latest()->paginate(6);
        $categories = CourseCategory::withCount('course')->get();
        $popularCourses = PopularCourse::all();
       $generativeAi = Course::where('title', 'Generative Ai')->first();
       $freelancing = Course::where('title','Freelancing')->first();
       $development = Course::where('title','Web Development')->first();
        return view('website.pages.course.course', compact('courses', 'categories', 'popularCourses','generativeAi','freelancing','development'));
    }
    public function courseDetail($id)
    {
        $popularCourses = PopularCourse::all();
        $course = Course::with('courseCategory')->findOrFail($id);
        $courseOutlines = CourseOutline::where('course_id', $id)->get();
        $courses = Course::all();
        $categories = CourseCategory::all();
        $lmsCourses = CourseLms::where('course_id', $id)->get();
        return view('website.pages.course.course-detail', compact('popularCourses', 'course', 'courses', 'categories', 'courseOutlines', 'lmsCourses'));
    }
    public function ajaxSearch(Request $request)
    {
        $query = $request->input('query');

        $courses = Course::where('title', 'like', "%$query%")
            ->orWhere('short_description', 'like', "%$query%")
            ->get();

        if ($courses->isEmpty()) {
            return '<p>No courses found.</p>';
        }

        $html = '<ul>';
        foreach ($courses as $course) {
            $html .= '<li>' . e($course->title) . '</li>';
        }
        $html .= '</ul>';

        return $html;
    }
}
