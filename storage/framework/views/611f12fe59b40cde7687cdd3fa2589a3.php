

<?php $__env->startSection('content'); ?>
    <div class="main-content">

        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
            data-bg-img="<?php echo e(asset('assets/website/images/bg/bg3.jpg')); ?>">
            <div class="container pt-70 pb-20">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Interview Booking</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                <li class="active text-gray-silver">Interview Booking</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <?php if($courses->count()): ?>
            <section class="bg-lighter">
                <div class="container pt-30 pb-10">
                    <div class="row">
                        <div class="col-md-12 text-center mb-20">
                            
                            <p class="text-muted">
                                Book your interview today and lock these special limited-time fees.
                            </p>

                            <p class="text-muted mt-5" style="font-size:14px;">
                                <span style="color:#ff5722; font-weight:600;">Sponsored by HMS Tech Solutions</span> —
                                Empowering Digital Skills & IT Education.
                            </p>
                        </div>

                    </div>

                    <div class="row">
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $discAmount = $course->full_fee - $course->interview_discount_amount;
                            ?>

                            <div class="col-sm-6 col-md-4">
                                <div class="border-1px bg-white mb-20 p-15 course-discount-card"
                                    style="border-radius:6px; box-shadow:0 5px 15px rgba(0,0,0,0.05);">
                                    <h4 class="mt-0 mb-5"><?php echo e($course->title); ?></h4>

                                    <p class="mb-5 text-muted">
                                        <small>Standard Fee</small><br>
                                        <span style="text-decoration:line-through; color:#999;">
                                            Rs <?php echo e(number_format($course->full_fee)); ?>

                                        </span>
                                    </p>

                                    <p class="mb-5">
                                        <small>Interview Discount</small><br>

                                        <span class="badge" style="background:#ff9800; color:#fff;">
                                            <?php echo e(number_format($course->interview_discount_per)); ?>%
                                            OFF
                                        </span>

                                        <span class="text-theme-colored ml-5">
                                            – Rs <?php echo e(number_format($discAmount)); ?>

                                        </span>
                                    </p>

                                    <p class="mb-10">
                                        <small>Interview Fee</small><br>
                                        <span class="font-18 text-theme-colored font-weight-600">
                                            Rs <?php echo e(number_format($course->interview_discount_amount)); ?>

                                        </span>
                                    </p>

                                    

                                    <p class="mb-0">
                                        <small class="text-muted">
                                            *Final fee will be confirmed at admission.
                                        </small>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Section: Booking Form -->
        <section class="divider">
            <div class="container">
                <div class="row pt-30">
                    <div class="col-md-12">

                        <h3 class="line-bottom mt-0 mb-20">Register for Interview & Unlock Your Discount</h3>
                        <p class="mb-20">
                            Fill out the form below to receive your interview date and time. Limited slots are available
                            each day, and if today is fully booked, you’ll be automatically scheduled for the next available
                            day.
                        </p>

                        <form action="<?php echo e(route('test.booking.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Full Name" required>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter Email Address" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="Enter Phone Number" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="course_id" class="form-control" required>
                                            <option value="">Select Course</option>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $original = (float) ($course->min_fee ?? 0);
                                                    $discAmount = (float) ($course->interview_discount_amount ?? 0);
                                                    $final =
                                                        $original > 0 && $discAmount > 0
                                                            ? max($original - $discAmount, 0)
                                                            : $original;
                                                ?>
                                                <option value="<?php echo e($course->id); ?>">
                                                    <?php echo e($course->title); ?>

                                                    <?php if($final > 0): ?>
                                                        — Interview Fee: Rs <?php echo e(number_format($final)); ?>

                                                    <?php endif; ?>
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Interview Slot</label>
                                        <select name="slot" class="form-control" required>
                                            <option value="">Select date & time</option>

                                            <?php $__empty_1 = true; $__currentLoopData = $slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <option value="<?php echo e($slot['id']); ?>|<?php echo e($slot['time']); ?>">
                                                    <?php echo e(\Carbon\Carbon::parse($slot['date'])->format('d M Y')); ?>

                                                    — <?php echo e(\Carbon\Carbon::parse($slot['time'])->format('h:i A')); ?>

                                                    (<?php echo e($slot['available']); ?> seats left)
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <option value="">No interview slots available</option>
                                            <?php endif; ?>
                                        </select>

                                        <?php $__errorArgs = ['slot'];
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
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea name="purpose" class="form-control required" rows="5"
                                    placeholder="Tell us why you want to join (optional)"></textarea>
                            </div>

                            <button type="submit"
                                class="btn btn-theme-colored btn-flat text-uppercase 
                                border-left-theme-color-2-4px">
                                Book My Test
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/website/pages/test/booking.blade.php ENDPATH**/ ?>