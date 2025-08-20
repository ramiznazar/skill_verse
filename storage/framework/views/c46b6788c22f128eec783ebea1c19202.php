
<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12"><h2>Admissions</h2></div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="<?php echo e(route('admission.index')); ?>" class="btn btn-sm btn-primary">All Admissions</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header"><h2>Update Student Admission</h2></div>
                    <div class="body">
                        <form id="admission-form" action="<?php echo e(route('admission.update', $admission->id)); ?>" method="POST" enctype="multipart/form-data">
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
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
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
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
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
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label>Full Name</label>
                                    <input type="text" name="name" value="<?php echo e(old('name', $admission->name)); ?>" class="form-control">
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label>CNIC</label>
                                    <input type="text" name="cnic" value="<?php echo e(old('cnic', $admission->cnic)); ?>" class="form-control">
                                    <?php $__errorArgs = ['cnic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label>Guardian Name</label>
                                    <input type="text" name="guardian_name" value="<?php echo e(old('guardian_name', $admission->guardian_name)); ?>" class="form-control">
                                    <?php $__errorArgs = ['guardian_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label>Guardian Contact</label>
                                    <input type="text" name="guardian_contact" value="<?php echo e(old('guardian_contact', $admission->guardian_contact)); ?>" class="form-control">
                                    <?php $__errorArgs = ['guardian_contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label>Date of Birth</label>
                                    <input type="date" name="dob" value="<?php echo e(old('dob', $admission->dob)); ?>" class="form-control">
                                    <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label>Email</label>
                                    <input type="email" name="email" value="<?php echo e(old('email', $admission->email)); ?>" class="form-control">
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="<?php echo e(old('phone', $admission->phone)); ?>" class="form-control">
                                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label>Joining Date</label>
                                    <input type="date" name="joining_date" value="<?php echo e(old('joining_date', $admission->joining_date)); ?>" class="form-control">
                                    <?php $__errorArgs = ['joining_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label>Status</label>
                                    <select name="student_status" class="form-control">
                                        <option value="active"   <?php echo e(old('student_status', $admission->student_status) == 'active' ? 'selected' : ''); ?>>Active</option>
                                        <option value="unactive" <?php echo e(old('student_status', $admission->student_status) == 'unactive' ? 'selected' : ''); ?>>UnActive</option>
                                    </select>
                                    <?php $__errorArgs = ['student_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option value="male"   <?php echo e(old('gender', $admission->gender) == 'male' ? 'selected' : ''); ?>>Male</option>
                                        <option value="female" <?php echo e(old('gender', $admission->gender) == 'female' ? 'selected' : ''); ?>>Female</option>
                                    </select>
                                    <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label>Qualification</label>
                                    <select name="qualification" class="form-control">
                                        <?php $__currentLoopData = ['middle','metric','intermediate','graduate','m-phill']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($q); ?>" <?php echo e(old('qualification', $admission->qualification) == $q ? 'selected' : ''); ?>>
                                                <?php echo e(ucfirst($q)); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['qualification'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label>Last Institute</label>
                                    <input type="text" name="last_institute" value="<?php echo e(old('last_institute', $admission->last_institute)); ?>" class="form-control">
                                    <?php $__errorArgs = ['last_institute'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label>Referral Source</label>
                                    <input type="text" name="referral_source" value="<?php echo e(old('referral_source', $admission->referral_source)); ?>" class="form-control">
                                    <?php $__errorArgs = ['referral_source'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label>Source Contact #</label>
                                    <input type="number" name="referral_source_contact" value="<?php echo e(old('referral_source_contact', $admission->referral_source_contact)); ?>" class="form-control">
                                    <?php $__errorArgs = ['referral_source_contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label>Source Commission (%)</label>
                                    <input type="number" name="referral_source_commission" value="<?php echo e(old('referral_source_commission', $admission->referral_source_commission)); ?>" class="form-control">
                                    <?php $__errorArgs = ['referral_source_commission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
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
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <hr class="mt-4">

                            
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Total Fee</label>
                                    <input type="number" id="full_fee" name="full_fee" class="form-control" value="<?php echo e(old('full_fee', $admission->full_fee)); ?>">
                                    <?php $__errorArgs = ['full_fee'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Payment Type</label>
                                    <div class="d-flex flex-column">
                                        <label><input type="radio" name="payment_type" value="full_fee"
                                            <?php echo e(old('payment_type', $admission->payment_type) == 'full_fee' ? 'checked' : ''); ?>> Full Payment</label>
                                        <label><input type="radio" name="payment_type" value="installment"
                                            <?php echo e(old('payment_type', $admission->payment_type) == 'installment' ? 'checked' : ''); ?>> Installments</label>
                                    </div>
                                    <?php $__errorArgs = ['payment_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="col-md-12 mt-2">
                                    <label>Calculated Total (after options)</label>
                                    <input type="text" id="calculated_total" class="form-control" value="0" readonly>
                                    <input type="hidden" id="calculated_total_input" name="calculated_total" value="0">
                                </div>
                            </div>

                            
                            <div id="installment-section"
                                 style="<?php echo e(old('payment_type', $admission->payment_type) == 'installment' ? '' : 'display:none;'); ?>"
                                 class="mt-3">

                                
                                <div class="row mb-2" style="margin-top: -15px">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                id="apply_additional_charges" name="apply_additional_charges" value="1"
                                                <?php echo e(old('apply_additional_charges', $applyExtraDefault) ? 'checked' : ''); ?>>
                                            <small class="form-check-label" for="apply_additional_charges">
                                                Apply additional charges — ₨1000 per installment
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Installment Count</label>
                                        <select id="installment_count" name="installment_count" class="form-control">
                                            <option value="2" <?php echo e((int) old('installment_count', $preCount) === 2 ? 'selected' : ''); ?>>2 Installments</option>
                                            <option value="3" <?php echo e((int) old('installment_count', $preCount) === 3 ? 'selected' : ''); ?>>3 Installments</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Installment 1</label>
                                        <input type="number" name="installment_1" id="installment_1" class="form-control"
                                            value="<?php echo e(old('installment_1', $admission->installment_1)); ?>">
                                        <?php $__errorArgs = ['installment_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Installment 2</label>
                                        <input type="number" name="installment_2" id="installment_2" class="form-control"
                                            value="<?php echo e(old('installment_2', $admission->installment_2)); ?>">
                                        <?php $__errorArgs = ['installment_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-4" id="installment_3_wrapper">
                                        <label>Installment 3</label>
                                        <input type="number" name="installment_3" id="installment_3" class="form-control"
                                            value="<?php echo e(old('installment_3', $admission->installment_3)); ?>">
                                        <?php $__errorArgs = ['installment_3'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
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
    // Load batches by course
    $('#course_id').on('change', function() {
        let courseId = $(this).val();
        $('#batch_id').html('<option>Loading...</option>');
        $.get(`/get-batches/${courseId}`, function(data) {
            let html = '<option value="">Select Batch</option>';
            data.forEach(batch => {
                html += `<option value="${batch.id}" data-fee="${batch.course.full_fee}">${batch.title} (${batch.shift ?? ''})</option>`;
            });
            $('#batch_id').html(html);
        });
    });

    let fullFee = parseInt($('#full_fee').val() || 0);
    const PER_INSTALLMENT_CHARGE = 1000;

    // Batch selection -> set fee & redistribute
    $('#batch_id').on('change', function() {
        let fee = $(this).find(':selected').data('fee') || 0;
        fullFee = parseInt(fee) || 0;
        $('#full_fee').val(fullFee);
        autoDistributeInstallments();
    });

    // Manual fee edit
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
            renderTotal(); // for full payment
        }
    });

    // Installment count change
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

    // Additional charges toggled
    $(document).on('change', '#apply_additional_charges', function() {
        autoDistributeInstallments();
    });

    // Manual installments edit
    $('#installment_1, #installment_2').on('input', function() {
        adjustRemainingInstallments();
    });

    // Helpers
    function computeTotalParts() {
        const isInstallment = $('input[name="payment_type"]:checked').val() === 'installment';
        const count = parseInt($('#installment_count').val()) || 0;
        const applyExtra = $('#apply_additional_charges').is(':checked');
        const base = parseInt(fullFee) || 0;
        const extra = (isInstallment && applyExtra) ? (PER_INSTALLMENT_CHARGE * count) : 0;
        const total = base + extra;
        return { base, extra, total, count, applyExtra, isInstallment };
    }

    function renderTotal() {
        const p = computeTotalParts();
        $('#calculated_total').val(p.total);
        $('#calculated_total_input').val(p.total);
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

    // Initial state
    $(document).ready(function () {
        const count = parseInt($('#installment_count').val() || '<?php echo e(old('installment_count', $preCount)); ?>');
        if (count === 2) { $('#installment_3_wrapper').hide(); }
        fullFee = parseInt($('#full_fee').val() || 0);

        const paymentType = $('input[name="payment_type"]:checked').val();
        if (paymentType === 'installment') {
            $('#installment-section').show();
            $('#apply_additional_charges').prop('disabled', false);
        } else {
            $('#installment-section').hide();
            $('#apply_additional_charges').prop('checked', false).prop('disabled', true);
        }
        autoDistributeInstallments();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/admission/update.blade.php ENDPATH**/ ?>