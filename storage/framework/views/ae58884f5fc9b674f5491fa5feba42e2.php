
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Courses</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('course.index')); ?>" class="btn btn-sm btn-primary" title="">All Courses</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Course</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="<?php echo e(route('course.update', $course->id)); ?>" method="post"
                                enctype="multipart/form-data" novalidate>
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                <div class="form-group">
                                    <label>Current Image</label>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="card">
                                            <div class="header">
                                                <img src="<?php echo e(asset($course->image)); ?>" class="img-fluid rounded"
                                                    style="width:100%; height: 250px; object-fit: cover;" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" accept="image/*" class="form-control">
                                            <?php $__errorArgs = ['image'];
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

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control"
                                                value="<?php echo e($course->title); ?>">
                                            <?php $__errorArgs = ['title'];
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input type="text" name="slug" class="form-control"
                                                value="<?php echo e($course->slug); ?>">
                                            <?php $__errorArgs = ['slug'];
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Duration</label>
                                            <input type="text" name="duration" class="form-control"
                                                value="<?php echo e($course->duration); ?>">
                                            <?php $__errorArgs = ['duration'];
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

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category_id" class="form-control">
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>"
                                                        <?php echo e($course->category_id == $category->id ? 'selected' : ''); ?>>
                                                        <?php echo e($category->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['category_id'];
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mode</label>
                                            <select name="mode" class="form-control">
                                                <option value="Online"
                                                    <?php echo e(old('mode', $course->mode) == 'Online' ? 'selected' : ''); ?>>Online
                                                </option>
                                                <option value="On-campus"
                                                    <?php echo e(old('mode', $course->mode) == 'On-campus' ? 'selected' : ''); ?>>
                                                    On-campus</option>
                                                <option value="Hybrid"
                                                    <?php echo e(old('mode', $course->mode) == 'Hybrid' ? 'selected' : ''); ?>>Hybrid
                                                </option>
                                            </select>
                                            <?php $__errorArgs = ['mode'];
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Level</label>
                                            <select name="level" class="form-control">
                                                <option value="Intermediate"
                                                    <?php echo e(old('level', $course->level) == 'Intermediate' ? 'selected' : ''); ?>>
                                                    Intermediate</option>
                                                <option value="Beginner"
                                                    <?php echo e(old('level', $course->level) == 'Beginner' ? 'selected' : ''); ?>>
                                                    Beginner</option>
                                                <option value="Advanced"
                                                    <?php echo e(old('level', $course->level) == 'Advanced' ? 'selected' : ''); ?>>
                                                    Advanced</option>
                                            </select>
                                            <?php $__errorArgs = ['level'];
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

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="is_active" class="form-control">
                                                <option value="1"
                                                    <?php echo e(old('is_active', $course->is_active) == 1 ? 'selected' : ''); ?>>
                                                    Active
                                                </option>
                                                <option value="0"
                                                    <?php echo e(old('is_active', $course->is_active) == 0 ? 'selected' : ''); ?>>
                                                    Inactive
                                                </option>
                                            </select>
                                            <?php $__errorArgs = ['is_active'];
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

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount Offer</label>
                                            <select name="discount_offer" class="form-control">
                                                <option value="1"
                                                    <?php echo e(old('discount_offer', $course->discount_offer) == 1 ? 'selected' : ''); ?>>
                                                    Yes
                                                </option>
                                                <option value="0"
                                                    <?php echo e(old('discount_offer', $course->discount_offer) == 0 ? 'selected' : ''); ?> selected>
                                                    No
                                                </option>
                                            </select>
                                            <?php $__errorArgs = ['discount_offer'];
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

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full Fee</label>
                                            <input type="text" name="full_fee" class="form-control"
                                                value="<?php echo e($course->full_fee); ?>">
                                            <?php $__errorArgs = ['full_fee'];
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Discount (%)</label>
                                            <input type="text" name="discount" class="form-control"
                                                value="<?php echo e($course->discount); ?>" oninput="calculateMinFee()">
                                            <?php $__errorArgs = ['discount'];
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Min Fee</label>
                                            <input type="text" name="min_fee" class="form-control"
                                                value="<?php echo e($course->min_fee); ?>">
                                            <?php $__errorArgs = ['min_fee'];
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

                                <div id="interview-discount-wrapper" style="display: none;">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Interview Discount (%)</label>
                                                <input type="text" name="interview_discount_per" class="form-control"
                                                    value="<?php echo e($course->interview_discount_per); ?>">
                                                <?php $__errorArgs = ['interview_discount_per'];
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

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Interview Fee After Discount</label>
                                                <input type="text" name="interview_discount_amount"
                                                    class="form-control"
                                                    value="<?php echo e($course->interview_discount_amount); ?>">
                                                <?php $__errorArgs = ['interview_discount_amount'];
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
                                </div>

                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short_description" class="form-control" rows="3"><?php echo e($course->short_description); ?></textarea>
                                    <?php $__errorArgs = ['short_description'];
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
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="5"><?php echo e($course->description); ?></textarea>
                                    <?php $__errorArgs = ['description'];
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

                                <br>
                                <button type="submit" class="btn btn-primary">Update Course</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('additional-javascript'); ?>
    <script>
        $(function() {
            // validation needs name of the element
            $('#food').multiselect();

            // initialize after multiselect
            $('#basic-form').parsley();
        });
    </script>
    <script>
        function calculateMinFee() {
            const fullFee = parseFloat(document.querySelector('input[name="full_fee"]').value) || 0;
            const discount = parseFloat(document.querySelector('input[name="discount"]').value) || 0;

            if (fullFee > 0 && discount > 0) {
                const minFee = fullFee - ((fullFee * discount) / 100);
                document.querySelector('input[name="min_fee"]').value = minFee.toFixed(2);
            } else {
                document.querySelector('input[name="min_fee"]').value = '';
            }
        }

        // Trigger calculation on page load in case values already exist
        window.onload = calculateMinFee;
    </script>
    <script>
        function calculateInterviewDiscount() {
            const fullFee = parseFloat(document.querySelector('input[name="full_fee"]').value) || 0;
            const interviewDiscountPer = parseFloat(document.querySelector('input[name="interview_discount_per"]').value) ||
                0;

            if (fullFee > 0 && interviewDiscountPer > 0) {
                const discountAmount = (fullFee * interviewDiscountPer) / 100;
                const remainingFee = fullFee - discountAmount;
                document.querySelector('input[name="interview_discount_amount"]').value = remainingFee.toFixed(2);
            }
        }

        // show/hide interview section
        function toggleInterviewDiscountFields() {
            const offerSelect = document.querySelector('select[name="discount_offer"]');
            const wrapper = document.getElementById('interview-discount-wrapper');

            if (offerSelect.value === "1") {
                wrapper.style.display = 'block';
            } else {
                wrapper.style.display = 'none';

                document.querySelector('input[name="interview_discount_per"]').value = "";
                document.querySelector('input[name="interview_discount_amount"]').value = "";
            }
        }

        // event listeners
        document.querySelector('input[name="full_fee"]').addEventListener('input', calculateInterviewDiscount);
        document.querySelector('input[name="interview_discount_per"]').addEventListener('input',
            calculateInterviewDiscount);

        document.querySelector('select[name="discount_offer"]').addEventListener('change', toggleInterviewDiscountFields);

        // run on page load
        window.onload = function() {
            calculateMinFee();
            calculateInterviewDiscount();
            toggleInterviewDiscountFields();
        };
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/website/course/update-course.blade.php ENDPATH**/ ?>