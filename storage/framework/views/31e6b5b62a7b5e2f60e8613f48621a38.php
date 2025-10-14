
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Admissions</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('admission.index')); ?>" class="btn btn-sm btn-primary" title="">All Admissions</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Student</h2>
                        </div>
                        <div class="body">

                            <form id="admission-form" action="<?php echo e(route('admission.store')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Course</label>
                                            <select name="course_id" id="course_id" class="form-control" required>
                                                <option value="">Select Course</option>
                                                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($course->id); ?>"
                                                        <?php echo e(old('course_id', $lead->course_id ?? '') == $course->id ? 'selected' : ''); ?>>
                                                        <?php echo e($course->title); ?></option>
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
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Batch</label>
                                            <select name="batch_id" id="batch_id" class="form-control" required>
                                                <option value="">Select Batch</option>
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
                                </div>

                                <hr class="mt-4">

                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
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
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="name"
                                                value="<?php echo e(old('name', $lead->name ?? '')); ?>" class="form-control" required>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>CNIC</label>
                                            <input type="text" name="cnic"
                                                value="<?php echo e(old('cnic', $lead->cnic ?? '')); ?>" class="form-control">
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
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Guardian Name</label>
                                            <input type="text" name="guardian_name"
                                                value="<?php echo e(old('guardian_name', $lead->guardian_name ?? '')); ?>"
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
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Guardian Contact</label>
                                            <input type="text" name="guardian_contact"
                                                value="<?php echo e(old('guardian_contact', $lead->guardian_contact ?? '')); ?>"
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
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="date" name="dob" value="<?php echo e(old('dob', $lead->dob ?? '')); ?>"
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
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email"
                                                value="<?php echo e(old('email', $lead->email ?? '')); ?>" class="form-control">
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
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone"
                                                value="<?php echo e(old('phone', $lead->phone ?? '')); ?>" class="form-control"
                                                required>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Joining Date</label>
                                            <input type="date" name="joining_date" value="<?php echo e(old('joining_date')); ?>"
                                                class="form-control" required>
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
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="student_status" class="form-control">
                                                <option value="active"
                                                    <?php echo e(old('student_status') == 'active' ? 'selected' : ''); ?>>
                                                    Active</option>
                                                <option value="unactive"
                                                    <?php echo e(old('student_status') == 'unactive' ? 'selected' : ''); ?> selected>
                                                    UnActive</option>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="">Select Gender</option>
                                                <option value="male" <?php echo e(old('gender') == 'male' ? 'selected' : ''); ?>>
                                                    Male</option>
                                                <option value="female" <?php echo e(old('gender') == 'female' ? 'selected' : ''); ?>>
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
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Qualification</label>
                                            <select name="qualification" class="form-control">
                                                <option value="middle"
                                                    <?php echo e(old('qualification', $lead->qualification ?? '') == 'middle' ? 'selected' : ''); ?>>
                                                    Middle</option>
                                                <option value="metric"
                                                    <?php echo e(old('qualification', $lead->qualification ?? '') == 'metric' ? 'selected' : ''); ?>>
                                                    Metric</option>
                                                <option value="intermediate"
                                                    <?php echo e(old('qualification', $lead->qualification ?? '') == 'intermediate' ? 'selected' : ''); ?>>
                                                    Intermediate</option>
                                                <option value="graduate"
                                                    <?php echo e(old('qualification', $lead->qualification ?? '') == 'graduate' ? 'selected' : ''); ?>>
                                                    Graduate</option>
                                                <option value="m-phill"
                                                    <?php echo e(old('qualification', $lead->qualification ?? '') == 'm-phill' ? 'selected' : ''); ?>>
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
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Institute</label>
                                            <input type="text" name="last_institute"
                                                value="<?php echo e(old('last_institute', $lead->last_institute ?? '')); ?>"
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
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mode</label>
                                            <select id="mode" name="mode" class="form-control">
                                                <option value="physical"
                                                    <?php echo e(old('mode', $admission->mode ?? 'physical') == 'physical' ? 'selected' : ''); ?>>
                                                    Physical</option>
                                                <option value="online"
                                                    <?php echo e(old('mode', $admission->mode ?? '') == 'online' ? 'selected' : ''); ?>>
                                                    Online</option>
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

                                <div class="row mt-3">
                                    <div class="col-md-12" id="online-percentage-wrapper" style="display:none;">
                                        <div class="form-group">
                                            <label>Online Fee Percentage (%)</label>
                                            <input type="number" min="0" max="100" step="1"
                                                name="online_percentage" class="form-control"
                                                value="<?php echo e(old('online_percentage', $admission->online_percentage ?? 50)); ?>"
                                                placeholder="e.g. 50">
                                            <small class="text-muted">This % of the paid fee goes to the teacher for this
                                                online student.</small>
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
                                </div>

                                
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="referral_type">Referral Type</label>
                                        <select name="referral_type" id="referral_type" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="ads"
                                                <?php echo e(old('referral_type', $lead->referral_type ?? '') == 'ads' ? 'selected' : ''); ?>>
                                                Ads</option>
                                            <option value="referral"
                                                <?php echo e(old('referral_type', $lead->referral_type ?? '') == 'referral' ? 'selected' : ''); ?>>
                                                Referral</option>
                                            <option value="other"
                                                <?php echo e(old('referral_type', $lead->referral_type ?? '') == 'other' ? 'selected' : ''); ?>>
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

                                <div class="row mt-3" id="referral_details_section" style="display: none;">
                                    <div class="col-md-4">
                                        <label>Referral Source</label>
                                        <input type="text" name="referral_source"
                                            value="<?php echo e(old('referral_source', $lead->referral_source ?? '')); ?>"
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
                                            value="<?php echo e(old('referral_source_contact', $lead->referral_source_contact ?? '')); ?>"
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
                                            value="<?php echo e(old('referral_source_commission')); ?>" class="form-control">
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
                                    <textarea name="address" class="form-control" rows="3"><?php echo e(old('address', $lead->address ?? '')); ?></textarea>
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
                                            value="<?php echo e(old('full_fee')); ?>">
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
                                                    <?php echo e(old('payment_type') == 'full_fee' ? 'checked' : ''); ?>> Full
                                                Payment</label>
                                            <label><input type="radio" name="payment_type" value="installment"
                                                    <?php echo e(old('payment_type') == 'installment' ? 'checked' : ''); ?>>
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

                                    
                                    <div class="col-md-12 mt-2">
                                        <label>Calculated Total (after options)</label>
                                        <input type="text" id="calculated_total" class="form-control" value="0"
                                            readonly>
                                        
                                        
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="apply_additional_charges" name="apply_additional_charges"
                                                        value="1"
                                                        <?php echo e(old('apply_additional_charges') ? 'checked' : ''); ?>>
                                                    <small class="form-check-label" for="apply_additional_charges">
                                                        (Apply additional charges — ₨1000 per installment)
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <div id="installment-section" style="display: none;" class="mt-3">


                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label>Installment Count</label>
                                            <select id="installment_count" class="form-control">
                                                <option value="2">2 Installments</option>
                                                <option value="3" selected>3 Installments</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Installment 1</label>
                                            <input type="number" name="installment_1" id="installment_1"
                                                class="form-control" value="<?php echo e(old('installment_1')); ?>">
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
                                                class="form-control" value="<?php echo e(old('installment_2')); ?>">
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
                                                class="form-control" value="<?php echo e(old('installment_3')); ?>">
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

                                <button type="submit" class="btn btn-primary mt-4">Submit Admission</button>
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
        // Load batches by course
        $('#course_id').on('change', function() {
            let courseId = $(this).val();
            $('#batch_id').html('<option>Loading...</option>');
            $.get(`get-batches/${courseId}`, function(data) {
                let html = '<option value="">Select Batch</option>';
                data.forEach(batch => {
                    html +=
                        `<option value="${batch.id}" data-fee="${batch.course.min_fee}">${batch.title} (${batch.shift})</option>`;
                });
                $('#batch_id').html(html);
            });
        });

        let fullFee = 0;
        const PER_INSTALLMENT_CHARGE = 1000;

        // When batch is selected, set fee value
        $('#batch_id').on('change', function() {
            let fee = $(this).find(':selected').data('fee') || 0;
            fullFee = parseInt(fee) || 0;
            $('#full_fee').val(fullFee);
            autoDistributeInstallments();
        });

        // When admin edits the fee manually
        $('#full_fee').on('input', function() {
            fullFee = parseInt($(this).val() || 0);
            autoDistributeInstallments();
        });

        // Toggle section on payment type
        $('input[name="payment_type"]').on('change', function() {
            if ($(this).val() === 'installment') {
                $('#installment-section').show();
                $('#apply_additional_charges').prop('disabled', false);
                autoDistributeInstallments();
            } else {
                $('#installment-section').hide();
                $('#apply_additional_charges').prop('checked', false).prop('disabled', true);
                renderTotal(); // refresh calculated total for full payment
            }
        });

        // Handle installment count dropdown change
        $('#installment_count').on('change', function() {
            let count = parseInt($(this).val());
            if (count === 2) {
                $('#installment_3_wrapper').hide();
                $('#installment_3').val('');
            } else {
                $('#installment_3_wrapper').show();
            }
            autoDistributeInstallments();
        });

        // Recalc when additional charges checkbox is toggled
        $(document).on('change', '#apply_additional_charges', function() {
            autoDistributeInstallments();
        });

        // Manual edit of installments (1 and 2) triggers recalculation of remaining
        $('#installment_1, #installment_2').on('input', function() {
            adjustRemainingInstallments();
        });

        // --- Totals helpers ---
        function computeTotalParts() {
            const paymentType = $('input[name="payment_type"]:checked').val();
            const isInstallment = paymentType === 'installment';
            const count = parseInt($('#installment_count').val()) || 0;
            const applyExtra = $('#apply_additional_charges').is(':checked');

            const base = parseInt(fullFee) || 0;
            const extra = (isInstallment && applyExtra) ? (PER_INSTALLMENT_CHARGE * count) : 0;
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
            if (p.applyExtra && p.isInstallment) {
                $('#calculated_breakdown').text(
                    `Base: ₨${p.base} + Extra: ₨${PER_INSTALLMENT_CHARGE} × ${p.count} = ₨${p.extra}`);
            } else {
                $('#calculated_breakdown').text(`Base: ₨${p.base}`);
            }
        }

        // Distribute fee across installments
        function autoDistributeInstallments() {
            const count = parseInt($('#installment_count').val());
            const total = computeTotalParts().total;

            if (count === 2) {
                const half = Math.ceil(total / 2);
                $('#installment_1').val(half);
                $('#installment_2').val(total - half);
                $('#installment_3').val('');
            } else {
                const part = Math.floor(total / 3);
                const remain = total - (part * 2);
                $('#installment_1').val(part);
                $('#installment_2').val(part);
                $('#installment_3').val(remain);
            }
            renderTotal();
        }

        // Re-adjust remaining amount based on admin input
        function adjustRemainingInstallments() {
            const count = parseInt($('#installment_count').val());
            const total = computeTotalParts().total;

            const inst1 = parseInt($('#installment_1').val()) || 0;
            const inst2 = parseInt($('#installment_2').val()) || 0;

            if (count === 2) {
                $('#installment_2').val(Math.max(total - inst1, 0));
                $('#installment_3').val('');
            } else {
                const inst3 = total - inst1 - inst2;
                $('#installment_3').val(inst3 > 0 ? inst3 : 0);
            }
            renderTotal();
        }

        // Referral logic toggle
        document.addEventListener('DOMContentLoaded', function() {
            const referralType = document.getElementById('referral_type');
            const referralDetails = document.getElementById('referral_details_section');

            function toggleReferralFields() {
                const selected = referralType.value;
                if (selected === 'referral') {
                    referralDetails.style.display = 'flex';
                } else {
                    referralDetails.style.display = 'none';
                    referralDetails.querySelectorAll('input').forEach(input => input.value = '');
                }
            }

            toggleReferralFields();
            referralType.addEventListener('change', toggleReferralFields);

            // Initialize payment section visibility/state
            const paymentType = $('input[name="payment_type"]:checked').length ?
                $('input[name="payment_type"]:checked').val() :
                null;

            if (paymentType === 'installment') {
                $('#installment-section').show();
                $('#apply_additional_charges').prop('disabled', false);
            } else {
                $('#installment-section').hide();
                $('#apply_additional_charges').prop('checked', false).prop('disabled', true);
            }

            // Respect current count for visibility of installment 3
            const count = parseInt($('#installment_count').val());
            if (count === 2) {
                $('#installment_3_wrapper').hide();
                $('#installment_3').val('');
            } else {
                $('#installment_3_wrapper').show();
            }

            // Initial totals render
            autoDistributeInstallments();
        });

        //show fee submission Percentage
        (function() {
            function toggleOnlinePercent() {
                var mode = document.getElementById('mode').value;
                var w = document.getElementById('online-percentage-wrapper');
                if (mode === 'online') {
                    w.style.display = 'block';
                } else {
                    w.style.display = 'none';
                }
            }
            document.getElementById('mode').addEventListener('change', toggleOnlinePercent);
            // initial on load
            toggleOnlinePercent();
        })();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/admission/create.blade.php ENDPATH**/ ?>