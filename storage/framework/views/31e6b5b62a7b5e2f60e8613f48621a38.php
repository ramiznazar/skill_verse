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
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Select Course(s)</label>
                                            <select name="course_ids[]" id="course_id" class="form-control selectpicker"
                                                multiple required data-live-search="true"
                                                title="Choose one or more courses">
                                                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($course->id); ?>"
                                                        <?php echo e(collect(old('course_ids', []))->contains($course->id) || (isset($prefill) && $prefill->course_id == $course->id) ? 'selected' : ''); ?>>
                                                        <?php echo e($course->title); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <small class="form-text text-muted">
                                                Hold <b>CTRL</b> (Windows) or <b>CMD</b> (Mac) to select multiple.
                                            </small>
                                            <?php $__errorArgs = ['course_ids'];
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

                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Batch & Fee Details</label>
                                            <div id="batch-container" class="row">
                                                <!-- Dynamic course + batch + fee cards will load here -->
                                            </div>
                                            <?php $__errorArgs = ['batch_ids'];
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
                                                value="<?php echo e(old('name', $prefill->name ?? $lead->name ?? '')); ?>" class="form-control" required>
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
                                                value="<?php echo e(old('email', $prefill->email ?? $lead->email ?? '')); ?>" class="form-control">
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
                                                value="<?php echo e(old('phone', $prefill->phone ?? $lead->phone ?? '')); ?>" class="form-control"
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
                                                <option value="completed"
                                                    <?php echo e(old('student_status') == 'completed' ? 'selected' : ''); ?>>
                                                    Completed
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
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
                                        <label>Registration Fee</label>
                                        <input type="number" name="registration_fee" class="form-control"
                                            value="<?php echo e(old('registration_fee', 0)); ?>" min="0">
                                        <?php $__errorArgs = ['registration_fee'];
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
        // Load batches for each selected course
        $('#course_id').on('change', function() {
            let selectedCourses = $(this).val() || [];
            if (selectedCourses && selectedCourses.length > 0) {
                renderCourseBlocks(selectedCourses);
            }
        });

        // Auto-load course and batch if coming from booking
        <?php if(isset($prefill) && $prefill->course_id): ?>
            $(document).ready(function() {
                // Wait for selectpicker to initialize
                setTimeout(function() {
                    // Get the course ID and batch ID from prefill
                    let courseId = <?php echo e($prefill->course_id); ?>;
                    <?php if($prefill->batch_id): ?>
                        let batchId = <?php echo e($prefill->batch_id); ?>;
                    <?php else: ?>
                        let batchId = null;
                    <?php endif; ?>
                    
                    // Set the course value
                    $('#course_id').val([courseId]);
                    
                    // Refresh selectpicker
                    if ($('#course_id').data('selectpicker')) {
                        $('#course_id').selectpicker('refresh');
                    }
                    
                    // Manually trigger renderCourseBlocks to load batches with prefill batch ID
                    renderCourseBlocks([courseId], batchId);
                }, 800);
            });
        <?php endif; ?>

        // render course blocks based on number of courses
        function renderCourseBlocks(selectedCourses, prefillBatchId = null) {
            $('#batch-container').empty();
            if (selectedCourses.length === 0) return;

            let colSize = selectedCourses.length === 1 ? 'col-12' : 'col-md-6';

            selectedCourses.forEach(courseId => {
                const courseTitle = $('#course_id option[value="' + courseId + '"]').text();

                let courseBlock = $(`
            <div class="${colSize} mb-3 course-col" data-course="${courseId}">
                <div class="course-block p-3 border rounded">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="mb-0 font-weight-bold">${courseTitle}</label>
                        <button type="button" class="btn btn-link text-danger p-0 remove-course-btn" data-course="${courseId}">
                            ✕ Remove
                        </button>
                    </div>
                    <select name="batch_ids[]" class="form-control batch-select mb-2" required>
                        <option value="">Loading...</option>
                    </select>
                    <input type="number" name="course_fees[]" class="form-control course-fee-input" placeholder="Auto or manual entry" readonly>
                </div>
            </div>
        `);

                $('#batch-container').append(courseBlock);

                // load batches dynamically
                $.get(`<?php echo e(url('admin/admission/get-batches')); ?>/${courseId}`, function(data) {
                    let options = '<option value="">Select Batch</option>';
                    if (data.length === 0) options += '<option disabled>No batches available</option>';
                    data.forEach(batch => {
                        // Check if this batch should be selected (from prefill parameter)
                        let selected = '';
                        if (prefillBatchId && batch.id == prefillBatchId) {
                            selected = 'selected';
                        }
                        
                        options += `<option value="${batch.id}" data-fee="${batch.course.min_fee}" ${selected}>
                    ${batch.title} (${batch.shift})
                </option>`;
                    });
                    courseBlock.find('select').html(options);
                    
                    // Trigger change to auto-calculate fee if batch is pre-selected
                    let selectedBatch = courseBlock.find('select').val();
                    if (selectedBatch) {
                        courseBlock.find('select').trigger('change');
                    }
                }).fail(function(xhr) {
                    console.error('Error loading batches:', xhr.responseText);
                    courseBlock.find('select').html('<option disabled>Error loading batches</option>');
                });
            });

            adjustBatchLayout();
        }

        // remove course dynamically and re-adjust layout
        $(document).on('click', '.remove-course-btn', function() {
            const courseId = $(this).data('course');
            $(`.course-col[data-course="${courseId}"]`).remove();

            // refresh selected course list
            let selectedCourses = $('#course_id').val().filter(id => id != courseId);
            $('#course_id').val(selectedCourses);

            adjustBatchLayout();
        });

        // adjust columns dynamically
        function adjustBatchLayout() {
            const totalCourses = $('#batch-container .course-col').length;
            const newCol = totalCourses === 1 ? 'col-12' : 'col-md-6';
            $('#batch-container .course-col').removeClass('col-12 col-md-6').addClass(newCol);
        }


        let fullFee = 0;
        const PER_INSTALLMENT_CHARGE = 1000;

        // 🔹 When any batch is selected, update that course fee and total fee
        $(document).on('change', '.batch-select', function() {
            const block = $(this).closest('.course-block');
            const fee = parseInt($(this).find(':selected').data('fee')) || 0;
            block.find('.course-fee-input').val(fee).prop('readonly', false); // allow manual override

            calculateTotalFee();
        });

        // 🔹 When admin edits any individual course fee manually
        $(document).on('input', '.course-fee-input', function() {
            calculateTotalFee();
        });

        // 🔹 Sum all course fees
        function calculateTotalFee() {
            let totalFee = 0;
            $('.course-fee-input').each(function() {
                totalFee += parseInt($(this).val()) || 0;
            });
            $('#full_fee').val(totalFee);
            fullFee = totalFee;
            autoDistributeInstallments();
        }

        // 🔹 Manual override of total fee (still allowed)
        $('#full_fee').on('input', function() {
            fullFee = parseInt($(this).val() || 0);
            autoDistributeInstallments();
        });

        // 🔹 Payment Type Toggle
        $('input[name="payment_type"]').on('change', function() {
            if ($(this).val() === 'installment') {
                $('#installment-section').show();
                $('#apply_additional_charges').prop('disabled', false);
                autoDistributeInstallments();
            } else {
                $('#installment-section').hide();
                $('#apply_additional_charges').prop('checked', false).prop('disabled', true);
                renderTotal();
            }
        });

        // 🔹 Installment count
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

        // 🔹 Additional charges
        $(document).on('change', '#apply_additional_charges', function() {
            autoDistributeInstallments();
        });

        // 🔹 Manual installment edit
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
        }

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

        // Referral logic
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

            const paymentType = $('input[name="payment_type"]:checked').val();
            if (paymentType === 'installment') {
                $('#installment-section').show();
                $('#apply_additional_charges').prop('disabled', false);
            } else {
                $('#installment-section').hide();
                $('#apply_additional_charges').prop('checked', false).prop('disabled', true);
            }

            const count = parseInt($('#installment_count').val());
            if (count === 2) {
                $('#installment_3_wrapper').hide();
            } else {
                $('#installment_3_wrapper').show();
            }

            autoDistributeInstallments();
        });

        // Show Online Percentage toggle
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
            toggleOnlinePercent();
        })();
        // Remove course block
        $(document).on('click', '.remove-course-btn', function() {
            $(this).closest('.course-block').remove();
            calculateTotalFee();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/admission/create.blade.php ENDPATH**/ ?>