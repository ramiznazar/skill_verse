

<?php $__env->startSection('content'); ?>
    <div class="main-content">

        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
            data-bg-img="<?php echo e(asset('assets/website/images/bg/bg3.jpg')); ?>">
            <div class="container pt-70 pb-20">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Discount Interview Booking</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                <li class="active text-gray-silver">Interview Booking</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Booking Form -->
        <section class="divider">
            <div class="container">
                <div class="row pt-30">
                    <div class="col-md-12">
                        

                        <h3 class="line-bottom mt-0 mb-20">Register for 80% Discount Interview</h3>
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
                                                <option value="<?php echo e($course->id); ?>"><?php echo e($course->title); ?></option>
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