<body class="">
    <div id="wrapper" class="clearfix">
        <!-- preloader -->
        

        <!-- Header -->
        <header id="header" class="header">
            <div class="header-top bg-theme-color-2 sm-text-center p-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="widget no-border m-0">
                                <ul class="list-inline font-13 sm-text-center mt-5">
                                    <li>
                                        <a class="text-white" href="<?php echo e(route('faq')); ?>">FAQ</a>
                                    </li>
                                    
                                    <li class="text-white">|</li>
                                    <li>
                                        <a class="text-white" href="<?php echo e(route('contact')); ?>">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="widget m-0 pull-right sm-pull-none sm-text-center">
                                <ul class="list-inline pull-right">
                                    
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
                            </div>
                            <div class="widget no-border m-0 mr-15 pull-right flip sm-pull-none sm-text-center">
                                <ul
                                    class="styled-icons icon-circled icon-sm pull-right flip sm-pull-none sm-text-center mt-sm-15">
                                    <li><a href="https://www.facebook.com/share/16BQnwqP9D/"><i class="fab fa-facebook text-white"></i></a></li>
                                    <li><a href="https://youtube.com/@skillverse-01?si=hu_gZaGGSAcZmDOY" target="_blank"><i
                                                class="fab fa-youtube text-white"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram text-white"></i></a></li>
                                    <li><a href="https://www.tiktok.com/@skill.verse4?_t=ZS-8yw3xcafirN&_r=1"><i class="fab fa-tiktok text-white"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin text-white"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle p-0 bg-lightest xs-text-center">
                <div class="container pt-0 pb-0">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-5">
                            <div class="widget no-border m-0">
                                <a class="menuzord-brand pull-left flip xs-pull-center mb-15"
                                    href="<?php echo e(route('home')); ?>"><img
                                        src="<?php echo e(asset('assets/website/images/logo/white-logo.png')); ?>"
                                        alt=""></a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
                                <ul class="list-inline">
                                    <li><i
                                            class="fa fa-phone-square text-theme-colored font-36 mt-5 sm-display-block"></i>
                                    </li>
                                    <li>
                                        <a href="#" class="font-12 text-gray text-uppercase">Call us today!</a>
                                        <h5 class="font-14 m-0"> +(92) 340 394 6000</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
                                <ul class="list-inline">
                                    <li><i class="fa fa-clock-o text-theme-colored font-36 mt-5 sm-display-block"></i>
                                    </li>
                                    <li>
                                        <a href="#" class="font-12 text-gray text-uppercase">We are open!</a>
                                        <h5 class="font-13 text-black m-0"> Mon-Fri 10:00-7:00</h5>
                                    </li>
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
                            <ul class="menuzord-menu">
                                <li class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('home')); ?>">Home</a>
                                </li>
                                <li class="<?php echo e(request()->routeIs('about') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('about')); ?>">About</a>
                                </li>
                                <li class="<?php echo e(request()->routeIs('event') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('event')); ?>">Events</a>
                                </li>
                                <li class="<?php echo e(request()->routeIs('course') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('course')); ?>">Courses</a>
                                </li>
                                <li class="<?php echo e(request()->routeIs('blog') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('blog')); ?>">Blog</a>
                                </li>
                                <li class="<?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('contact')); ?>">Contact</a>
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
                                        <input type="text" placeholder="Type text and press Enter..."
                                            name="s" class="form-control" autocomplete="off">
                                        <span class="search-close"><i class="fa fa-search"></i></span>
                                    </form>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/website/layouts/header.blade.php ENDPATH**/ ?>