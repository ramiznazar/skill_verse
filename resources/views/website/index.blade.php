@extends('website.layouts.main')
@section('content')
    <div class="main-content">

        <!-- Section: home -->
        <section id="home">
            <div class="container-fluid p-0">

                <!-- Slider Revolution Start -->
                <div class="rev_slider_wrapper">
                    <div class="rev_slider" data-version="5.0">
                        <ul>

                            <!-- SLIDE 1 -->
                            <li data-index="rs-1" data-transition="slidingoverlayhorizontal" data-slotamount="default"
                                data-easein="default" data-easeout="default" data-masterspeed="default"
                                data-thumb="{{ asset('assets/website/images/bg/bg3.jpg') }}" data-rotate="0"
                                data-saveperformance="off" data-title="Slide 1" data-description="">
                                <!-- MAIN IMAGE -->
                                <img src="{{ asset('assets/website/images/bg/bg3.jpg') }}" alt=""
                                    data-bgposition="center 10%" data-bgfit="cover" data-bgrepeat="no-repeat"
                                    class="rev-slidebg" data-bgparallax="10" data-no-retina>
                                <!-- LAYERS -->

                                <!-- LAYER NR. 1 -->
                                <div class="tp-caption tp-resizeme text-uppercase text-white font-raleway" id="rs-1-layer-1"
                                    data-x="['left']" data-hoffset="['30']" data-y="['middle']" data-voffset="['-110']"
                                    data-fontsize="['100']" data-lineheight="['110']" data-width="none" data-height="none"
                                    data-whitespace="nowrap" data-transform_idle="o:1;s:500"
                                    data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                    data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
                                    data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                    style="z-index: 7; white-space: nowrap; font-weight:700;"><span
                                        style="font-size: 90px;">Learn & Grow</span>
                                </div>

                                <!-- LAYER NR. 2 -->
                                <div class="tp-caption tp-resizeme text-uppercase text-white font-raleway bg-theme-colored-transparent border-left-theme-color-2-6px pl-20 pr-20"
                                    id="rs-1-layer-2" data-x="['left']" data-hoffset="['35']" data-y="['middle']"
                                    data-voffset="['-25']" data-fontsize="['35']" data-lineheight="['54']" data-width="none"
                                    data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;s:500"
                                    data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                    data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
                                    data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                    style="z-index: 7; white-space: nowrap; font-weight:600;">Education For
                                    Everyone
                                </div>

                                <!-- LAYER NR. 3 -->
                                <div class="tp-caption tp-resizeme text-white" id="rs-1-layer-3" data-x="['left']"
                                    data-hoffset="['35']" data-y="['middle']" data-voffset="['35']" data-fontsize="['16']"
                                    data-lineheight="['28']" data-width="none" data-height="none" data-whitespace="nowrap"
                                    data-transform_idle="o:1;s:500" data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                    data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1400"
                                    data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                    style="z-index: 5; white-space: nowrap; letter-spacing:0px; font-weight:400;">
                                    Short-term tech courses, expert trainers, real internships & career growth<br>
                                    all in one place — your future starts here.
                                </div>

                                <!-- LAYER NR. 4 -->
                                <div class="tp-caption tp-resizeme" id="rs-1-layer-4" data-x="['left']"
                                    data-hoffset="['35']" data-y="['middle']" data-voffset="['100']" data-width="none"
                                    data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;"
                                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                    data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1400"
                                    data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                    style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a
                                        class="btn btn-colored btn-lg btn-flat btn-theme-colored border-left-theme-color-2-6px pl-20 pr-20"
                                        href="{{ route('course') }}">View Details</a>
                                </div>
                            </li>

                            <!-- SLIDE 2 -->
                            <li data-index="rs-2" data-transition="slidingoverlayhorizontal" data-slotamount="default"
                                data-easein="default" data-easeout="default" data-masterspeed="default"
                                data-thumb="{{ asset('assets/website/images/bg/bg2.jpg') }}" data-rotate="0"
                                data-saveperformance="off" data-title="Slide 2" data-description="">
                                <!-- MAIN IMAGE -->
                                <img src="{{ asset('assets/website/images/bg/bg2.jpg') }}" alt=""
                                    data-bgposition="center 40%" data-bgfit="cover" data-bgrepeat="no-repeat"
                                    class="rev-slidebg" data-bgparallax="10" data-no-retina>
                                <!-- LAYERS -->

                                <!-- LAYER NR. 1 -->
                                <div class="tp-caption tp-resizeme text-uppercase  bg-dark-transparent-5 text-white font-raleway border-left-theme-color-2-6px border-right-theme-color-2-6px pl-30 pr-30"
                                    id="rs-2-layer-1" data-x="['center']" data-hoffset="['0']" data-y="['middle']"
                                    data-voffset="['-90']" data-fontsize="['28']" data-lineheight="['54']"
                                    data-width="none" data-height="none" data-whitespace="nowrap"
                                    data-transform_idle="o:1;s:500" data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                    data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
                                    data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                    style="z-index: 7; white-space: nowrap; font-weight:400; border-radius: 30px;">
                                    Learn Practical Skills
                                </div>

                                <!-- LAYER NR. 2 -->
                                <div class="tp-caption tp-resizeme text-uppercase bg-theme-colored-transparent text-white font-raleway pl-30 pr-30"
                                    id="rs-2-layer-2" data-x="['center']" data-hoffset="['0']" data-y="['middle']"
                                    data-voffset="['-20']" data-fontsize="['46']" data-lineheight="['70']"
                                    data-width="none" data-height="none" data-whitespace="nowrap"
                                    data-transform_idle="o:1;s:500" data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                    data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
                                    data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                    style="z-index: 7; white-space: nowrap; font-weight:700; border-radius: 30px;">
                                    Internship + Job Preparation
                                </div>

                                <!-- LAYER NR. 3 -->
                                <div class="tp-caption tp-resizeme text-white text-center" id="rs-2-layer-3"
                                    data-x="['center']" data-hoffset="['0']" data-y="['middle']" data-voffset="['50']"
                                    data-fontsize="['16']" data-lineheight="['28']" data-width="none" data-height="none"
                                    data-whitespace="nowrap" data-transform_idle="o:1;s:500"
                                    data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                    data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1400"
                                    data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                    style="z-index: 5; white-space: nowrap; letter-spacing:0px; font-weight:400;">
                                    Enroll in hands-on tech courses with real projects, career guidance,<br>
                                    and internship support — everything you need to succeed in today’s job market.
                                </div>

                                <!-- LAYER NR. 4 -->
                                <div class="tp-caption tp-resizeme" id="rs-2-layer-4" data-x="['center']"
                                    data-hoffset="['0']" data-y="['middle']" data-voffset="['115']" data-width="none"
                                    data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;"
                                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                    data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1400"
                                    data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                    style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a
                                        class="btn btn-default btn-circled btn-transparent pl-20 pr-20"
                                        href="{{ route('contact') }}">Apply Now</a>
                                </div>
                            </li>

                            <!-- SLIDE 3 -->
                            <li data-index="rs-3" data-transition="slidingoverlayhorizontal" data-slotamount="default"
                                data-easein="default" data-easeout="default" data-masterspeed="default"
                                data-thumb="{{ asset('assets/website/images/bg/bg4.jpg') }}" data-rotate="0"
                                data-saveperformance="off" data-title="Slide 3" data-description="">
                                <!-- MAIN IMAGE -->
                                <img src="{{ asset('assets/website/images/bg/bg4.jpg') }}" alt=""
                                    data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                    class="rev-slidebg" data-bgparallax="10" data-no-retina>
                                <!-- LAYERS -->

                                <!-- LAYER NR. 1 -->
                                <div class="tp-caption tp-resizeme text-uppercase text-white font-raleway bg-theme-colored-transparent border-right-theme-color-2-6px pr-20 pl-20"
                                    id="rs-3-layer-1" data-x="['right']" data-hoffset="['30']" data-y="['middle']"
                                    data-voffset="['-90']" data-fontsize="['64']" data-lineheight="['72']"
                                    data-width="none" data-height="none" data-whitespace="nowrap"
                                    data-transform_idle="o:1;s:500" data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                    data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
                                    data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                    style="z-index: 7; white-space: nowrap; font-weight:600;">Learn Anytime, Anywhere
                                </div>

                                <!-- LAYER NR. 2 -->
                                <div class="tp-caption tp-resizeme text-uppercase bg-dark-transparent-6 text-white font-raleway pl-20 pr-20"
                                    id="rs-3-layer-2" data-x="['right']" data-hoffset="['35']" data-y="['middle']"
                                    data-voffset="['-25']" data-fontsize="['32']" data-lineheight="['54']"
                                    data-width="none" data-height="none" data-whitespace="nowrap"
                                    data-transform_idle="o:1;s:500" data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                    data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
                                    data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                    style="z-index: 7; white-space: nowrap; font-weight:600;">Online Tech Courses That Fit
                                    Your Life
                                    Future
                                </div>

                                <!-- LAYER NR. 3 -->
                                <div class="tp-caption tp-resizeme text-white text-right" id="rs-3-layer-3"
                                    data-x="['right']" data-hoffset="['35']" data-y="['middle']" data-voffset="['30']"
                                    data-fontsize="['16']" data-lineheight="['28']" data-width="none" data-height="none"
                                    data-whitespace="nowrap" data-transform_idle="o:1;s:500"
                                    data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                    data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1400"
                                    data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                    style="z-index: 5; white-space: nowrap; letter-spacing:0px; font-weight:400;">
                                    Access high-quality tech education from home or on the go.<br>
                                    Learn at your pace with flexible timing and live support.

                                    <!-- LAYER NR. 4 -->
                                    <div class="tp-caption tp-resizeme" id="rs-3-layer-4" data-x="['right']"
                                        data-hoffset="['35']" data-y="['middle']" data-voffset="['95']"
                                        data-width="none" data-height="none" data-whitespace="nowrap"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                        data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                                        data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1400"
                                        data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                        style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a
                                            class="btn btn-colored btn-lg btn-flat btn-theme-colored btn-theme-colored border-right-theme-color-2-6px pl-20 pr-20"
                                            href="{{ route('contact') }}">Apply Now</a>
                                    </div>
                            </li>

                        </ul>
                    </div>
                    <!-- end .rev_slider -->
                </div>
                <!-- end .rev_slider_wrapper -->
                <script>
                    $(document).ready(function(e) {
                        $(".rev_slider").revolution({
                            sliderType: "standard",
                            sliderLayout: "auto",
                            dottedOverlay: "none",
                            delay: 5000,
                            navigation: {
                                keyboardNavigation: "off",
                                keyboard_direction: "horizontal",
                                mouseScrollNavigation: "off",
                                onHoverStop: "off",
                                touch: {
                                    touchenabled: "on",
                                    swipe_threshold: 75,
                                    swipe_min_touches: 1,
                                    swipe_direction: "horizontal",
                                    drag_block_vertical: false
                                },
                                arrows: {
                                    style: "zeus",
                                    enable: true,
                                    hide_onmobile: true,
                                    hide_under: 600,
                                    hide_onleave: true,
                                    hide_delay: 200,
                                    hide_delay_mobile: 1200,
                                    tmp: '<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
                                    left: {
                                        h_align: "left",
                                        v_align: "center",
                                        h_offset: 30,
                                        v_offset: 0
                                    },
                                    right: {
                                        h_align: "right",
                                        v_align: "center",
                                        h_offset: 30,
                                        v_offset: 0
                                    }
                                },
                                bullets: {
                                    enable: true,
                                    hide_onmobile: true,
                                    hide_under: 600,
                                    style: "metis",
                                    hide_onleave: true,
                                    hide_delay: 200,
                                    hide_delay_mobile: 1200,
                                    direction: "horizontal",
                                    h_align: "center",
                                    v_align: "bottom",
                                    h_offset: 0,
                                    v_offset: 30,
                                    space: 5,
                                    tmp: '<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">@{{ title }}</span>'
                                }
                            },
                            responsiveLevels: [1240, 1024, 778],
                            visibilityLevels: [1240, 1024, 778],
                            gridwidth: [1170, 1024, 778, 480],
                            gridheight: [650, 768, 960, 720],
                            lazyType: "none",
                            parallax: {
                                origo: "slidercenter",
                                speed: 1000,
                                levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                                type: "scroll"
                            },
                            shadow: 0,
                            spinner: "off",
                            stopLoop: "on",
                            stopAfterLoops: 0,
                            stopAtSlide: -1,
                            shuffle: "off",
                            autoHeight: "off",
                            fullScreenAutoWidth: "off",
                            fullScreenAlignForce: "off",
                            fullScreenOffsetContainer: "",
                            fullScreenOffset: "0",
                            hideThumbsOnMobile: "off",
                            hideSliderAtLimit: 0,
                            hideCaptionAtLimit: 0,
                            hideAllCaptionAtLilmit: 0,
                            debugMode: false,
                            fallbacks: {
                                simplifyAll: "off",
                                nextSlideOnWindowFocus: "off",
                                disableFocusListener: false,
                            }
                        });
                    });
                </script>
                <!-- Slider Revolution Ends -->

            </div>
        </section>

        <!-- Section: About  -->
        <section id="about">
            <div class="container pb-60">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="meet-doctors">
                                <h2 class="text-uppercase mt-0 line-height-1">Welcome To <span
                                        class="text-theme-colored">SkillVerse</span></h2>
                                <h6 class="text-uppercase letter-space-5 line-bottom title font-playfair text-uppercase">
                                    Learn Practical Skills with Confidence
                                </h6>
                                <p>At SkillVerse, we offer industry-focused short courses paired with real internship
                                    opportunities to give you hands-on experience from day one.
                                    Learn from highly experienced instructors in comfortable, air-conditioned classrooms
                                    designed to enhance your learning.
                                    Whether you're starting your journey, switching careers, or upgrading your skills,
                                    SkillVerse helps you grow with flexible hybrid classes, personalized support, and a
                                    clear path to success.</p>
                            </div>
                            <div class="row mb-sm-30">
                                <div class="col-sm-6 col-md-6">
                                    <div class="icon-box p-0 mb-20">
                                        <span
                                            class="icon bg-theme-colored icon-circled icon-border-effect effect-circle icon-sm pull-left sm-pull-none flip">
                                            <i class="pe-7s-id text-white"></i>
                                        </span>
                                        <div class="ml-70 ml-sm-0">
                                            <h5 class="icon-box-title mt-10 text-uppercase letter-space-2 mb-10">Expert
                                                Instructors</h5>
                                            <p class="text-gray">Learn from industry professionals with real-world
                                                experience and passion for teaching.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="icon-box p-0 mb-20">
                                        <span class="icon bg-theme-color-2 icon-circled icon-border-effect effect-circle icon-sm pull-left sm-pull-none flip">
                                            <i class="pe-7s-portfolio text-white"></i>
                                    </span>
                                        <div class="ml-70 ml-sm-0">
                                            <h5 class="icon-box-title mt-10 text-uppercase letter-space-2 mb-10">Internship
                                                Opportunities</h5>
                                            <p class="text-gray">Gain valuable hands-on experience with HMS Tech Solutions'
                                                professional team.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="icon-box p-0 mb-20">
                                        <span class="icon bg-theme-color-2 icon-circled icon-border-effect effect-circle icon-sm pull-left sm-pull-none flip">
                                            <i class="pe-7s-study text-white"></i>
                                        </span>
                                        <div class="ml-70 ml-sm-0">
                                            <h5 class="icon-box-title mt-10 text-uppercase letter-space-2 mb-10">Short
                                                Courses</h5>
                                            <p class="text-gray">Choose from a wide range of skill-based short courses
                                                tailored to today’s job market.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="icon-box p-0 mb-20">
                                        <span class="icon bg-theme-colored icon-circled icon-border-effect effect-circle icon-sm pull-left sm-pull-none flip">
                                            <i class="pe-7s-monitor text-white"></i>
                                        </span>
                                        <div class="ml-70 ml-sm-0">
                                            <h5 class="icon-box-title mt-10 text-uppercase letter-space-2 mb-10">Hybrid
                                                Learning</h5>
                                            <p class="text-gray">Attend classes both online and in-person to suit your
                                                schedule and learning style.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="icon-box p-0">
                                        <span class="icon bg-theme-colored icon-circled icon-border-effect effect-circle icon-sm pull-left sm-pull-none flip">
                                            <i class="pe-7s-airplay text-white"></i>
                                        </span>
                                        <div class="ml-70 ml-sm-0">
                                            <h5 class="icon-box-title mt-10 text-uppercase letter-space-2 mb-10">Modern
                                                Facilities</h5>
                                            <p class="text-gray">Study in air-conditioned, tech-equipped classrooms
                                                designed for comfort and focus.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="icon-box p-0">
                                        <span class="icon bg-theme-color-2 icon-circled icon-border-effect effect-circle icon-sm pull-left sm-pull-none flip">
                                            <i class="pe-7s-target text-white"></i>
                                        </span>
                                        <div class="ml-70 ml-sm-0">
                                            <h5 class="icon-box-title mt-10 text-uppercase letter-space-2 mb-10">
                                                Career-Focused Learning</h5>
                                            <p class="text-gray">Build practical skills employers demand, with guidance
                                                every step of the way.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-30 mt-0 bg-theme-colored">
                                <h3 class="title-pattern mt-0"><span class="text-white">Connect <span
                                            class="text-theme-color-2">With Us</span></span>
                                </h3>
                                <!-- Appilication Form Start-->
                                <form class="reservation-form mt-20" method="post" action="{{ route('lead.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-20">
                                                <input placeholder="Enter Name" type="text" id="reservation_name"
                                                    name="name" required="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-20">
                                                <input placeholder="Email" type="text" id="reservation_email"
                                                    name="email" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-20">
                                                <input placeholder="Phone" type="text" id="reservation_phone"
                                                    name="phone" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-20">
                                                <input name="dob" class="form-control required date-picker"
                                                    type="text" placeholder="Date Of Birth" aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group mb-20">
                                                <div class="styled-select">
                                                    <select id="person_select" name="course_id" class="form-control"
                                                        required="">
                                                        <option value="">Choose Course</option>
                                                        @foreach ($courses as $course)
                                                            <option value="{{ $course->id }}">{{ $course->title }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea placeholder="Enter Address" rows="3" class="form-control required" name="address" id="form_message"
                                                    aria-required="true"></textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea placeholder="Enter Message" rows="3" class="form-control" name="message"
                                                    id="form_message" aria-required="true"></textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-sm-12">
                                            <div class="form-group mb-0 mt-10">
                                                <input name="form_botcheck" class="form-control" type="hidden"
                                                    value="">
                                                <button type="submit"
                                                    class="btn btn-colored btn-theme-color-2 text-white btn-lg btn-block"
                                                    data-loading-text="Please wait...">Submit Request</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- Application Form End-->

                                <!-- Application Form Validation Start-->
                                <script type="text/javascript">
                                    $("#reservation_form").validate({
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
                                <!-- Application Form Validation Start -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Divider -->
        {{-- <section>
            <div class="container pb-40">
                <div class="pt-20 pb-20 bg-theme-color-2" data-margin-top="-115px">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="mt-5 ml-50 ml-sm-0 text-white sm-text-center font-weight-600">Edupress The
                                Best Education & University HTML Template Ever!</h3>
                        </div>
                        <div class="col-md-3 sm-text-center">
                            <a class="btn btn-flat btn-theme-colored btn-lg mt-5 ml-30 ml-sm-0" href="#">Purchase
                                Now<i class="fa fa-angle-double-right font-16 ml-10"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <!-- Section: COURSES -->
        <section class="bg-lighter" id="course">
            <div class="container pb-40">
                <div class="section-title">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="text-uppercase line-bottom line-height-1 mt-0 mb-0 ">Our <span
                                    class="text-theme-color-2 font-weight-400">COURSES</span></h2>
                        </div>
                    </div>
                </div>
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="owl-carousel-4col">

                                @foreach ($courses as $course)
                                    <div class="item ">
                                        <div class="service-block bg-white">
                                            <div class="thumb"> <img alt="featured project" src="{{ $course->image }}"
                                                    class="img-fullwidth"
                                                    style="width:100%; height:190px; object-fit:cover;">
                                                {{-- <h4 class="text-white mt-0 mb-0"><span class="price">$125</span> --}}
                                                </h4>
                                            </div>
                                            <div class="content text-left flip p-25 pt-0">
                                                <h4 class="line-bottom mb-10">{{ $course->title }}</h4>
                                                <p>{{ $course->short_description }}</p>
                                                <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10"
                                                    href="{{ route('course.detail', $course->slug) }}">view details</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Why Choose Us -->
        <section id="choose">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{ asset('assets/website/images/institute/23.jpg') }}" height="350"
                                class="img-fullwidth" alt="">
                        </div>
                        <div class="col-md-7 pb-sm-20">
                            <h3 class="title line-bottom mb-20 font-28 mt-0 line-height-1">Why <span
                                    class="text-theme-color-2 font-weight-400">Choose Us</span> ?</h3>
                            <p class="mb-20">
                                We are a trusted name in tech education, offering industry-relevant courses, experienced
                                instructors, hands-on learning, and career-focused support. Our goal is to help students
                                build real skills and succeed in today’s digital world.
                            </p>

                            <!-- Feature 1: Online Access -->
                            <div class="col-sm-6 col-md-3 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                                <div class="icon-box text-center pl-0 pr-0 mb-0">
                                    <span
                                        class="icon bg-theme-colored icon-circled icon-border-effect effect-circle icon-md">
                                        <i class="pe-7s-global text-white"></i> <!-- Changed icon -->
                                    </span>
                                    <h5 class="icon-box-title mt-15 mb-10 letter-space-4 text-uppercase">
                                        <strong>Online Access</strong>
                                    </h5>
                                </div>
                            </div>

                            <!-- Feature 2: Expert Trainers -->
                            <div class="col-sm-6 col-md-3 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                                <div class="icon-box text-center pl-0 pr-0 mb-0">
                                    <span
                                        class="icon bg-theme-color-2 icon-circled icon-border-effect effect-circle icon-md">
                                        <i class="pe-7s-id text-white"></i> <!-- Changed icon -->
                                    </span>
                                    <h5 class="icon-box-title mt-15 mb-10 letter-space-4 text-uppercase">
                                        <strong>Expert Trainers</strong>
                                    </h5>
                                </div>
                            </div>

                            <!-- Feature 3: Certified Courses -->
                            <div class="col-sm-6 col-md-3 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                                <div class="icon-box text-center pl-0 pr-0 mb-0">
                                    <span
                                        class="icon bg-theme-colored icon-circled icon-border-effect effect-circle icon-md">
                                        <i class="pe-7s-medal text-white"></i> <!-- Changed icon -->
                                </span>
                                    <h5 class="icon-box-title mt-15 mb-10 letter-space-4 text-uppercase">
                                        <strong>Certified Courses</strong>
                                    </h5>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Divider: Funfact -->
        <section id="counter" class="divider parallax layer-overlay overlay-theme-colored-9"
            data-bg-img="images/bg/bg2.jpg" data-parallax-ratio="0.7">
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

                    {{-- <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact text-center">
                            <i class="pe-7s-note2 mt-5 text-theme-color-2"></i>
                            <h2 data-animation-duration="2000" data-value="675"
                                class="animate-number text-white mt-0 font-38 font-weight-500">0</h2>
                            <h5 class="text-white text-uppercase mb-0">Our Courses</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact text-center">
                            <i class="pe-7s-users mt-5 text-theme-color-2"></i>
                            <h2 data-animation-duration="2000" data-value="248"
                                class="animate-number text-white mt-0 font-38 font-weight-500">0</h2>
                            <h5 class="text-white text-uppercase mb-0">Our Teachers</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-0">
                        <div class="funfact text-center">
                            <i class="pe-7s-cup mt-5 text-theme-color-2"></i>
                            <h2 data-animation-duration="2000" data-value="24"
                                class="animate-number text-white mt-0 font-38 font-weight-500">0</h2>
                            <h5 class="text-white text-uppercase mb-0">Awards Won</h5>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>

        <!-- Section: team -->
        {{-- <section>
            <div class="container pt-60">
                <div class="section-title mb-0">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="mt-0 text-uppercase font-28 line-bottom">Our <span
                                    class="text-theme-color-2 font-weight-400">Teachers</span></h2>
                            <h4 class="pb-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h4>
                        </div>
                    </div>
                </div>
                <div class="section-content">
                    <div class="row multi-row-clearfix">
                        <div class="col-sm-6 col-md-3 mb-sm-30 sm-text-center">
                            <div class="team maxwidth400">
                                <div class="thumb"><img class="img-fullwidth" src="images/team/team5.jpg"
                                        alt=""></div>
                                <div class="content border-1px p-15 bg-light clearfix">
                                    <h4 class="name text-theme-color-2 mt-0">David Jakaria -
                                        <small>Teacher</small>
                                    </h4>
                                    <p class="mb-20">Lorem ipsum dolor sit amet, con amit sectetur adipisicing
                                        elit.</p>
                                    <ul
                                        class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm pull-left flip">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                    <a class="btn btn-theme-colored btn-sm pull-right flip"
                                        href="page-teachers-details.html">view details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-sm-30 sm-text-center">
                            <div class="team maxwidth400">
                                <div class="thumb"><img class="img-fullwidth" src="images/team/team6.jpg"
                                        alt=""></div>
                                <div class="content border-1px p-15 bg-light clearfix">
                                    <h4 class="name mt-0 text-theme-color-2">Sakib Smith - <small>Teacher</small>
                                    </h4>
                                    <p class="mb-20">Lorem ipsum dolor sit amet, con amit sectetur adipisicing
                                        elit.</p>
                                    <ul
                                        class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm pull-left flip">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                    <a class="btn btn-theme-colored btn-sm pull-right flip"
                                        href="page-teachers-details.html">view details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-sm-30 sm-text-center">
                            <div class="team maxwidth400">
                                <div class="thumb"><img class="img-fullwidth" src="images/team/team7.jpg"
                                        alt=""></div>
                                <div class="content border-1px p-15 bg-light clearfix">
                                    <h4 class="name mt-0 text-theme-color-2">Ismail Jon - <small>Teacher</small>
                                    </h4>
                                    <p class="mb-20">Lorem ipsum dolor sit amet, con amit sectetur adipisicing
                                        elit.</p>
                                    <ul
                                        class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm pull-left flip">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                    <a class="btn btn-theme-colored btn-sm pull-right flip"
                                        href="page-teachers-details.html">view details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 sm-text-center">
                            <div class="team maxwidth400">
                                <div class="thumb"><img class="img-fullwidth" src="images/team/team8.jpg"
                                        alt=""></div>
                                <div class="content border-1px p-15 bg-light clearfix">
                                    <h4 class="name mt-0 text-theme-color-2">Andre Smith - <small>Teacher</small>
                                    </h4>
                                    <p class="mb-20">Lorem ipsum dolor sit amet, con amit sectetur adipisicing
                                        elit.</p>
                                    <ul
                                        class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm pull-left flip">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                    <a class="btn btn-theme-colored btn-sm pull-right flip"
                                        href="page-teachers-details.html">view details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <!-- Section: Gallery -->
        <section id="gallery" class="bg-lighter">
            <div class="container">
                <div class="section-title">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-uppercase text-theme-colored title line-bottom line-height-1 mt-0 mb-0">
                                Our<span class="text-theme-color-2 font-weight-400"> Gallery</span></h2>
                        </div>
                    </div>
                </div>
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Works Filter -->
                            <div class="portfolio-filter font-alt align-center">
                                <a href="#" class="active" data-filter="*">All</a>
                                @foreach ($categories as $category)
                                    <a href="#{{ Str::slug($category->title) }}"
                                        data-filter=".{{ Str::slug($category->title) }}">{{ $category->title }}</a>
                                @endforeach
                            </div>
                            <!-- End Works Filter -->

                            <!-- Portfolio Gallery Grid -->
                            <div id="grid" class="gallery-isotope grid-4 gutter clearfix">
                                @foreach ($galleryImages as $item)
                                    @php
                                        $categoryClass = Str::slug(
                                            optional($item->gallaryCategory)->title ?? 'uncategorized',
                                        );
                                    @endphp

                                    @if (is_array($item->images))
                                        @foreach ($item->images as $image)
                                            <!-- Portfolio Item Start -->
                                            <div class="gallery-item {{ $categoryClass }}">
                                                <div class="thumb">
                                                    <img class="img-fullwidth" src="{{ asset($image) }}"
                                                        alt="gallery-image"
                                                        style="width: 100%; height: 150px; object-fit: cover;">

                                                    <div class="overlay-shade"></div>
                                                    <div class="icons-holder">
                                                        <div class="icons-holder-inner">
                                                            <div
                                                                class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                                                <a data-lightbox="image" href="{{ asset($image) }}"><i
                                                                        class="fa fa-plus"></i></a>
                                                                {{-- <a href="#"><i class="fa fa-link"></i></a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a class="hover-link" data-lightbox="image"
                                                        href="{{ asset($image) }}">View more</a>
                                                </div>
                                            </div>
                                            <!-- Portfolio Item End -->
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>

                            <!-- End Portfolio Gallery Grid -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Client Say -->
        <section id="client" class="divider parallax layer-overlay overlay-theme-colored-9"
            data-background-ratio="0.5" data-bg-img="images/bg/bg2.jpg">
            <div class="container pt-60 pb-60">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="line-bottom-center text-gray-lightgray text-center mt-0 mb-30">Success Stories from Our
                            Students</h2>
                        <div class="owl-carousel-1col" data-dots="true">

                            @foreach ($feedbacks as $feedback)
                                <div class="item">
                                    <div class="testimonial-wrapper text-center">
                                        <div class="thumb"><img class="img-circle" alt=""
                                                src="{{ $feedback->image }}"></div>
                                        <div class="content pt-10">
                                            <p class="font-15 text-white"><em>{{ $feedback->message }}</em></p>
                                            <i class="fa fa-quote-right font-36 mt-10 text-gray-lightgray"></i>
                                            <h4 class="author text-theme-color-2 mb-0">{{ $feedback->name }}</h4>
                                            <h6 class="title text-white mt-0 mb-15">{{ $feedback->designation }}</h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: blog -->
        <section id="blog">
            <div class="container pt-40">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-uppercase text-theme-colored title line-bottom">Latest <span
                                    class="text-theme-color-2 font-weight-400">News</span></h3>
                            <div class="owl-carousel-3col owl-nav-top" data-nav="true">
                                @foreach ($blogs as $blog)
                                    <div class="item">
                                        <article class="post clearfix bg-lighter">
                                            <div class="entry-header">
                                                <div class="post-thumb thumb">
                                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                                                        class="img-responsive img-fullwidth"
                                                        style="height: 250px; object-fit: cover;">
                                                </div>
                                                @php
                                                    $date = \Carbon\Carbon::parse($blog->date);
                                                @endphp
                                                <div
                                                    class="entry-date media-left text-center flip bg-theme-colored border-top-theme-color-2-3px pt-5 pr-15 pb-5 pl-15">
                                                    <ul>
                                                        <li class="font-16 text-white font-weight-600">
                                                            {{ $date->format('d') }}</li>
                                                        <li class="font-12 text-white text-uppercase">
                                                            {{ $date->format('M') }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="entry-content p-15 pt-10 pb-10">
                                                <div class="entry-meta media no-bg no-border mt-0 mb-10">
                                                    <div class="media-body pl-0">
                                                        <div class="event-content pull-left flip">
                                                            <h4
                                                                class="entry-title text-white text-uppercase font-weight-600 m-0 mt-5">
                                                                <a
                                                                    href="{{ route('blog.show', $blog->id) }}">{{ $blog->title }}</a>
                                                            </h4>
                                                            <span class="mb-10 text-gray-darkgray mr-10 font-13">
                                                                <i class="fa fa-thumbs-up mr-5 text-theme-colored"></i>
                                                                {{ $blog->best_for }}
                                                            </span>
                                                            <span class="mb-10 text-gray-darkgray mr-10 font-13">
                                                                <i class="fa fa-certificate mr-5 text-theme-colored"></i>
                                                                Certified
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mt-5">
                                                    {{ Str::limit($blog->description, 120) }}
                                                    <a class="text-theme-color-2 font-12 ml-5"
                                                        href="{{ route('blog', $blog->id) }}">View Details</a>
                                                </p>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach


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
                                    class="pe-7s-mail mr-10 font-48 vertical-align-middle"></i> SUBSCRIBE TO OUR
                                NEWSLETTER</h3>
                        </div>
                        <div class="col-md-6">
                            <!-- Mailchimp Subscription Form Starts Here -->
                            <form id="mailchimp-subscription-form" class="newsletter-form mt-10">
                                <div class="input-group">
                                    <input type="email" value="" name="EMAIL" placeholder="Your Email"
                                        class="form-control input-lg font-16" data-height="45px" id="mce-EMAIL-call">
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

        <!-- end main-content -->
    </div>
@endsection
@section('additional-javascript')
    <link rel="stylesheet" href="path-to/lightbox.css">
    <script src="path-to/isotope.pkgd.min.js"></script>
    <script src="path-to/lightbox.js"></script>

    <script>
        $(window).on('load', function() {
            var $grid = $('.gallery-isotope').isotope({
                itemSelector: '.gallery-item'
            });

            $('.portfolio-filter a').on('click', function(e) {
                e.preventDefault();
                $('.portfolio-filter a').removeClass('active');
                $(this).addClass('active');
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });
        });
    </script>
@endsection
