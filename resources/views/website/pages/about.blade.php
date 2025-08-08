@extends('website.layouts.main')
@section('content')
    <div class="main-content">

        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{asset('assets/website/images/institute/19.jpg')}}">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">About</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                {{-- <li><a href="#">Pages</a></li> --}}
                                <li class="active text-gray-silver">About</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: About -->
        <section class="">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="letter-space-4 text-gray-darkgray text-uppercase mt-0 mb-0">All About</h6>
                            <h2 class="text-uppercase font-weight-600 mt-0 font-28 line-bottom">Practical Tech Education for
                                a Better Future</h2>
                            <h4 class="text-theme-colored">Learn in-demand skills with expert trainers, hands-on projects,
                                and internship support.</h4>
                            <p>We are a modern training institute offering short-term tech courses designed to prepare
                                students for real-world success. From web development to digital marketing, our programs are
                                affordable, practical, and job-focused. Learn in a friendly, tech-driven environment with
                                career guidance every step of the way.</p>
                            <a class="btn btn-theme-colored btn-flat btn-lg mt-10 mb-sm-30" href="#">Know More →</a>

                        </div>
                        <div class="col-md-6">
                            <div class="video-popup">
                                <a href="https://www.youtube.com/watch?v=pW1uVUg5wXM" data-lightbox-gallery="youtube-video"
                                    title="Video">
                                    <img alt="" src="{{ asset('assets/website/images/institute/17.jpg') }}" class="img-responsive img-fullwidth">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Services -->
        <section id="services" class="bg-lighter">
            <div class="container">
                <div class="section-title">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-uppercase text-theme-colored title line-bottom">Our <span
                                    class="text-theme-color-2 font-weight-400">Features</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row mtli-row-clearfix">
                    <!-- Feature 1: Short Duration Courses -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="icon-box iconbox-theme-colored bg-white p-15 mb-30 border-1px">
                            <a class="icon icon-dark border-left-theme-color-2-3px pull-left flip mb-0 mr-0 mt-5">
                                <i class="pe-7s-timer"></i> <!-- Time icon -->
                            </a>
                            <div class="icon-box-details">
                                <h4 class="icon-box-title font-16 font-weight-600 m-0 mb-5">Short-Term Courses</h4>
                                <p class="text-gray font-13 mb-0">Our tech courses are designed to be completed in a short
                                    time with high impact learning.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 2: Internship Included -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="icon-box iconbox-theme-colored bg-white p-15 mb-30 border-1px">
                            <a class="icon icon-dark border-left-theme-color-2-3px pull-left flip mb-0 mr-0 mt-5">
                                <i class="pe-7s-portfolio"></i> <!-- Briefcase icon -->
                            </a>
                            <div class="icon-box-details">
                                <h4 class="icon-box-title font-16 font-weight-600 m-0 mb-5">Internship Opportunity</h4>
                                <p class="text-gray font-13 mb-0">Get hands-on experience with our internship programs
                                    included in the course.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 3: Discounted Fees -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="icon-box iconbox-theme-colored bg-white p-15 mb-30 border-1px">
                            <a class="icon icon-dark border-left-theme-color-2-3px pull-left flip mb-0 mr-0 mt-5">
                                <i class="pe-7s-cash"></i> <!-- Money icon -->
                            </a>
                            <div class="icon-box-details">
                                <h4 class="icon-box-title font-16 font-weight-600 m-0 mb-5">Affordable Fees</h4>
                                <p class="text-gray font-13 mb-0">We provide high-quality tech education at budget-friendly,
                                    discounted prices with regular promotions and offers.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 4: Friendly Environment -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="icon-box iconbox-theme-colored bg-white p-15 mb-30 border-1px">
                            <a class="icon icon-dark border-left-theme-color-2-3px pull-left flip mb-0 mr-0 mt-5">
                                <i class="pe-7s-smile"></i> <!-- Smile icon -->
                            </a>
                            <div class="icon-box-details">
                                <h4 class="icon-box-title font-16 font-weight-600 m-0 mb-5">Supportive Environment</h4>
                                <p class="text-gray font-13 mb-0">Learn in a motivating, friendly, tech-driven environment
                                    with growth and confidence.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 5: Expert Trainers -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="icon-box iconbox-theme-colored bg-white p-15 mb-30 border-1px">
                            <a class="icon icon-dark border-left-theme-color-2-3px pull-left flip mb-0 mr-0 mt-5">
                                <i class="pe-7s-id"></i> <!-- ID card icon -->
                            </a>
                            <div class="icon-box-details">
                                <h4 class="icon-box-title font-16 font-weight-600 m-0 mb-5">Industry Trainers</h4>
                                <p class="text-gray font-13 mb-0">Courses taught by experienced professionals working in the
                                    tech industry.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 6: Job Assistance -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="icon-box iconbox-theme-colored bg-white p-15 mb-30 border-1px">
                            <a class="icon icon-dark border-left-theme-color-2-3px pull-left flip mb-0 mr-0 mt-5">
                                <i class="pe-7s-global"></i> <!-- Network / globe icon -->
                            </a>
                            <div class="icon-box-details">
                                <h4 class="icon-box-title font-16 font-weight-600 m-0 mb-5">Job Support</h4>
                                <p class="text-gray font-13 mb-0">We assist students with career advice, portfolio building,
                                    and job placement help.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Divider: Funfact -->
        <section class="divider parallax layer-overlay overlay-theme-colored-9" data-bg-img="images/bg/bg2.jpg"
            data-parallax-ratio="0.7">
            <div class="container">
                <div class="row">

                    @foreach ($counters as $counter)
                        <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                            <div class="funfact text-center">
                                <i class="{{ $counter->icon_class }} mt-5 text-theme-color-2"></i>
                                <h2 data-animation-duration="2000" data-value="{{ $counter->number }}"
                                    class="animate-number text-white mt-0 font-38 font-weight-500">0
                                </h2>
                                <h5 class="text-white text-uppercase mb-0">{{ $counter->title }}</h5>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        <!-- Section: Why Choose Us -->
        <section id="event" class="">
            <div class="container pb-50">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="text-uppercase line-bottom mt-0 line-height-1"><i
                                    class="fa fa-calendar mr-10"></i>Upcoming <span
                                    class="text-theme-color-2">Events</span></h3>
                            @foreach ($upcomingEvents as $event)
                                <article class="post media-post clearfix pb-0 mb-10">
                                    <a href="#" class="post-thumb mr-20">
                                        <img alt="" src="{{ asset($event->image) }}" height="100">
                                    </a>
                                    <div class="post-right">
                                        <h4 class="mt-0 mb-5">
                                            <a href="#">{{ $event->title }}</a>
                                        </h4>
                                        <ul class="list-inline font-12 mb-5">
                                            <li class="pr-0">
                                                <i class="fa fa-calendar mr-5"></i>
                                                {{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }} |
                                            </li>
                                            <li class="pl-5">
                                                <i class="fa fa-map-marker mr-5"></i> {{ $event->address }}
                                            </li>
                                        </ul>
                                        <p class="mb-0 font-13">
                                            {{ Str::limit($event->description, 100) }}
                                        </p>
                                        <a class="text-theme-colored font-13"
                                            href="{{ route('event.detail', $event->id) }}">Read More →</a>
                                    </div>
                                </article>
                            @endforeach


                        </div>
                        <div class="col-md-6">
                            <h3 class="line-bottom mt-0 line-height-1">Why <span class="text-theme-color-2">Choose
                                    Us?</span></h3>
                            {{-- <p class="mb-10">
                                Our institute stands out by offering tech-advanced, career-focused courses with hands-on
                                training, discounted fees, and guaranteed internship opportunities — all in a fully
                                professional learning environment.
                            </p> --}}
                            <div id="accordion1" class="panel-group accordion">
                                <div class="panel">
                                    <div class="panel-title">
                                        <a class="active" data-parent="#accordion1" data-toggle="collapse"
                                            href="#accordion11" aria-expanded="true">
                                            <span class="open-sub"></span> Tech-Advanced Courses
                                        </a>
                                    </div>
                                    <div id="accordion11" class="panel-collapse collapse in" role="tablist"
                                        aria-expanded="true">
                                        <div class="panel-content">
                                            <p>We offer up-to-date and industry-relevant courses taught with the latest
                                                technologies to prepare students for real-world challenges.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel">
                                    <div class="panel-title">
                                        <a data-parent="#accordion1" data-toggle="collapse" href="#accordion12"
                                            aria-expanded="false">
                                            <span class="open-sub"></span> Short Duration Programs
                                        </a>
                                    </div>
                                    <div id="accordion12" class="panel-collapse collapse" role="tablist"
                                        aria-expanded="false">
                                        <div class="panel-content">
                                            <p>Learn more in less time. Our intensive short-term courses are perfect for
                                                students and professionals looking to skill up quickly.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel">
                                    <div class="panel-title">
                                        <a data-parent="#accordion1" data-toggle="collapse" href="#accordion13"
                                            aria-expanded="false">
                                            <span class="open-sub"></span> Discounted Fee Structure
                                        </a>
                                    </div>
                                    <div id="accordion13" class="panel-collapse collapse" role="tablist"
                                        aria-expanded="false">
                                        <div class="panel-content">
                                            <p>We believe in accessible education. Get premium training at a discounted
                                                price without compromising on quality.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel">
                                    <div class="panel-title">
                                        <a data-parent="#accordion1" data-toggle="collapse" href="#accordion14"
                                            aria-expanded="false">
                                            <span class="open-sub"></span> Fully Working Environment
                                        </a>
                                    </div>
                                    <div id="accordion14" class="panel-collapse collapse" role="tablist"
                                        aria-expanded="false">
                                        <div class="panel-content">
                                            <p>Our labs and classrooms simulate a real-world working environment to ensure
                                                hands-on, practical learning experience.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel">
                                    <div class="panel-title">
                                        <a data-parent="#accordion1" data-toggle="collapse" href="#accordion15"
                                            aria-expanded="false">
                                            <span class="open-sub"></span> Internship Opportunities
                                        </a>
                                    </div>
                                    <div id="accordion15" class="panel-collapse collapse" role="tablist"
                                        aria-expanded="false">
                                        <div class="panel-content">
                                            <p>Every student gets a chance to work on real projects during and after the
                                                course through our internship offerings.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Divider: Call To Action -->
        {{-- <section class="bg-theme-color-2">
            <div class="container pt-10 pb-20">
                <div class="row">
                    <div class="call-to-action">
                        <div class="col-md-6">
                            <h3 class="mt-5 mb-5 text-white vertical-align-middle"><i
                                    class="pe-7s-mail mr-10 font-48 vertical-align-middle"></i> SUBSCRIBE TO OUR NEWSLETTER
                            </h3>
                        </div>
                        <div class="col-md-6">
                            <!-- Mailchimp Subscription Form Starts Here -->
                            <form id="mailchimp-subscription-form" class="newsletter-form mt-10">
                                <div class="input-group">
                                    <input type="email" value="" name="EMAIL" placeholder="Your Email"
                                        class="form-control input-lg font-16" data-height="45px" id="mce-EMAIL-footer">
                                    <span class="input-group-btn">
                                        <button data-height="45px"
                                            class="btn bg-theme-colored text-white btn-xs m-0 font-14"
                                            type="submit">Subscribe</button>
                                    </span>
                                </div>
                            </form>
                            <!-- Mailchimp Subscription Form Validation-->
                            <script type="text/javascript">
                                $('#mailchimp-subscription-form').ajaxChimp({
                                    callback: mailChimpCallBack,
                                    url: '//thememascot.us9.list-manage.com/subscribe/post?u=a01f440178e35febc8cf4e51f&amp;id=49d6d30e1e'
                                });

                                function mailChimpCallBack(resp) {
                                    // Hide any previous response text
                                    var $mailchimpform = $('#mailchimp-subscription-form'),
                                        $response = '';
                                    $mailchimpform.children(".alert").remove();
                                    if (resp.result === 'success') {
                                        $response =
                                            '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                            resp.msg + '</div>';
                                    } else if (resp.result === 'error') {
                                        $response =
                                            '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                            resp.msg + '</div>';
                                    }
                                    $mailchimpform.prepend($response);
                                }
                            </script>
                            <!-- Mailchimp Subscription Form Ends Here -->
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    </div>
@endsection
