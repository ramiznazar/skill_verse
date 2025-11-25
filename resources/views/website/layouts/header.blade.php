<body class="">
    <div id="wrapper" class="clearfix">

        <!-- Header -->
        <header id="header" class="header">
            {{-- <div class="header-top bg-theme-color-2 sm-text-center p-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="widget no-border m-0">
                                <ul class="list-inline font-13 sm-text-center mt-5">
                                    <li>
                                        <a class="text-white" href="{{ route('faq') }}">FAQ</a>
                                    </li>
                                    <li class="text-white">|</li>
                                    <li>
                                        <a class="text-white" href="{{ route('contact') }}">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8" style="margin-right: -20px !important;">

                            <div class="widget no-border m-0 mr-15 pull-right flip sm-pull-none sm-text-center">
                                <ul
                                    class="styled-icons icon-circled icon-sm pull-right flip sm-pull-none sm-text-center mt-sm-15">
                                    <li><a href="https://www.facebook.com/share/16BQnwqP9D/" target="_blank"><i
                                                class="fab fa-facebook text-white"></i></a></li>
                                    <li><a href="https://youtube.com/@skillverse-01?si=hu_gZaGGSAcZmDOY"
                                            target="_blank"><i class="fab fa-youtube text-white"></i></a></li>
                                    <li><a href="https://www.instagram.com/skill_verse3946/" target="_blank"><i
                                                class="fab fa-instagram text-white"></i></a></li>
                                    <li><a href="https://www.tiktok.com/@skill.verse4?_t=ZS-8yw3xcafirN&_r=1"
                                            target="_blank"><i class="fab fa-tiktok text-white"></i></a></li>
                                    <li><a href="https://www.linkedin.com/company/108634627" target="_blank"><i
                                                class="fab fa-linkedin text-white"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- 70% Discount Test Banner -->
            <div class="discount-test-banner bg-theme-color-2 text-white text-center"
                onclick="window.location.href='{{ route('test.booking') }}'">

                <span class="icon">🎉</span>
                <span class="banner-text">Get 80% Discount on Trending Courses — Book Your Interview Now!</span>
                <div class="shimmer"></div>
            </div>

            <style>
                .discount-test-banner {
                    position: relative;
                    padding: 10px 0;
                    font-size: 14px;
                    font-weight: 700;
                    cursor: pointer;
                    overflow: hidden;
                }

                /* Soft Glow Around Banner (Professional) */
                .discount-test-banner {
                    box-shadow: 0 0 12px rgba(0, 0, 0, 0.20);
                    animation: subtleGlow 3.5s infinite ease-in-out;
                }

                @keyframes subtleGlow {

                    0%,
                    100% {
                        box-shadow: 0 0 12px rgba(0, 0, 0, 0.20);
                    }

                    50% {
                        box-shadow: 0 0 18px rgba(0, 0, 0, 0.30);
                    }
                }

                /* Floating Icon Animation */
                .discount-test-banner .icon {
                    display: inline-block;
                    margin-right: 8px;
                    animation: floatIcon 2.2s infinite ease-in-out;
                }

                @keyframes floatIcon {

                    0%,
                    100% {
                        transform: translateY(0);
                    }

                    50% {
                        transform: translateY(-4px);
                    }
                }

                /* Text Slide-in */
                .banner-text {
                    display: inline-block;
                    animation: slideIn 1s ease forwards;
                    opacity: 0;
                    transform: translateY(8px);
                }

                @keyframes slideIn {
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                /* Shimmer Effect */
                .shimmer {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: -120%;
                    width: 50%;
                    height: 100%;
                    background: linear-gradient(120deg,
                            transparent,
                            rgba(255, 255, 255, 0.25),
                            transparent);
                    animation: shimmerMove 3s infinite;
                }

                @keyframes shimmerMove {
                    0% {
                        left: -120%;
                    }

                    100% {
                        left: 120%;
                    }
                }

                /* Subtle Hover Highlight */
                .discount-test-banner:hover {
                    opacity: 0.95;
                }
            </style>

            <div class="header-nav">
                <div class="header-nav-wrapper navbar-scrolltofixed bg-theme-colored border-bottom-theme-color-2-1px">
                    <div class="container">
                        <nav id="menuzord" class="menuzord bg-theme-colored pull-left flip menuzord-responsive">

                            <!-- BRAND / LOGO ON LEFT -->
                            <a class="menuzord-brand" href="{{ route('home') }}"
                                style="display:flex;align-items:center; margin-top: 13px; ">
                                <img src="{{ asset('assets/website/images/logo/black-logo.png') }}" alt="Skillverse"
                                    style="height:46px; width:auto;">
                            </a>

                            <ul class="menuzord-menu">
                                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                                    <a href="{{ route('about') }}">About</a>
                                </li>
                                <li class="{{ request()->routeIs('event') ? 'active' : '' }}">
                                    <a href="{{ route('event') }}">Events</a>
                                </li>
                                <li class="{{ request()->routeIs('course') ? 'active' : '' }}">
                                    <a href="{{ route('course') }}">Courses</a>
                                </li>
                                <li class="{{ request()->routeIs('blog') ? 'active' : '' }}">
                                    <a href="{{ route('blog') }}">Blog</a>
                                </li>
                                <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                                    <a href="{{ route('contact') }}">Contact</a>
                                </li>
                            </ul>
                            <ul class="pull-right flip hidden-sm hidden-xs">
                                <li>
                                    <!-- Modal: Book Now Starts -->
                                    <a class="btn btn-colored btn-flat bg-theme-color-2 text-white font-14 bs-modal-ajax-load mt-0 p-25 pr-15 pl-15"
                                        data-toggle="modal" data-target="#BSParentModal"
                                        href="ajax-load/reservation-form.html">Contact Us</a>
                                    <!-- Modal: Book Now End -->
                                </li>
                            </ul>
                            <div id="top-search-bar" class="collapse">
                                <div class="container">
                                    <form role="search" action="#" class="search_form_top" method="get">
                                        <input type="text" placeholder="Type text and press Enter..." name="s"
                                            class="form-control" autocomplete="off">
                                        <span class="search-close"><i class="fa fa-search"></i></span>
                                    </form>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
