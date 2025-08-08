<!doctype html>
<html lang="en">
<head>
    <title>:: HexaBit :: Forgot Password</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admdin/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/color_skins.css') }}">
</head>

<body class="theme-orange">

<div id="wrapper" class="auth-main">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('assets/admin/images/icon-light.svg') }}" width="30" height="30" class="d-inline-block align-top mr-2" alt="">
                        HexaBit
                    </a>
                </nav>
            </div>

            <div class="col-lg-8">
                <div class="auth_detail">
                    <h2 class="text-monospace">
                        Everything<br> you need for
                        <div id="carouselExampleControls" class="carousel vert slide" data-ride="carousel" data-interval="1500">
                            <div class="carousel-inner">
                                <div class="carousel-item active">your Admin</div>
                                <div class="carousel-item">your Project</div>
                                <div class="carousel-item">your Dashboard</div>
                                <div class="carousel-item">your Application</div>
                                <div class="carousel-item">your Client</div>
                            </div>
                        </div>
                    </h2>
                    <p>A centralized system for all your management needs!</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="header">
                        <p class="lead">Recover your password</p>
                    </div>
                    <div class="body">

                        {{-- Success Message --}}
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- Error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('send.reset.link') }}">
                            @csrf

                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block">Send Reset Link</button>

                            <div class="bottom mt-2">
                                <span class="helper-text">Know your password? <a href="{{ route('login') }}">Login</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('assets/admin/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/bundles/vendorscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/bundles/mainscripts.bundle.js') }}"></script>
</body>
</html>
