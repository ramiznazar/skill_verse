@extends('website.layouts.main')
@section('content')
    <div class="main-content bg-lighter">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
            data-bg-img="{{ asset('assets/website/images/institute/15.jpg') }}">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Courses</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                {{-- <li><a href="#">Pages</a></li> --}}
                                <li class="active text-gray-silver">Courses</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Course gird -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-9 blog-pull-right">
                        <div class="row">

                            @foreach ($courses as $course)
                                <div class="col-sm-6 col-md-4 course-card"
                                    data-category-id="{{ $course->course_category_id }}">
                                    <div class="service-block bg-white">
                                        <div class="thumb">
                                            <img alt="featured project" src="{{ $course->image }}"
                                                style="width:100%; height:190px; object-fit:cover;">
                                        </div>
                                        <div class="content text-left flip p-25 pt-0">
                                            <h4 class="line-bottom mb-10">{{ $course->title }}</h4>
                                            <p>{{ \Illuminate\Support\Str::words($course->short_description, 20, '...') }}
                                            </p>
                                            <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10"
                                                href="{{ route('course.detail', $course->id) }}">view details</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="sidebar sidebar-left mt-sm-30">
                            <div class="widget">
                                <h5 class="widget-title line-bottom">Search <span class="text-theme-color-2">Courses</span>
                                </h5>
                                <div class="search-form">
                                    {{-- UPDATED: make search a GET form and preserve selected category --}}
                                    <form method="GET" action="{{ route('course') }}">
                                        @if (!empty($categoryId))
                                            <input type="hidden" name="category" value="{{ $categoryId }}">
                                        @endif
                                        <div class="input-group">
                                            <input type="text" id="course-search" name="q"
                                                value="{{ $q ?? '' }}" placeholder="Click to Search"
                                                class="form-control search-input">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn search-button"><i
                                                        class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="widget">
                                <h5 class="widget-title line-bottom">Course <span
                                        class="text-theme-color-2">Categories</span></h5>
                                <div class="categories">
                                    <ul class="list list-border angle-double-right">
                                        {{-- NEW: "All" link --}}
                                        <li>
                                            <a href="{{ route('course', array_filter(['q' => $q ?? null])) }}"
                                                class="{{ empty($categoryId) ? 'active-category' : '' }}">
                                                All
                                                <span>({{ $categories->sum('course_count') }})</span>
                                            </a>
                                        </li>

                                        @foreach ($categories as $category)
                                            <li>
                                                {{-- UPDATED: real link with GET param; preserves current search text --}}
                                                <a href="{{ route('course', array_filter(['category' => $category->id, 'q' => $q ?? null])) }}"
                                                    class="{{ isset($categoryId) && (int) $categoryId === (int) $category->id ? 'active-category' : '' }}">
                                                    {{ $category->name }}
                                                    <span>({{ $category->course_count }})</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                            <div class="widget">
                                <h5 class="widget-title line-bottom">Popular<span class="text-theme-color-2">Courses</span>
                                </h5>
                                {{-- (kept commented block exactly as you had it) --}}
                                 <div class="latest-posts">

                                    <article class="post media-post clearfix pb-0 mb-10">
                                        <a class="post-thumb" href="{{ route('course.detail', $generativeAi->id) }}"><img
                                                src="{{ $generativeAi->image }}" alt="" height="70"
                                                width="70"></a>
                                        <div class="post-right">
                                            <h5 class="post-title mt-0"><a
                                                    href="{{ route('course.detail', $generativeAi->id) }}">{{ $generativeAi->title }}</a>
                                            </h5>
                                            <p style="font-size: 10px; margin-top: -10px ">
                                                {{ \Illuminate\Support\Str::words($generativeAi->short_description, 14, '...') }}
                                            </p>
                                        </div>
                                    </article>
                                    <article class="post media-post clearfix pb-0 mb-10">
                                        <a class="post-thumb" href="{{ route('course.detail', $freelancing->id) }}"><img
                                                src="{{ $freelancing->image }}" alt="" height="70"
                                                width="70"></a>
                                        <div class="post-right">
                                            <h5 class="post-title mt-0"><a
                                                    href="{{ route('course.detail', $freelancing->id) }}">{{ $freelancing->title }}</a>
                                            </h5>
                                            <p style="font-size: 10px; margin-top: -10px ">
                                                {{ \Illuminate\Support\Str::words($freelancing->short_description, 14, '...') }}
                                            </p>
                                        </div>
                                    </article>
                                    <article class="post media-post clearfix pb-0 mb-10">
                                        <a class="post-thumb" href="{{ route('course.detail', $development->id) }}"><img
                                                src="{{ $development->image }}" alt="" height="70"
                                                width="70"></a>
                                        <div class="post-right">
                                            <h5 class="post-title mt-0"><a
                                                    href="{{ route('course.detail', $development->id) }}">{{ $development->title }}</a>
                                            </h5>
                                            <p style="font-size: 10px; margin-top: -10px ">
                                                {{ \Illuminate\Support\Str::words($development->short_description, 14, '...') }}
                                            </p>
                                        </div>
                                    </article>

                                </div>
                            </div>
                            {{-- (kept Flickr widget commented as you had it) --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-md-12 text-left">
                            {{-- Pagination already keeps query string via controller --}}
                            {{ $courses->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('additional-javascript')
    {{-- REMOVED: client-side category filter JS (it conflicted with pagination) --}}
    {{-- You can keep the live search JS if you like; it only filters the current page visually. --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('course-search');
            const courseCards = document.querySelectorAll('.course-card');

            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();

                courseCards.forEach(card => {
                    const title = card.querySelector('h4').textContent.toLowerCase();
                    const description = card.querySelector('p').textContent.toLowerCase();

                    const matches = title.includes(query) || description.includes(query);

                    card.style.display = matches ? 'block' : 'none';
                });
            });
        });
    </script>

    <style>
        .active-category {
            font-weight: bold;
            color: #007bff;
        }
    </style>
@endsection
