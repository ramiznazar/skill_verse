<!doctype html>
<html lang="en">

<head>
    <title>SkillVerse | Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?php echo e(asset('assets/website/images/logo/favicon.png')); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/color_skins.css')); ?>">
</head>

<body class="theme-cyan">
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
                                    <div class="carousel-item active">your Admin</div>
                                    <div class="carousel-item">your Project</div>
                                    <div class="carousel-item">your Dashboard</div>
                                    <div class="carousel-item">your Application</div>
                                    <div class="carousel-item">your Client</div>
                                </div>
                            </div>
                        </h2>
                        <p>It is a long established fact that a reader will be distracted...</p>
                        <ul class="social-links list-unstyled">
                            <li><a class="btn btn-default" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="btn btn-default" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="btn btn-default" href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="header">
                            <p class="lead">Create an account</p>
                        </div>
                        <div class="body">

                            <form action="<?php echo e(route('auth.register.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>

                                <?php if(session('error')): ?>
                                    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                                <?php endif; ?>
                                <?php if(session('success')): ?>
                                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                                <?php endif; ?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Full Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="<?php echo e(old('name')); ?>" required>
                                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Username</label>
                                            <input type="text" name="username" class="form-control"
                                                value="<?php echo e(old('username')); ?>" required>
                                            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="<?php echo e(old('phone')); ?>" required>
                                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="<?php echo e(old('email')); ?>" required>
                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" name="password" class="form-control" required>
                                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="">-- Select Role --</option>
                                        <option value="admin">Admin</option>
                                        <option value="partner">Partner</option>
                                        <option value="administrator">Administrator</option>
                                    </select>
                                    <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </form>

                            <div class="separator-linethrough"><span>OR</span></div>
                            <a href="" class="btn btn-secondary btn-block">Already have an
                                account? Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('assets/bundles/libscripts.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/bundles/vendorscripts.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/bundles/mainscripts.bundle.js')); ?>"></script>
</body>

</html>
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/auth/register.blade.php ENDPATH**/ ?>