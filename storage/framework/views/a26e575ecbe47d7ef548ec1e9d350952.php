
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>
                        Referral History — <?php echo e($referral_name); ?>

                        <?php if($referral_contact): ?>
                            <small>(<?php echo e($referral_contact); ?>)</small>
                        <?php endif; ?>
                    </h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('referral-commission.index')); ?>" class="btn btn-sm btn-secondary">Back to Referrals</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Referral Commission History</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li>
                                    <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse">
                                        <i class="icon-refresh"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="full-screen">
                                        <i class="icon-size-fullscreen"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="body">
                            
                            <form method="GET" class="form-inline mb-3">
                                <div class="form-group mr-2">
                                    <label for="month">Month:</label>
                                    <select name="month" id="month" class="form-control ml-2">
                                        <option value="">All</option>
                                        <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($m); ?>"
                                                <?php echo e(request('month') == $m ? 'selected' : ''); ?>>
                                                <?php echo e(\Carbon\Carbon::create()->month($m)->format('F')); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group mr-2">
                                    <label for="year">Year:</label>
                                    <select name="year" id="year" class="form-control ml-2">
                                        <option value="">All</option>
                                        <?php for($y = now()->year; $y >= 2020; $y--): ?>
                                            <option value="<?php echo e($y); ?>"
                                                <?php echo e(request('year') == $y ? 'selected' : ''); ?>>
                                                <?php echo e($y); ?>

                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <button class="btn btn-primary" type="submit">Filter</button>
                            </form>

                            
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Status</th>
                                            <th>Student</th>
                                            <th>Course</th>
                                            <th>Type</th>
                                            <th>Total Fee</th>
                                            <th>(%) Rate</th>
                                            <th>Commission</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>

                                                <td>
                                                    <span
                                                        class="badge
                        <?php if($commission->status === 'paid'): ?> badge-success
                        <?php elseif($commission->status === 'unpaid'): ?> badge-warning
                        <?php else: ?> badge-info <?php endif; ?>">
                                                        <?php echo e(ucfirst($commission->status)); ?>

                                                    </span>
                                                </td>

                                                <td><?php echo e(optional($commission->admission)->name ?? '-'); ?></td>
                                                <td><?php echo e(optional(optional($commission->admission)->course)->title ?? '-'); ?>

                                                </td>
                                                <td>
                                                    <?php $type = optional($commission->feeSubmission)->payment_type; ?>
                                                    <?php if($type): ?>
                                                        <span
                                                            class="badge badge-<?php echo e($type === 'full_fee' ? 'success' : 'warning'); ?>">
                                                            <?php echo e(str_replace('_', ' ', ucfirst($type))); ?>

                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary">N/A</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><strong><?php echo e(number_format((float) (optional($commission->admission)->full_fee ?? 0), 2)); ?></strong></td>
                                                <td><?php echo e(rtrim(rtrim(number_format((float) $commission->commission_percentage, 2), '0'), '.')); ?>%
                                                </td>

                                                <?php
                                                    // If paid, show the snapshot amount from history; else show current value
                                                    $displayAmount =
                                                        optional($commission->lastPaidHistory)->amount ??
                                                        $commission->commission_amount;
                                                ?>
                                                <td><strong><?php echo e(number_format((float) $displayAmount, 2)); ?></strong>
                                                </td>

                                                <td><?php echo e($commission->created_at ? $commission->created_at->format('Y-m-d H:i') : '-'); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="9" class="text-center">No history found.</td>
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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/referral-commission/history.blade.php ENDPATH**/ ?>