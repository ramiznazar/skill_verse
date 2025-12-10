<!doctype html>
<html lang="en">

<head>
    <title>SkillVerse | Management Panel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="HexaBit Bootstrap 4x Admin Template">
    <meta name="author" content="WrapTheme, www.thememakker.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="icon" href="{{ asset('assets/website/images/logo/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/font-awesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/charts-c3/plugin.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/toastr/toastr.min.css') }}">

    {{-- jQuery --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/color_skins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/sweetalert/sweetalert.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        td.details-control {
            background: url("{{ asset('assets/admin/images/details_open.png') }}") no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url("{{ asset('assets/admin/images/details_close.png') }}") no-repeat center center;
        }

        /* Notification Dropdown Styling */
        #notificationList {
            width: 360px !important;
            max-height: 450px !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            padding: 0 !important;
        }

        #notificationList .header {
            padding: 15px 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            color: #333;
            margin: 0;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        #notificationList li:not(.header):not(.footer) {
            padding: 10px 15px !important;
            border-bottom: 1px solid #f1f1f1 !important;
            margin: 0 !important;
            display: flex !important;
            align-items: flex-start !important;
            transition: background-color 0.2s ease;
        }

        #notificationList li:not(.header):not(.footer):hover {
            background-color: #f8f9fa !important;
        }

        #notificationList li .feeds-left {
            margin-right: 12px;
            margin-top: 2px;
            color: #007bff;
        }

        #notificationList li .feeds-body {
            flex: 1;
            min-width: 0;
        }

        #notificationList li .feeds-body .title {
            font-size: 14px !important;
            font-weight: 600 !important;
            margin-bottom: 4px !important;
            color: #333;
            line-height: 1.3;
        }

        #notificationList li .feeds-body small {
            display: block;
            font-size: 12px;
            color: #6c757d;
            line-height: 1.4;
            margin-top: 2px;
        }

        #notificationList li input[type="checkbox"] {
            margin-left: 10px;
            margin-top: 2px;
            cursor: pointer;
        }

        #notificationList .footer {
            padding: 12px 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            text-align: center;
            position: sticky;
            bottom: 0;
            z-index: 10;
        }

        #notificationList .footer a {
            color: #007bff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
        }

        #notificationList .footer a:hover {
            text-decoration: underline;
        }

        /* Scrollbar styling for notification dropdown */
        #notificationList::-webkit-scrollbar {
            width: 6px;
        }

        #notificationList::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #notificationList::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        #notificationList::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        @media screen and (max-width: 768px) {
            #notificationList {
                width: calc(100vw - 20px) !important;
                max-width: 360px;
            }
        }

        /* Message Dropdown Styling - Same as Notification */
        #messageList {
            width: 360px !important;
            max-height: 450px !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            padding: 0 !important;
        }

        #messageList .header {
            padding: 15px 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            color: #333;
            margin: 0;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        #messageList li:not(.header):not(.footer) {
            padding: 10px 15px !important;
            border-bottom: 1px solid #f1f1f1 !important;
            margin: 0 !important;
            display: flex !important;
            align-items: flex-start !important;
            transition: background-color 0.2s ease;
        }

        #messageList li:not(.header):not(.footer):hover {
            background-color: #f8f9fa !important;
        }

        #messageList li .feeds-left {
            margin-right: 12px;
            margin-top: 2px;
            color: #007bff;
        }

        #messageList li .feeds-body {
            flex: 1;
            min-width: 0;
        }

        #messageList li .feeds-body .title {
            font-size: 14px !important;
            font-weight: 600 !important;
            margin-bottom: 4px !important;
            color: #333;
            line-height: 1.3;
        }

        #messageList li .feeds-body small {
            display: block;
            font-size: 12px;
            color: #6c757d;
            line-height: 1.4;
            margin-top: 2px;
        }

        #messageList li input[type="checkbox"] {
            margin-left: 10px;
            margin-top: 2px;
            cursor: pointer;
        }

        #messageList .footer {
            padding: 12px 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            text-align: center;
            position: sticky;
            bottom: 0;
            z-index: 10;
        }

        #messageList .footer a {
            color: #007bff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
        }

        #messageList .footer a:hover {
            text-decoration: underline;
        }

        /* Scrollbar styling for message dropdown */
        #messageList::-webkit-scrollbar {
            width: 6px;
        }

        #messageList::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #messageList::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        #messageList::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        @media screen and (max-width: 768px) {
            #messageList {
                width: calc(100vw - 20px) !important;
                max-width: 360px;
            }
        }
    </style>
</head>

<body class="theme-orange">

    <!-- Page Loader -->
    {{-- <div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="{{asset('assets/admin/images/icon-light.svg')}}" width="48" height="48" alt="HexaBit"></div>
        <p>Please wait...</p>        
    </div>
</div> --}}
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <div id="wrapper">

        <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">

                <div class="navbar-left">
                    <div class="navbar-btn">
                        <a href="{{ route('admin') }}"><img
                                src="{{ asset('assets/website/images/logo/white-logo.png') }}" width="150" alt="HexaBit Logo"
                                class="img-fluid logo"></a>
                        <button type="button" class="btn-toggle-offcanvas"><i
                                class="lnr lnr-menu fa fa-bars"></i></button>
                    </div>
                    <a href="javascript:void(0);" class="icon-menu btn-toggle-fullwidth"><i
                            class="fa fa-arrow-left"></i></a>
                </div>

                <div class="navbar-right">
                    <form id="navbar-search" class="navbar-form search-form">
                        <input value="" class="form-control" placeholder="Search here..." type="text">
                        <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                    </form>

                    <div id="navbar-menu">
                        <ul class="nav navbar-nav">
                            {{-- Message Icon (Contact & Booking) --}}
                            <li class="dropdown dropdown-animated scale-left">
                                <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                    <i class="icon-envelope"></i>
                                    <span class="notification-dot" id="messageDot" style="display:none;"></span>
                                </a>
                                <ul class="dropdown-menu right_chat email" id="messageList">
                                    <li class="header">Messages</li>
                                </ul>
                            </li>

                            {{-- Notification Bell Icon --}}
                            <li class="dropdown dropdown-animated scale-left">
                                <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                    <i class="icon-bell"></i>
                                    <span class="notification-dot" id="notificationDot" style="display:none;"></span>
                                </a>

                                <ul class="dropdown-menu feeds_widget" id="notificationList">
                                    <li class="header">Notifications</li>
                                </ul>
                            </li>
                            <li><a href="{{ route('auth.logout') }}" class="icon-menu"><i
                                        class="icon-power"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>