<!doctype html>
<html lang="en">

<head>
    <title>SkillVerse | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('assets/website/images/logo/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/color_skins.css') }}">
</head>

<body class="theme-orange">
    <div id="wrapper" class="auth-main">
        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-8">
                    <div class="auth_detail">
                        <h2 class="text-monospace">
                            Everything<br> you need for
                            <div id="carouselExampleControls" class="carousel vert slide" data-ride="carousel"
                                data-interval="1500">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">Admissions</div>
                                    <div class="carousel-item">Courses</div>
                                    <div class="carousel-item">Students</div>
                                    <div class="carousel-item">Reports</div>
                                    <div class="carousel-item">Managements</div>
                                </div>
                            </div>
                        </h2>
                        <p>Login to manage admissions, courses, users, and more — all from a centralized dashboard.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card text-center">
                        <!-- Logo -->
                        <div class="mt-4">
                            <img src="{{ asset('assets/website/images/logo/white-logo.png') }}" alt="SkillVerse Logo"
                                style="max-width: 250px;">
                        </div>

                        <!-- Header -->
                        <div class="header">
                            <p class="lead">Login to your account</p>
                        </div>

                        <!-- Body -->
                        <div class="body">
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form method="POST" action="{{ route('auth.login.store') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" name="username" class="form-control"
                                        placeholder="Enter your username" required value="{{ old('username') }}">
                                    @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        required>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group clearfix text-left">
                                    <label class="fancy-checkbox element-left">
                                        <input type="checkbox" name="remember">
                                        <span>Remember me</span>
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                                
                                {{-- <div class="bottom mt-3 text-center">
                                    <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="">Forgot
                                            password?</a></span><br>

                                    <span><a href="">Register New User</a></span>

                                </div> --}}
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/admin//bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/bundles/vendorscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/bundles/mainscripts.bundle.js') }}"></script>
</body>

</html>
