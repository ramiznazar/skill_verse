

<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Lead Details</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="<?php echo e(route('lead.index')); ?>" class="btn btn-sm btn-primary">All Leads</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="body">

                
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h4 class="mb-2"><?php echo e($lead->name ?? 'N/A'); ?></h4>
                        <p><strong>Course:</strong> <?php echo e($lead->course->title ?? 'N/A'); ?></p>
                        <p><strong>Lead Type:</strong> <?php echo e(ucfirst($lead->lead_type ?? '-')); ?></p>
                        <p><strong>Status:</strong> 
                            <span class="badge 
                                <?php switch($lead->status):
                                    case ('new'): ?> badge-secondary <?php break; ?>
                                    <?php case ('contacted'): ?> badge-warning <?php break; ?>
                                    <?php case ('converted'): ?> badge-success <?php break; ?>
                                    <?php case ('lost'): ?> badge-danger <?php break; ?>
                                    <?php case ('interested'): ?> badge-info <?php break; ?>
                                    <?php default: ?> badge-light
                                <?php endswitch; ?>
                            ">
                                <?php echo e(ucfirst($lead->status)); ?>

                            </span>
                        </p>
                    </div>
                </div>

                <hr>

                
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Guardian Name:</strong> <?php echo e($lead->guardian_name ?? 'N/A'); ?></p>
                        <p><strong>Guardian Contact:</strong> <?php echo e($lead->guardian_contact ?? 'N/A'); ?></p>
                        <p><strong>CNIC:</strong> <?php echo e($lead->cnic ?? 'N/A'); ?></p>
                        <p><strong>DOB:</strong> <?php echo e($lead->dob ?? 'N/A'); ?></p>
                        <p><strong>Gender:</strong> <?php echo e(ucfirst($lead->gender ?? '-')); ?></p>
                        <p><strong>Qualification:</strong> <?php echo e($lead->qualification ?? 'N/A'); ?></p>
                    </div>

                    <div class="col-md-6">
                        <p><strong>Email:</strong> <?php echo e($lead->email ?? 'N/A'); ?></p>
                        <p><strong>Phone:</strong> <?php echo e($lead->phone ?? 'N/A'); ?></p>
                        <p><strong>Address:</strong> <?php echo e($lead->address ?? 'N/A'); ?></p>
                        <p><strong>Referral Type:</strong> <?php echo e(ucfirst($lead->referral_type ?? '-')); ?></p>
                        <p><strong>Referral Source:</strong> <?php echo e($lead->referral_source ?? 'N/A'); ?></p>
                        <p><strong>Referral Contact:</strong> <?php echo e($lead->referral_source_contact ?? 'N/A'); ?></p>
                    </div>
                </div>

                <hr>

                
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-3">Follow-Ups</h5>
                        <?php if($lead->followUps->count() > 0): ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Contact Method</th>
                                        <th>Status</th>
                                        <th>Note</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $lead->followUps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $follow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($index + 1); ?></td>
                                            <td><?php echo e(ucfirst($follow->contact_method)); ?></td>
                                            <td><span class="badge badge-info"><?php echo e(ucfirst($follow->status ?? '-')); ?></span></td>
                                            <td><?php echo e($follow->note ?? '-'); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($follow->followed_at)->format('d M Y, h:i A')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="text-muted">No follow-ups found for this lead.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/lead/show.blade.php ENDPATH**/ ?>