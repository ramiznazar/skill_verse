@extends('website.layouts.main')
@section('content')
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
            data-bg-img="{{ asset('assets/website/images/institute/15.jpg') }}">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Course Details</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                {{-- <li><a href="#">Pages</a></li> --}}
                                <li class="active text-gray-silver">Course Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Blog -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 blog-pull-right">
                        <div class="single-service">
                            <img src="{{ asset($course->image) }}" alt=""
                                style="width: 100%; max-height: 400px; object-fit: cover;">
                            <h3 class="text-theme-colored line-bottom text-theme-colored">{{ $course->title }}</h3>
                            <h4 class="mt-0"><span class="text-theme-color-2">Duration :</span> {{ $course->duration }}
                            </h4>
                            {{-- <ul class="review_text list-inline">
                                <li>
                                    <div class="star-rating" title="Rated 4.50 out of 5"><span
                                            style="width: 90%;">4.50</span></div>
                                </li>
                            </ul> --}}
                            <h5>{{ $course->description }}</p>
                                <h4 class="line-bottom mt-20 mb-20 text-theme-colored">Course Outline</h4>

                                @if ($courseOutlines->isNotEmpty())
                                    <ul id="myTab" class="nav nav-tabs boot-tabs tabs-inline">
                                        @foreach ($courseOutlines as $index => $outline)
                                            <li class="{{ $index === 0 ? 'active' : '' }}">
                                                <a href="#week{{ $index }}"
                                                    data-toggle="tab">{{ $outline->week }}</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div id="myTabContent" class="tab-content">
                                        @foreach ($courseOutlines as $index => $outline)
                                            <div class="tab-pane fade {{ $index === 0 ? 'in active' : '' }}"
                                                id="week{{ $index }}">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td colspan="2"
                                                                class="text-center font-16 font-weight-600 bg-theme-color-2 text-white">
                                                                {{ $outline->title }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Topics</th>
                                                            {{-- <th>Time</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($outline->topics as $topic)
                                                            <tr>
                                                                <td>{!! $topic['topic'] !!}</td>
                                                                {{-- <td>{{ $topic['time'] }}  min</td> --}}
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>No course outline available yet.</p>
                                @endif

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="sidebar sidebar-left mt-sm-30 ml-40">
                            <div class="widget">
                                <h4 class="widget-title line-bottom">Courses <span class="text-theme-color-2">List</span>
                                </h4>
                                <div class="services-list">
                                    <ul class="list list-border angle-double-right">
                                        @foreach ($courses as $item)
                                            <li class="{{ $item->id == $course->id ? 'active' : '' }}">
                                                <a href="{{ route('course.detail', $item->id) }}">{{ $item->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="widget">
                                <h4 class="widget-title line-bottom">Course <span
                                        class="text-theme-color-2">Information</span>
                                </h4>
                                <div class="opening-hours">
                                    <ul class="list-border">
                                        <li class="clearfix"> <span> Duration : </span>
                                            <div class="value pull-right"> {{ $course->duration }} </div>
                                        </li>
                                        <li class="clearfix"> <span> Level :</span>
                                            <div class="value pull-right"> {{ $course->level }} </div>
                                        </li>
                                        <li class="clearfix"> <span> Mode : </span>
                                            <div class="value pull-right"> {{ $course->mode }} </div>
                                        </li>
                                        <li class="clearfix"> <span> Certified : </span>
                                            <div class="value pull-right"> Yes </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget">
                                {{-- <h4 class="widget-title line-bottom">Quick <span class="text-theme-color-2">Contact</span>
                                </h4>
                                <form id="quick_contact_form_sidebar" name="footer_quick_contact_form"
                                    class="quick-contact-form" action="includes/quickcontact.php" method="post">
                                    <div class="form-group">
                                        <input name="form_email" class="form-control" type="text" required=""
                                            placeholder="Enter Email">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="form_message" class="form-control" required="" placeholder="Enter Message" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input name="form_botcheck" class="form-control" type="hidden" value="" />
                                        <button type="submit"
                                            class="btn btn-theme-colored btn-flat btn-xs btn-quick-contact text-white pt-5 pb-5"
                                            data-loading-text="Please wait...">Send Message</button>
                                    </div>
                                </form> --}}

                                <!-- Quick Contact Form Validation-->
                                <script type="text/javascript">
                                    $("#quick_contact_form_sidebar").validate({
                                        submitHandler: function(form) {
                                            var form_btn = $(form).find('button[type="submit"]');
                                            var form_result_div = '#form-result';
                                            $(form_result_div).remove();
                                            form_btn.before(
                                                '<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>'
                                            );
                                            var form_btn_old_msg = form_btn.html();
                                            form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                                            $(form).ajaxSubmit({
                                                dataType: 'json',
                                                success: function(data) {
                                                    if (data.status == 'true') {
                                                        $(form).find('.form-control').val('');
                                                    }
                                                    form_btn.prop('disabled', false).html(form_btn_old_msg);
                                                    $(form_result_div).html(data.message).fadeIn('slow');
                                                    setTimeout(function() {
                                                        $(form_result_div).fadeOut('slow')
                                                    }, 6000);
                                                }
                                            });
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
