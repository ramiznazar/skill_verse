

<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Partner Profits</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="d-flex justify-content-end align-items-center gap-2">
                    <form method="POST" action="<?php echo e(route('admin.dashboard.partner_profits.generate_monthly')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-sm btn-outline-primary rounded-pill shadow-sm" title="Generate Monthly Profit">
                            <i class="fas fa-sync-alt"></i> Generate Monthly
                        </button>
                    </form>

                    <a href="<?php echo e(route('admin.dashboard.partner_profits.full_history', array_merge(request()->query(), ['full' => 1]))); ?>"
                       class="btn btn-sm btn-outline-secondary rounded-pill shadow-sm" title="View Full History">
                        <i class="fas fa-list-alt"></i> Full History
                    </a>
                </div>
            </div>
        </div>
    </div>

    
    <?php $__currentLoopData = ['store' => 'success', 'update' => 'warning', 'delete' => 'danger']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <h2><i class="fas fa-wallet text-info mr-2"></i> All Partner Profits</h2>
                        <ul class="header-dropdown dropdown dropdown-animated scale-left">
                            <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="fas fa-sync-alt"></i></a></li>
                            <li><a href="javascript:void(0);" class="full-screen"><i class="fas fa-expand"></i></a></li>
                        </ul>
                    </div>

                    <div class="body">
                        <!-- Filters -->
                        <form method="GET" action="<?php echo e(route('admin.dashboard.partner_profits.index')); ?>" class="row mb-3">
                            <div class="col-md-3">
                                <select class="form-control" name="month">
                                    <option value="">-- Select Month --</option>
                                    <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($m); ?>" <?php echo e(request('month') == $m ? 'selected' : ''); ?>>
                                            <?php echo e(\Carbon\Carbon::create()->month($m)->format('F')); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="year">
                                    <option value="">-- Select Year --</option>
                                    <?php $__currentLoopData = range(2023, now()->year); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($y); ?>" <?php echo e(request('year') == $y ? 'selected' : ''); ?>>
                                            <?php echo e($y); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-filter"></i> Filter</button>
                            </div>
                        </form>

                        <!-- Profits Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mt-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Partner</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>History</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $profits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($profit->partner->name); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::create()->month($profit->calculation->month)->format('F')); ?></td>
                                            <td><?php echo e($profit->calculation->year); ?></td>
                                            <td>Rs <?php echo e(number_format($profit->amount, 2)); ?></td>
                                            <td>
                                                <span class="badge 
                                                    <?php if($profit->status == 'paid'): ?> badge-success
                                                    <?php elseif($profit->status == 'balance'): ?> badge-info
                                                    <?php else: ?> badge-warning <?php endif; ?>">
                                                    <?php echo e(ucfirst($profit->status)); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('admin.dashboard.partner_profits.history', $profit->partner_id)); ?>"
                                                   class="btn btn-sm btn-outline-dark" title="View History">
                                                    <i class="fas fa-history"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <?php if($profit->status == 'unpaid'): ?>
                                                        <a href="<?php echo e(route('admin.dashboard.partner_profits.mark_as_paid', $profit->id)); ?>"
                                                           class="btn btn-sm btn-outline-success" title="Mark as Paid">
                                                            <i class="fas fa-check-circle"></i>
                                                        </a>

                                                        <a href="<?php echo e(route('admin.dashboard.partner_profits.move_to_balance', $profit->id)); ?>"
                                                           class="btn btn-sm btn-outline-info" title="Move to Balance">
                                                            <i class="fas fa-arrow-right"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-muted">—</span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No profits found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <?php if($profits->isEmpty()): ?>
                                <div class="alert alert-warning text-center">
                                    No recent profit data available. Click <strong>"Generate Monthly"</strong> to create profits.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-javascript'); ?>
    <script>
        $('.sparkbar').sparkline('html', {
            type: 'bar'
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/partners/partner_profits/index.blade.php ENDPATH**/ ?>