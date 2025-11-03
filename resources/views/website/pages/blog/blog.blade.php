@extends('website.layouts.main')
@section('content')
    <div class="main-content">

        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
            data-bg-img="{{ asset('assets/website/images/institute/12.jpg') }}">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Blog</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                {{-- <li><a href="#">Pages</a></li> --}}
                                <li class="active text-gray-silver">Blogs</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container mt-30 mb-30 pt-30 pb-30">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="blog-posts">
                            <div class="col-md-12">
                                <div class="row list-dashed">

                                    @foreach ($blogs as $blog)
                                        <article class="post clearfix mb-30 pb-30">
                                            @if ($blog->image)
                                                <div class="entry-header">
                                                    <div class="post-thumb thumb">
                                                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                                                            class="img-responsive img-fullwidth"
                                                            style="height: 400px !important;">
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="entry-content border-1px p-20 pr-10">
                                                <div class="entry-meta media mt-0 no-bg no-border">
                                                    <div
                                                        class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                                        @php
                                                            $date = \Carbon\Carbon::parse($blog->date);
                                                        @endphp
                                                        <ul>
                                                            <li class="font-16 text-white font-weight-600">
                                                                {{ $date->format('d') }}
                                                            </li>
                                                            <li class="font-12 text-white text-uppercase">
                                                                {{ $date->format('M') }}
                                                            </li>
                                                        </ul>

                                                    </div>
                                                    <div class="media-body pl-15">
                                                        <div class="event-content pull-left flip">
                                                            <h4 class="entry-title text-white text-uppercase m-0 mt-5">
                                                                <a href="#">{{ $blog->title }}</a>
                                                            </h4>

                                                            <span class="mb-10 text-gray-darkgray mr-10 font-13">
                                                                <i
                                                                    class="fa fa-thumbs-up mr-5 text-theme-colored"></i>{{ $blog->best_for }}
                                                            </span>

                                                            @if ($blog->duration)
                                                                <span class="mb-10 text-gray-darkgray mr-10 font-13">
                                                                    <i
                                                                        class="fa fa-clock mr-5 text-theme-colored"></i>{{ $blog->duration }}
                                                                </span>
                                                            @endif

                                                            <span class="mb-10 text-gray-darkgray mr-10 font-13">
                                                                <i
                                                                    class="fa fa-certificate mr-5 text-theme-colored"></i>Certified
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <p class="mt-10">
                                                    {{ $blog->description }}
                                                </p>

                                                <div class="clearfix"></div>
                                            </div>
                                        </article>
                                    @endforeach

                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="col-md-12 text-left">
                                    {{ $blogs->links('pagination::bootstrap-4') }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
