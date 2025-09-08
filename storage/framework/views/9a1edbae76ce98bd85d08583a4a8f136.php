

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Partner Balances</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="d-flex justify-content-end align-items-center" style="gap: 10px;">
                        <a href="<?php echo e(route('admin.partner_profits.index')); ?>"
                            class="btn btn-sm btn-outline-primary rounded-pill shadow-sm" title="Back to Profits">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        
        <?php $__currentLoopData = ['store' => 'success', 'update' => 'warning', 'delete' => 'danger', 'paid' => 'success']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(session($msg)): ?>
                <div class="alert alert-<?php echo e($type); ?> alert-dismissible fade show" role="alert">
                    <?php echo e(session($msg)); ?>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><i class="fas fa-wallet text-info mr-2"></i> Balance Details</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body table-responsive">
                            <table class="table table-bordered table-hover mt-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Partner Name</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Amount (Rs)</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <?php if(Auth::user()->role !== 'partner'): ?>
                                            <th>Options</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $balances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $balance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($balance->partner->name ?? 'N/A'); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::create()->month($balance->month)->format('F')); ?></td>
                                            <td><?php echo e($balance->year); ?></td>
                                            <td><strong>Rs <?php echo e(number_format((float) $balance->amount, 2)); ?></strong></td>
                                            <td><?php echo e($balance->created_at?->format('d M Y, h:i A')); ?></td>
                                            <td>
                                                <span
                                                    class="badge
                                                <?php echo e($balance->status === 'paid' ? 'badge-success' : 'badge-warning'); ?>">
                                                    <?php echo e(ucfirst($balance->status)); ?>

                                                </span>
                                            </td>
                                            <?php if(Auth::user()->role !== 'partner'): ?>
                                            <td>
                                                <div class="d-flex align-items-center" style="gap: 8px;">
                                                        <form method="POST"
                                                            action="<?php echo e(route('admin.partner_profits.partner_balances.status_paid', $balance->id)); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <button class="btn btn-sm btn-success" title="Mark as Paid">
                                                                Mark as Paid
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">No balance records found.</td>
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

<?php $__env->startSection('additional-javascript'); ?>
    <?php $__env->startPush('scripts'); ?>
        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/partners/partner_profits/balance.blade.php ENDPATH**/ ?>