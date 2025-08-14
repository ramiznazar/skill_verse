

<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>
                    <?php echo e(isset($partnerName) ? "$partnerName's Profit History" : 'All Partners - Profit History'); ?>


                </h2>
 
            </div>
   <div class="col-md-6 col-sm-12 text-right">
                    <div class="d-flex justify-content-end align-items-center" style="gap: 10px;">
                        <a href="<?php echo e(route('admin.dashboard.partner_profits.index')); ?>"
                           class="btn btn-sm btn-outline-primary rounded-pill shadow-sm">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Profit History</h2>
                    </div>

                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Partner Name</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Profit Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td><?php echo e($history->profit->partner->name ?? 'N/A'); ?></td>
                                        <td><?php echo e($history->profit->calculation->month ?? '-'); ?></td>
                                        <td><?php echo e($history->profit->calculation->year ?? '-'); ?></td>
                                        <td><?php echo e(number_format($history->amount, 2)); ?></td>

                                        
                                        <td>
                                            <?php $status = $history->profit->status ?? 'unknown'; ?>
                                            <span class="badge
                                                <?php if($status === 'paid'): ?> badge-success
                                                <?php elseif($status === 'unpaid'): ?> badge-danger
                                                <?php elseif($status === 'balance'): ?> badge-warning
                                                <?php else: ?> badge-secondary
                                                <?php endif; ?>">
                                                <?php echo e(ucfirst($status)); ?>

                                            </span>
                                        </td>

                                        
                                        <td>
                                            <span class="badge
                                                <?php if($history->action === 'marked_paid'): ?> badge-primary
                                                <?php elseif($history->action === 'moved_to_balance'): ?> badge-info
                                                <?php elseif($history->action === 'updated'): ?> badge-dark
                                                <?php else: ?> badge-light
                                                <?php endif; ?>">
                                                <?php echo e(ucfirst(str_replace('_', ' ', $history->action))); ?>

                                            </span>
                                        </td>

                                        <td><?php echo e($history->created_at->format('d M Y h:i A')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No history found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/partners/partner_profits/history.blade.php ENDPATH**/ ?>