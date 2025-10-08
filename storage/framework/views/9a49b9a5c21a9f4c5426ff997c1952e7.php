<!doctype html>
<html lang="en">

<head>
    <title>SkillVerse | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?php echo e(asset('assets/website/images/logo/favicon.png')); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/color_skins.css')); ?>">
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
                            <img src="<?php echo e(asset('assets/website/images/logo/white-logo.png')); ?>" alt="SkillVerse Logo"
                                style="max-width: 250px;">
                        </div>

                        <!-- Header -->
                        <div class="header">
                            <p class="lead">Login to your account</p>
                        </div>

                        <!-- Body -->
                        <div class="body">
                            <?php if(session('error')): ?>
                                <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                            <?php endif; ?>

                            <form method="POST" action="<?php echo e(route('auth.login.store')); ?>">
                                <?php echo csrf_field(); ?>

                                <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" name="username" class="form-control"
                                        placeholder="Enter your username" required value="<?php echo e(old('username')); ?>">
                                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        required>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group clearfix text-left">
                                    <label class="fancy-checkbox element-left">
                                        <input type="checkbox" name="remember">
                                        <span>Remember me</span>
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                                
                                
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('assets/admin//bundles/libscripts.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/bundles/vendorscripts.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/bundles/mainscripts.bundle.js')); ?>"></script>
</body>

</html>
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/auth/login.blade.php ENDPATH**/ ?>