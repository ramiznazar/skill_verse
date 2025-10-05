

<?php $__env->startSection('content'); ?>
<style>
    /* ===== Profile Styling (same as view) ===== */
    .profile-card {
        position: relative;
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .profile-cover {
        background: linear-gradient(135deg, #FEB800, #a7852f);
        height: 180px;
    }
    .profile-avatar {
        position: absolute;
        top: 100px;
        left: 50%;
        transform: translateX(-50%);
        border: 4px solid #fff;
        border-radius: 50%;
        width: 130px;
        height: 130px;
        object-fit: cover;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        background: #fff;
    }
    .profile-avatar:hover {
        transform: translateX(-50%) scale(1.05);
    }
    .profile-body {
        padding: 100px 30px 40px;
        text-align: center;
    }
    .profile-name {
        font-size: 1.6rem;
        font-weight: 600;
        color: #2c3e50;
    }
    .profile-role {
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 25px;
        text-transform: capitalize;
    }

    /* ===== Form Section ===== */
    .edit-form-wrap {
        text-align: left;
        max-width: 900px;
        margin: 0 auto;
    }
    .form-label {
        font-weight: 600;
        color: #2e59d9;
        margin-bottom: 6px;
    }
    .form-control, .form-select {
        border-radius: 10px;
        padding: 10px 12px;
    }
    .help-text {
        font-size: 12px;
        color: #6c757d;
    }

    /* ===== Buttons ===== */
    .save-btn {
        margin-top: 20px;
        padding: 10px 24px;
        border-radius: 50px;
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        border: none;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .save-btn:hover {
        background: linear-gradient(135deg, #1cc88a, #4e73df);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
    }

    .cancel-btn {
        margin-top: 20px;
        padding: 10px 24px;
        border-radius: 50px;
    }

    /* ===== Image upload button over avatar ===== */
    .avatar-upload {
        position: absolute;
        top: 190px;
        right: calc(50% - 65px);
        transform: translateX(65px);
    }
    .avatar-upload .btn {
        border-radius: 20px;
        padding: 5px 12px;
        font-size: 12px;
    }

    @media (max-width: 767px) {
        .edit-form-wrap .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .avatar-upload {
            right: calc(50% - 60px);
            transform: translateX(60px);
        }
    }
</style>

<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-12">
                <h2 class="mb-3">Edit Profile</h2>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="profile-card">

            
            <div class="profile-cover"></div>

            
            <img
                id="avatar-preview"
                src="<?php echo e($user->image ? asset($user->image) : asset('default-avatar.png')); ?>"
                alt="User Avatar"
                class="profile-avatar"
            >

            
            <div class="avatar-upload">
                <label class="btn btn-sm btn-dark mb-0" for="image-input">
                    <i class="icon-picture"></i> Change
                </label>
            </div>

            
            <div class="profile-body">
                <h4 class="profile-name"><?php echo e($user->name); ?></h4>
                <p class="profile-role"><?php echo e(ucfirst($user->role)); ?></p>

                <div class="edit-form-wrap">
                    <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        
                        <input id="image-input" type="file" name="image" class="d-none" accept="image/*" onchange="previewImage(this)">
                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger d-block mb-2"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="form-control" required>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" value="<?php echo e(old('username', $user->username)); ?>" class="form-control" required>
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" class="form-control" required>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>" class="form-control">
                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current">
                                <small class="help-text">Min 6 characters</small>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger d-block"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="save-btn">
                                <i class="icon-check"></i> Save Changes
                            </button>
                            <a href="<?php echo e(route('profile.index')); ?>" class="btn btn-light cancel-btn ml-2">Cancel</a>
                        </div>
                    </form>
                </div> 
            </div> 
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        const file = input.files?.[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => document.getElementById('avatar-preview').src = e.target.result;
        reader.readAsDataURL(file);
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/user/profile/update.blade.php ENDPATH**/ ?>