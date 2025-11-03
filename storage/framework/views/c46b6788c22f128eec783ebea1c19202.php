

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Admissions</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('admission.index')); ?>" class="btn btn-sm btn-primary">All Admissions</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Student Admission</h2>
                        </div>
                        <div class="body">
                            <form id="admission-form" action="<?php echo e(route('admission.update', $admission->id)); ?>"
                                method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Course</label>
                                        <select name="course_id" id="course_id" class="form-control">
                                            <option value="">Select Course</option>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($course->id); ?>"
                                                    <?php echo e(old('course_id', $admission->course_id) == $course->id ? 'selected' : ''); ?>>
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
                                        <label>Batch</label>
                                        <select name="batch_id" id="batch_id" class="form-control">
                                            <option value="">Select Batch</option>
                                            <?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($batch->id); ?>"
                                                    data-fee="<?php echo e($batch->course->full_fee ?? 0); ?>"
                                                    <?php echo e(old('batch_id', $admission->batch_id) == $batch->id ? 'selected' : ''); ?>>
                                                    <?php echo e($batch->title); ?> <?php echo e($batch->shift ? "($batch->shift)" : ''); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['batch_id'];
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

                                <hr class="mt-4">

                                
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
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
                                    <div class="col-md-4">
                                        <label>Full Name</label>
                                        <input type="text" name="name" value="<?php echo e(old('name', $admission->name)); ?>"
                                            class="form-control">
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
                                    <div class="col-md-4">
                                        <label>CNIC</label>
                                        <input type="text" name="cnic" value="<?php echo e(old('cnic', $admission->cnic)); ?>"
                                            class="form-control">
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

                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label>Guardian Name</label>
                                        <input type="text" name="guardian_name"
                                            value="<?php echo e(old('guardian_name', $admission->guardian_name)); ?>"
                                            class="form-control">
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
                                        <input type="text" name="guardian_contact"
                                            value="<?php echo e(old('guardian_contact', $admission->guardian_contact)); ?>"
                                            class="form-control">
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
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" value="<?php echo e(old('dob', $admission->dob)); ?>"
                                            class="form-control">
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
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?php echo e(old('email', $admission->email)); ?>"
                                            class="form-control">
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
                                        <input type="text" name="phone" value="<?php echo e(old('phone', $admission->phone)); ?>"
                                            class="form-control">
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
                                    <div class="col-md-4">
                                        <label>Joining Date</label>
                                        <input type="date" name="joining_date"
                                            value="<?php echo e(old('joining_date', $admission->joining_date)); ?>"
                                            class="form-control">
                                        <?php $__errorArgs = ['joining_date'];
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

                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label>Status</label>
                                        <select name="student_status" class="form-control">
                                            <option value="active"
                                                <?php echo e(old('student_status', $admission->student_status) == 'active' ? 'selected' : ''); ?>>
                                                Active</option>
                                            <option value="unactive"
                                                <?php echo e(old('student_status', $admission->student_status) == 'unactive' ? 'selected' : ''); ?>>
                                                UnActive</option>
                                            <option value="completed"
                                                <?php echo e(old('student_status', $admission->student_status) == 'completed' ? 'selected' : ''); ?>>
                                                Completed</option>
                                        </select>
                                        <?php $__errorArgs = ['student_status'];
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
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="male"
                                                <?php echo e(old('gender', $admission->gender) == 'male' ? 'selected' : ''); ?>>Male
                                            </option>
                                            <option value="female"
                                                <?php echo e(old('gender', $admission->gender) == 'female' ? 'selected' : ''); ?>>
                                                Female</option>
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
                                            <?php $__currentLoopData = ['middle', 'metric', 'intermediate', 'graduate', 'm-phill']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($q); ?>"
                                                    <?php echo e(old('qualification', $admission->qualification) == $q ? 'selected' : ''); ?>>
                                                    <?php echo e(ucfirst($q)); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label>Last Institute</label>
                                        <input type="text" name="last_institute"
                                            value="<?php echo e(old('last_institute', $admission->last_institute)); ?>"
                                            class="form-control">
                                        <?php $__errorArgs = ['last_institute'];
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
                                        <div class="form-group">
                                            <label>Mode</label>
                                            <select id="mode" name="mode" class="form-control">
                                                <option value="physical"
                                                    <?php echo e(old('mode', $admission->mode) == 'physical' ? 'selected' : ''); ?>>
                                                    Physical
                                                </option>
                                                <option value="online"
                                                    <?php echo e(old('mode', $admission->mode) == 'online' ? 'selected' : ''); ?>>
                                                    Online
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
                                </div>
                                
                                <div class="col-md-12" id="online-percentage-wrapper" style="display:none;">
                                    <div class="form-group">
                                        <label>Online Fee Percentage (%)</label>
                                        <input type="number" min="0" max="100" step="1"
                                            name="online_percentage" class="form-control"
                                            value="<?php echo e(old('online_percentage', $admission->online_percentage ?? 50)); ?>"
                                            placeholder="e.g. 50">
                                        <small class="text-muted">This % of the paid fee goes to the teacher for online
                                            students.</small>
                                        <?php $__errorArgs = ['online_percentage'];
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
                                    <div class="col-md-12">
                                        <label for="referral_type">Referral Type</label>
                                        <select name="referral_type" id="referral_type" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="ads"
                                                <?php echo e(old('referral_type', $admission->referral_type) == 'ads' ? 'selected' : ''); ?>>
                                                Ads</option>
                                            <option value="referral"
                                                <?php echo e(old('referral_type', $admission->referral_type) == 'referral' ? 'selected' : ''); ?>>
                                                Referral</option>
                                            <option value="other"
                                                <?php echo e(old('referral_type', $admission->referral_type) == 'other' ? 'selected' : ''); ?>>
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

                                
                                <div class="row mt-3" id="referral_details_section" style="display:none;">
                                    <div class="col-md-4">
                                        <label>Referral Source</label>
                                        <input type="text" name="referral_source"
                                            value="<?php echo e(old('referral_source', $admission->referral_source)); ?>"
                                            class="form-control">
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
                                    <div class="col-md-4">
                                        <label>Source Contact #</label>
                                        <input type="number" name="referral_source_contact"
                                            value="<?php echo e(old('referral_source_contact', $admission->referral_source_contact)); ?>"
                                            class="form-control">
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
                                    <div class="col-md-4">
                                        <label>Source Commission (%)</label>
                                        <input type="number" name="referral_source_commission"
                                            value="<?php echo e(old('referral_source_commission', $admission->referral_source_commission)); ?>"
                                            class="form-control">
                                        <?php $__errorArgs = ['referral_source_commission'];
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
                                    <textarea name="address" class="form-control" rows="3"><?php echo e(old('address', $admission->address)); ?></textarea>
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

                                <hr class="mt-4">

                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Total Fee</label>
                                        <input type="number" id="full_fee" name="full_fee" class="form-control"
                                            value="<?php echo e(old('full_fee', $admission->full_fee)); ?>">
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

                                    <div class="col-md-12">
                                        <label class="form-label">Payment Type</label>
                                        <div class="d-flex flex-column">
                                            <label><input type="radio" name="payment_type" value="full_fee"
                                                    <?php echo e(old('payment_type', $admission->payment_type) == 'full_fee' ? 'checked' : ''); ?>>
                                                Full Payment</label>
                                            <label><input type="radio" name="payment_type" value="installment"
                                                    <?php echo e(old('payment_type', $admission->payment_type) == 'installment' ? 'checked' : ''); ?>>
                                                Installments</label>
                                        </div>
                                        <?php $__errorArgs = ['payment_type'];
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

                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <label>Calculated Total (after options)</label>
                                            <input type="text" id="calculated_total" class="form-control"
                                                value="0" readonly>
                                            <input type="hidden" id="calculated_total_input" name="calculated_total"
                                                value="0">
                                            <small id="calculated_breakdown" class="text-muted d-block mt-1"></small>
                                        </div>
                                    </div>

                                    
                                    <div id="installment-section"
                                        style="<?php echo e(old('payment_type', $admission->payment_type) == 'installment' ? '' : 'display:none;'); ?>"
                                        class="mt-3">

                                        
                                        <div class="row mb-2" style="margin-top:-15px">
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="apply_additional_charges" name="apply_additional_charges"
                                                        value="1"
                                                        <?php echo e(old('apply_additional_charges', $applyExtraDefault ?? false) ? 'checked' : ''); ?>>
                                                    <small class="form-check-label" for="apply_additional_charges">
                                                        Apply additional charges — ₨1000 per installment
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label>Installment Count</label>
                                                <select id="installment_count" name="installment_count"
                                                    class="form-control">
                                                    <option value="2"
                                                        <?php echo e((int) old('installment_count', $preCount ?? 3) === 2 ? 'selected' : ''); ?>>
                                                        2 Installments</option>
                                                    <option value="3"
                                                        <?php echo e((int) old('installment_count', $preCount ?? 3) === 3 ? 'selected' : ''); ?>>
                                                        3 Installments</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Installment 1</label>
                                                <input type="number" name="installment_1" id="installment_1"
                                                    class="form-control"
                                                    value="<?php echo e(old('installment_1', $admission->installment_1)); ?>">
                                                <?php $__errorArgs = ['installment_1'];
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
                                                <label>Installment 2</label>
                                                <input type="number" name="installment_2" id="installment_2"
                                                    class="form-control"
                                                    value="<?php echo e(old('installment_2', $admission->installment_2)); ?>">
                                                <?php $__errorArgs = ['installment_2'];
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
                                            <div class="col-md-4" id="installment_3_wrapper">
                                                <label>Installment 3</label>
                                                <input type="number" name="installment_3" id="installment_3"
                                                    class="form-control"
                                                    value="<?php echo e(old('installment_3', $admission->installment_3)); ?>">
                                                <?php $__errorArgs = ['installment_3'];
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

                                    <button type="submit" class="btn btn-primary mt-4">Update Admission</button>
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
        // ---------- Constants ----------
        const PER_INSTALLMENT_CHARGE = 1000;

        // ---------- Helpers ----------
        function getPaymentType() {
            return $('input[name="payment_type"]:checked').val();
        }

        function getInstallmentCount() {
            return parseInt($('#installment_count').val() || '3', 10);
        }

        function computeTotalParts() {
            const isInstallment = getPaymentType() === 'installment';
            const count = isInstallment ? getInstallmentCount() : 0;
            const applyExtra = isInstallment && $('#apply_additional_charges').is(':checked');
            const base = Number.isFinite(+$('#full_fee').val()) ? +$('#full_fee').val() : 0;
            const extra = applyExtra ? (PER_INSTALLMENT_CHARGE * count) : 0;
            const total = base + extra;
            return {
                base,
                extra,
                total,
                count,
                applyExtra,
                isInstallment
            };
        }

        function renderTotal() {
            const p = computeTotalParts();
            $('#calculated_total').val(p.total);
            $('#calculated_total_input').val(p.total);
            if (p.applyExtra && p.isInstallment) {
                $('#calculated_breakdown').text(
                    `Base: ₨${p.base} + Extra: ₨${PER_INSTALLMENT_CHARGE} × ${p.count} = ₨${p.extra}`);
            } else {
                $('#calculated_breakdown').text(`Base: ₨${p.base}`);
            }
        }

        function autoDistributeInstallments() {
            const {
                total
            } = computeTotalParts();
            const count = getInstallmentCount();
            if (count === 2) {
                const first = Math.ceil(total / 2);
                const second = total - first;
                $('#installment_1').val(first);
                $('#installment_2').val(second);
                $('#installment_3').val('');
            } else {
                const part = Math.floor(total / 3);
                const third = total - (part * 2);
                $('#installment_1').val(part);
                $('#installment_2').val(part);
                $('#installment_3').val(third);
            }
            renderTotal();
        }

        // ---------- Smart manual rebalance (fixes remaining not moving) ----------
        let isAdjusting = false;

        function adjustRemainingInstallments(editedId = null) {
            if (isAdjusting) return;
            const {
                total
            } = computeTotalParts();
            const count = getInstallmentCount();

            let i1 = Math.max(parseInt($('#installment_1').val() || '0', 10), 0);
            let i2 = Math.max(parseInt($('#installment_2').val() || '0', 10), 0);
            let i3 = Math.max(parseInt($('#installment_3').val() || '0', 10), 0);

            isAdjusting = true;

            if (count === 2) {
                i1 = Math.min(i1, total);
                i2 = Math.max(total - i1, 0);
                i3 = 0;
            } else {
                const remainingAfterI1 = Math.max(total - i1, 0);

                if (editedId === 'installment_1') {
                    if (i2 > remainingAfterI1) {
                        i2 = remainingAfterI1;
                        i3 = 0;
                    } else {
                        i3 = Math.max(remainingAfterI1 - i2, 0);
                    }
                } else if (editedId === 'installment_2') {
                    i2 = Math.min(i2, remainingAfterI1);
                    i3 = Math.max(remainingAfterI1 - i2, 0);
                } else if (editedId === 'installment_3') {
                    i3 = Math.min(i3, remainingAfterI1);
                    i2 = Math.max(remainingAfterI1 - i3, 0);
                } else {
                    if (i2 > remainingAfterI1) {
                        i2 = remainingAfterI1;
                        i3 = 0;
                    } else {
                        i3 = Math.max(remainingAfterI1 - i2, 0);
                    }
                }

                // Safety: clamp to total
                const sum = i1 + i2 + i3;
                if (sum !== total) {
                    const diff = total - sum; // positive -> need to add
                    if (diff > 0) {
                        if (i3 || editedId !== 'installment_2') i3 += diff;
                        else i2 += diff;
                    } else if (diff < 0) {
                        let need = -diff;
                        const cut3 = Math.min(i3, need);
                        i3 -= cut3;
                        need -= cut3;
                        if (need > 0) i2 = Math.max(i2 - need, 0);
                    }
                }
            }

            $('#installment_1').val(i1);
            $('#installment_2').val(i2);
            $('#installment_3').val(count === 3 ? i3 : '');

            renderTotal();
            isAdjusting = false;
        }

        // ---------- Referral toggle ----------
        function toggleReferralFields() {
            const selected = ($('#referral_type').val() || '').toLowerCase();
            const $section = $('#referral_details_section');
            if (selected === 'referral') {
                $section.css('display', 'flex');
            } else {
                $section.hide();
                $section.find('input').val('');
            }
        }

        // ---------- Events ----------
        // Course -> Batches
        $('#course_id').on('change', function() {
            let courseId = $(this).val();
            $('#batch_id').html('<option>Loading...</option>');
            $.get(`<?php echo e(url('get-batches')); ?>/${courseId}`, function(data) {
                let html = '<option value="">Select Batch</option>';
                data.forEach(b => {
                    const fee = b.course?.full_fee ?? 0;
                    const shift = b.shift ? ` (${b.shift})` : '';
                    html += `<option value="${b.id}" data-fee="${fee}">${b.title}${shift}</option>`;
                });
                $('#batch_id').html(html);
            });
        });

        // Batch sets fee -> redistribute
        $('#batch_id').on('change', function() {
            const fee = parseInt($(this).find(':selected').data('fee') || '0', 10);
            $('#full_fee').val(fee);
            autoDistributeInstallments();
        });

        // Manual fee edit
        $('#full_fee').on('input', function() {
            autoDistributeInstallments();
        });

        // Payment type toggle
        $('input[name="payment_type"]').on('change', function() {
            if (getPaymentType() === 'installment') {
                $('#installment-section').show();
                $('#apply_additional_charges').prop('disabled', false);
                autoDistributeInstallments();
            } else {
                $('#installment-section').hide();
                $('#apply_additional_charges').prop('checked', false).prop('disabled', true);
                renderTotal();
            }
        });

        // Installment count change
        $('#installment_count').on('change', function() {
            const count = getInstallmentCount();
            if (count === 2) {
                $('#installment_3_wrapper').hide();
                $('#installment_3').val('');
            } else {
                $('#installment_3_wrapper').show();
            }
            autoDistributeInstallments();
        });

        // Extra charges toggled
        $(document).on('change', '#apply_additional_charges', function() {
            autoDistributeInstallments();
        });

        // Manual edit listeners on ALL three fields
        $('#installment_1, #installment_2, #installment_3').on('input', function() {
            adjustRemainingInstallments(this.id);
        });

        // Referral type toggle
        $('#referral_type').on('change', toggleReferralFields);

        // ---------- Initial state ----------
        $(document).ready(function() {
            // Installment 3 visibility
            const count = getInstallmentCount();
            if (count === 2) {
                $('#installment_3_wrapper').hide();
            } else {
                $('#installment_3_wrapper').show();
            }

            // Referral details visibility
            toggleReferralFields();

            // Show/hide installment panel
            if (getPaymentType() === 'installment') {
                $('#installment-section').show();
                $('#apply_additional_charges').prop('disabled', false);
            } else {
                $('#installment-section').hide();
                $('#apply_additional_charges').prop('checked', false).prop('disabled', true);
            }

            // If installments have values, just recompute total; else distribute
            const hasAny = ($('#installment_1').val() || $('#installment_2').val() || $('#installment_3').val());
            if (getPaymentType() === 'installment') {
                if (hasAny) renderTotal();
                else autoDistributeInstallments();
            } else {
                renderTotal();
            }
        });

        //show fee submission Percentage
        (function() {
            function toggleOnlinePercentage() {
                const modeSelect = document.getElementById('mode');
                const wrapper = document.getElementById('online-percentage-wrapper');
                if (!modeSelect || !wrapper) return;

                if (modeSelect.value === 'online') {
                    wrapper.style.display = 'block';
                } else {
                    wrapper.style.display = 'none';
                }
            }

            document.addEventListener('DOMContentLoaded', toggleOnlinePercentage);
            document.getElementById('mode').addEventListener('change', toggleOnlinePercentage);
        })();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/admission/update.blade.php ENDPATH**/ ?>