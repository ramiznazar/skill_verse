<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseOutline;
use App\Models\CourseLms;
use App\Models\PopularCourse;

class CourseController extends Controller
{
    public function course(Request $request)
    {
        // NEW: read query params for server-side filtering
        $categoryId = $request->query('category'); // e.g. ?category=3
        $q = $request->query('q');        // e.g. ?q=react

        // Base query
        $coursesQuery = Course::with('courseCategory');

        if (!empty($categoryId)) {
            $coursesQuery->where('course_category_id', $categoryId);
        }

        if (!empty($q)) {
            $coursesQuery->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('short_description', 'like', "%{$q}%");
            });
        }

        // Keep filters in pagination links
        $courses = $coursesQuery->where('is_active', 1)->latest()->paginate(6)->withQueryString();

        // Keep your existing "withCount('course')" naming to match $category->course_count in Blade
        // (Optionally filter counts by search text, but NOT by category so user sees total per category for that search)
        $categories = CourseCategory::withCount([
            'course' => function ($q2) use ($q) {
                $q2->where('is_active', 1); // ✅ only active
                if (!empty($q)) {
                    $q2->where(function ($sub) use ($q) {
                        $sub->where('title', 'like', "%{$q}%")
                            ->orWhere('short_description', 'like', "%{$q}%");
                    });
                }
            }
        ])->get();

        $popularCourses = PopularCourse::all();
        $generativeAi = Course::where('title', 'Generative Ai')->first();
        $freelancing = Course::where('title', 'Freelancing')->first();
        $development = Course::where('title', 'Web Development')->first();

        // Pass current filters to view for active state + preserving on search
        return view(
            'website.pages.course.course',
            compact('courses', 'categories', 'popularCourses', 'generativeAi', 'freelancing', 'development', 'categoryId', 'q')
        );
    }

    public function courseDetail($slug)
    {
        $popularCourses = PopularCourse::all();
        $course = Course::with('courseCategory')->where('slug', $slug)->firstOrFail();
        // Use course id for relations
        $courseOutlines = CourseOutline::where('course_id', $course->id)->get();
        $lmsCourses = CourseLms::where('course_id', $course->id)->get();
        $courses = Course::all();
        $categories = CourseCategory::all();
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
