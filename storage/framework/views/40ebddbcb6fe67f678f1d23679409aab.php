
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Student Details</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('admission.index')); ?>" class="btn btn-sm btn-primary">All Admissions</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card">
                <div class="body">
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            <?php if($admission->image): ?>
                                <img src="<?php echo e(asset($admission->image)); ?>" class="img-thumbnail" width="150"
                                    height="150">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/150" class="img-thumbnail">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-9">
                            <h4><?php echo e($admission->name); ?></h4>
                            <p><strong>Course:</strong> <?php echo e($admission->course->title ?? 'N/A'); ?></p>
                            <p><strong>Batch:</strong> <?php echo e($admission->batch->title ?? 'N/A'); ?></p>

                            
                            <p>
                                <strong>Mode:</strong>
                                <?php if($admission->mode === 'online'): ?>
                                    <span class="badge badge-success">Online</span>
                                    <?php if(!empty($admission->online_percentage)): ?>
                                        <small class="text-muted ml-2">
                                            (Teacher Share: <?php echo e($admission->online_percentage); ?>%)
                                        </small>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="badge badge-primary">Physical</span>
                                <?php endif; ?>
                            </p>

                            <p><strong>Status:</strong> <?php echo e(ucfirst($admission->student_status)); ?></p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>CNIC:</strong> <?php echo e($admission->cnic); ?></p>
                            <p><strong>Guardian Name:</strong> <?php echo e($admission->guardian_name); ?></p>
                            <p><strong>Guardian Contact:</strong> <?php echo e($admission->guardian_contact); ?></p>
                            <p><strong>DOB:</strong> <?php echo e($admission->dob); ?></p>
                            <p><strong>Gender:</strong> <?php echo e(ucfirst($admission->gender)); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email:</strong> <?php echo e($admission->email); ?></p>
                            <p><strong>Phone:</strong> <?php echo e($admission->phone); ?></p>
                            <p><strong>Joining Date:</strong> <?php echo e($admission->joining_date); ?></p>
                            <p><strong>Qualification:</strong> <?php echo e(ucfirst($admission->qualification)); ?></p>
                            <p><strong>Last Institute:</strong> <?php echo e($admission->last_institute); ?></p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Referral Type:</strong> <?php echo e(ucfirst($admission->referral_type)); ?></p>
                            <p><strong>Referral Source:</strong> <?php echo e($admission->referral_source); ?></p>
                            <p><strong>Source Contact:</strong> <?php echo e($admission->referral_source_contact); ?></p>
                            <p><strong>Source Commission:</strong> <?php echo e($admission->referral_source_commission); ?>%</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Address:</strong> <?php echo e($admission->address); ?></p>
                            <p><strong>Total Fee:</strong> ₨<?php echo e(number_format($admission->full_fee)); ?></p>
                            <p><strong>Registration Fee:</strong> ₨<?php echo e(number_format($admission->registration_fee ?? 0)); ?></p>
                            <p><strong>Payment Type:</strong> <?php echo e(ucfirst($admission->payment_type)); ?></p>
                            <p><strong>Installments:</strong>
                                1: ₨<?php echo e($admission->installment_1 ?? 0); ?>,
                                2: ₨<?php echo e($admission->installment_2 ?? 0); ?>,
                                3: ₨<?php echo e($admission->installment_3 ?? 0); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/admission/show.blade.php ENDPATH**/ ?>