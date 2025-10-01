<!doctype html>
<html lang="en">

<head>
    <title>SkillVerse | Management Panel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="HexaBit Bootstrap 4x Admin Template">
    <meta name="author" content="WrapTheme, www.thememakker.com">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


    <link rel="icon" href="<?php echo e(asset('assets/website/images/logo/favicon.png')); ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/font-awesome/css/font-awesome.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/charts-c3/plugin.css')); ?>">
    <link rel="stylesheet"
        href="<?php echo e(asset('assets/admin/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/chartist/css/chartist.min.css')); ?>">
    <link rel="stylesheet"
        href="<?php echo e(asset('assets/admin/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/toastr/toastr.min.css')); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/color_skins.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/jquery-datatable/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet"
        href="<?php echo e(asset('assets/admin/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')); ?>">
    <link rel="stylesheet"
        href="<?php echo e(asset('assets/admin/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/sweetalert/sweetalert.css')); ?>" />


    <style>
        td.details-control {
            background: url("<?php echo e(asset('assets/admin/images/details_open.png')); ?>") no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url("<?php echo e(asset('assets/admin/images/details_close.png')); ?>") no-repeat center center;
        }
    </style>
</head>

<body class="theme-orange">

    <!-- Page Loader -->
    
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <div id="wrapper">

        <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">

                <div class="navbar-left">
                    <div class="navbar-btn">
                        <a href="index.html"><img src="<?php echo e(asset('assets/admin/images/icon-light.svg')); ?>"
                                alt="HexaBit Logo" class="img-fluid logo"></a>
                        <button type="button" class="btn-toggle-offcanvas"><i
                                class="lnr lnr-menu fa fa-bars"></i></button>
                    </div>
                    <a href="javascript:void(0);" class="icon-menu btn-toggle-fullwidth"><i
                            class="fa fa-arrow-left"></i></a>
                    <ul class="nav navbar-nav">
                        <li class="dropdown dropdown-animated scale-right">
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i
                                    class="icon-grid"></i></a>
                            <ul class="dropdown-menu menu-icon app_menu">
                                <li>
                                    <a class="#">
                                        <i class="icon-envelope"></i>
                                        <span>Inbox</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="#">
                                        <i class="icon-bubbles"></i>
                                        <span>Chat</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="#">
                                        <i class="icon-list"></i>
                                        <span>Task</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="#">
                                        <i class="icon-globe"></i>
                                        <span>Blog</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="app-calendar.html" class="icon-menu d-none d-sm-block d-md-none d-lg-block"><i
                                    class="icon-calendar"></i></a></li>
                        <li><a href="app-chat.html" class="icon-menu d-none d-sm-block"><i class="icon-bubbles"></i></a>
                        </li>
                    </ul>
                </div>

                <div class="navbar-right">
                    <form id="navbar-search" class="navbar-form search-form">
                        <input value="" class="form-control" placeholder="Search here..." type="text">
                        <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                    </form>

                    <div id="navbar-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown dropdown-animated scale-left">
                                <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                    <i class="icon-envelope"></i>
                                    <span class="notification-dot"></span>
                                </a>
                                <ul class="dropdown-menu right_chat email">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <img class="media-object "
                                                    src="<?php echo e(asset('assets/admin/images/xs/avatar4.jpg')); ?>"
                                                    alt="">
                                                <div class="media-body">
                                                    <span class="name">James Wert <small class="float-right">Just
                                                            now</small></span>
                                                    <span class="message">Lorem ipsum Veniam aliquip culpa laboris
                                                        minim tempor</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <img class="media-object "
                                                    src="<?php echo e(asset('assets/admin/images/xs/avatar1.jpg')); ?>"
                                                    alt="">
                                                <div class="media-body">
                                                    <span class="name">Folisise Chosielie <small
                                                            class="float-right">12min ago</small></span>
                                                    <span class="message">There are many variations of Lorem Ipsum
                                                        available, but the majority</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <img class="media-object "
                                                    src="<?php echo e(asset('assets/admin/images/xs/avatar5.jpg')); ?>"
                                                    alt="">
                                                <div class="media-body">
                                                    <span class="name">Ava Alexander <small
                                                            class="float-right">38min ago</small></span>
                                                    <span class="message">Many desktop publishing packages and web page
                                                        editors</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="media mb-0">
                                                <img class="media-object "
                                                    src="<?php echo e(asset('assets/images/xs/avatar2.jpg')); ?>" alt="">
                                                <div class="media-body">
                                                    <span class="name">Debra Stewart <small class="float-right">2hr
                                                            ago</small></span>
                                                    <span class="message">Contrary to popular belief, Lorem Ipsum is
                                                        not simply random text</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            
                            <li class="dropdown dropdown-animated scale-left">
                                <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                    <i class="icon-bell"></i>
                                    <span class="notification-dot" id="notificationDot" style="display:none;"></span>
                                </a>

                                <ul class="dropdown-menu feeds_widget" id="notificationList">
                                    <li class="header">Notifications</li>
                                </ul>
                            </li>

                            <li><a href="javascript:void(0);" class="right_toggle icon-menu" title="Right Menu"><i
                                        class="icon-settings"></i></a></li>
                            <li><a href="page-login.html" class="icon-menu"><i class="icon-power"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/layouts/header.blade.php ENDPATH**/ ?>