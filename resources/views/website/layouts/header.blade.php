<body class="">
    <div id="wrapper" class="clearfix">
        <!-- preloader -->
        {{-- <div id="preloader">
            <div id="spinner">
                <div class="preloader-dot-loading">
                    <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
                </div>
            </div>
            <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
        </div> --}}

        <!-- Header -->
        <header id="header" class="header">
            <div class="header-top bg-theme-color-2 sm-text-center p-0">
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
                            {{-- <div class="widget m-0 pull-right sm-pull-none sm-text-center">
                                <ul class="list-inline pull-right">
                                    <li class="mb-0 pb-0">
                                        <div class="top-dropdown-outer pt-5 pb-10">
                                            <a class="top-cart-link has-dropdown text-white text-hover-theme-colored"><i
                                                    class="fa fa-shopping-cart font-13"></i> (12)</a>
                                            <ul class="dropdown">
                                                <li>
                                                    <!-- dropdown cart -->
                                                    <div class="dropdown-cart">
                                                        <table class="table cart-table-list table-responsive">
                                                            <tbody>
                                                                <tr>
                                                                    <td><a href="#"><img alt=""
                                                                                src="images/products/sm1.jpg"></a></td>
                                                                    <td><a href="#"> Product Title</a></td>
                                                                    <td>X3</td>
                                                                    <td>$ 100.00</td>
                                                                    <td><a class="close" href="#"><i
                                                                                class="fa fa-close font-13"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><a href="#"><img alt=""
                                                                                src="images/products/sm2.jpg"></a></td>
                                                                    <td><a href="#"> Product Title</a></td>
                                                                    <td>X2</td>
                                                                    <td>$ 70.00</td>
                                                                    <td><a class="close" href="#"><i
                                                                                class="fa fa-close font-13"></i></a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="total-cart text-right">
                                                            <table class="table table-responsive">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Cart Subtotal</td>
                                                                        <td>$170.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Shipping and Handling</td>
                                                                        <td>$20.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Order Total</td>
                                                                        <td>$190.00</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="cart-btn text-right">
                                                            <a class="btn btn-theme-colored btn-xs"
                                                                href="shop-cart.html"> View cart</a>
                                                            <a class="btn btn-dark btn-xs" href="shop-checkout.html">
                                                                Checkout</a>
                                                        </div>
                                                    </div>
                                                    <!-- dropdown cart ends -->
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="mb-0 pb-0">
                                        <div class="top-dropdown-outer pt-5 pb-10">
                                            <a class="top-search-box has-dropdown text-white text-hover-theme-colored"><i
                                                    class="fa fa-search font-13"></i> &nbsp;</a>
                                            <ul class="dropdown">
                                                <li>
                                                    <div class="search-form-wrapper">
                                                        <form method="get" class="mt-10">
                                                            <input type="text"
                                                                onfocus="if(this.value =='Enter your search') { this.value = ''; }"
                                                                onblur="if(this.value == '') { this.value ='Enter your search'; }"
                                                                value="Enter your search" id="searchinput"
                                                                name="s" class="">
                                                            <label><input type="submit" name="submit"
                                                                    value=""></label>
                                                        </form>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div> --}}
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
            </div>
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
