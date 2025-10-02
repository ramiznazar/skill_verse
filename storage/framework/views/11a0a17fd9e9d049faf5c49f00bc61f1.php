

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Leads</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('lead.index')); ?>" class="btn btn-sm btn-primary" title="">All Leads</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Lead</h2>
                        </div>
                        <div class="body">
                            <form id="lead-form" action="<?php echo e(route('lead.update', $lead->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="hidden" name="lead_type" value="admin">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Course</label>
                                        <select name="course_id" class="form-control">
                                            <option value="">Select Course</option>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($course->id); ?>"
                                                    <?php echo e(old('course_id', $lead->course_id) == $course->id ? 'selected' : ''); ?>>
                                                    <?php echo e($course->title); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['course_id'];
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

                                    <div class="col-md-6">
                                        <label>Full Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="<?php echo e(old('name', $lead->name)); ?>">
                                        <?php $__errorArgs = ['name'];
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

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Guardian Name</label>
                                        <input type="text" name="guardian_name" class="form-control"
                                            value="<?php echo e(old('guardian_name', $lead->guardian_name)); ?>">
                                        <?php $__errorArgs = ['guardian_name'];
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

                                    <div class="col-md-4">
                                        <label>Guardian Contact</label>
                                        <input type="text" name="guardian_contact" class="form-control"
                                            value="<?php echo e(old('guardian_contact', $lead->guardian_contact)); ?>">
                                        <?php $__errorArgs = ['guardian_contact'];
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

                                    <div class="col-md-4">
                                        <label>CNIC</label>
                                        <input type="text" name="cnic" class="form-control"
                                            value="<?php echo e(old('cnic', $lead->cnic)); ?>">
                                        <?php $__errorArgs = ['cnic'];
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

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" class="form-control"
                                            value="<?php echo e(old('dob', optional(\Carbon\Carbon::parse($lead->dob))->format('Y-m-d'))); ?>">
                                        <?php $__errorArgs = ['dob'];
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

                                    <div class="col-md-4">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="<?php echo e(old('email', $lead->email)); ?>">
                                        <?php $__errorArgs = ['email'];
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

                                    <div class="col-md-4">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="<?php echo e(old('phone', $lead->phone)); ?>">
                                        <?php $__errorArgs = ['phone'];
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

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="male"
                                                <?php echo e(old('gender', $lead->gender) == 'male' ? 'selected' : ''); ?>>Male
                                            </option>
                                            <option value="female"
                                                <?php echo e(old('gender', $lead->gender) == 'female' ? 'selected' : ''); ?>>Female
                                            </option>
                                        </select>
                                        <?php $__errorArgs = ['gender'];
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

                                    <div class="col-md-4">
                                        <label>Qualification</label>
                                        <select name="qualification" class="form-control">
                                            <option value="">Select</option>
                                            <option value="middle"
                                                <?php echo e(old('qualification', $lead->qualification) == 'middle' ? 'selected' : ''); ?>>
                                                Middle</option>
                                            <option value="metric"
                                                <?php echo e(old('qualification', $lead->qualification) == 'metric' ? 'selected' : ''); ?>>
                                                Metric</option>
                                            <option value="intermediate"
                                                <?php echo e(old('qualification', $lead->qualification) == 'intermediate' ? 'selected' : ''); ?>>
                                                Intermediate</option>
                                            <option value="graduate"
                                                <?php echo e(old('qualification', $lead->qualification) == 'graduate' ? 'selected' : ''); ?>>
                                                Graduate</option>
                                            <option value="m-phill"
                                                <?php echo e(old('qualification', $lead->qualification) == 'm-phill' ? 'selected' : ''); ?>>
                                                M Phill</option>
                                        </select>
                                        <?php $__errorArgs = ['qualification'];
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

                                    <div class="col-md-4">
                                        <label>Lead Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="new"
                                                <?php echo e(old('status', $lead->status ?? '') == 'new' ? 'selected' : ''); ?>>New
                                            </option>
                                            <option value="contacted"
                                                <?php echo e(old('status', $lead->status ?? '') == 'contacted' ? 'selected' : ''); ?>>
                                                Contacted</option>
                                            <option value="converted"
                                                <?php echo e(old('status', $lead->status ?? '') == 'converted' ? 'selected' : ''); ?>>
                                                Converted</option>
                                            <option value="lost"
                                                <?php echo e(old('status', $lead->status ?? '') == 'lost' ? 'selected' : ''); ?>>Lost
                                            </option>
                                        </select>
                                        <?php $__errorArgs = ['status'];
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

                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label>Full Fee</label>
                                        <input type="text" name="full_fee" class="form-control"
                                            value="<?php echo e(old('full_fee', $lead->full_fee)); ?>">
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

                                    <div class="col-md-6">
                                        <label for="referral_type">Referral Type</label>
                                        <select name="referral_type" id="referral_type" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="ads"
                                                <?php echo e(old('referral_type', $lead->referral_type) == 'ads' ? 'selected' : ''); ?>>
                                                Ads</option>
                                            <option value="referral"
                                                <?php echo e(old('referral_type', $lead->referral_type) == 'referral' ? 'selected' : ''); ?>>
                                                Referral</option>
                                            <option value="other"
                                                <?php echo e(old('referral_type', $lead->referral_type) == 'other' ? 'selected' : ''); ?>>
                                                Other</option>
                                        </select>
                                        <?php $__errorArgs = ['referral_type'];
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

                                
                                <?php
                                    $showReferral = old('referral_type', $lead->referral_type) === 'referral';
                                ?>
                                <div class="row mt-3" id="referral_details_section"
                                    style="display: <?php echo e($showReferral ? 'flex' : 'none'); ?>;">
                                    <div class="col-md-6">
                                        <label>Referral Source</label>
                                        <input type="text" name="referral_source" class="form-control"
                                            value="<?php echo e(old('referral_source', $lead->referral_source)); ?>">
                                        <?php $__errorArgs = ['referral_source'];
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

                                    <div class="col-md-6">
                                        <label>Referral Source Contact</label>
                                        <input type="text" name="referral_source_contact" class="form-control"
                                            value="<?php echo e(old('referral_source_contact', $lead->referral_source_contact)); ?>">
                                        <?php $__errorArgs = ['referral_source_contact'];
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

                                <div class="form-group mt-3">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" rows="3"><?php echo e(old('address', $lead->address)); ?></textarea>
                                    <?php $__errorArgs = ['address'];
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

                                <button type="submit" class="btn btn-primary mt-4">Update Lead</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Parsley validation (ensure the ID matches the form)
            if (window.jQuery && $('#lead-form').length) {
                $('#lead-form').parsley && $('#lead-form').parsley();
            }

            const referralType = document.getElementById('referral_type');
            const referralDetails = document.getElementById('referral_details_section');

            function toggleReferralFields() {
                const selected = referralType.value;
                if (selected === 'referral') {
                    referralDetails.style.display = 'flex';
                } else {
                    referralDetails.style.display = 'none';
                    referralDetails.querySelectorAll('input').forEach(i => i.value = '');
                }
            }

            // initial state (covers server-rendered state + back/validation)
            toggleReferralFields();

            referralType.addEventListener('change', toggleReferralFields);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/lead/update.blade.php ENDPATH**/ ?>