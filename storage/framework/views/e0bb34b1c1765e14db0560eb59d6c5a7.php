

<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2><?php echo e(isset($partnerName) ? "$partnerName's Profit History" : 'Partner Profit History'); ?></h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="d-flex justify-content-end align-items-center" style="gap:10px;">
                    <a href="<?php echo e(route('admin.partner_profits.index')); ?>"
                       class="btn btn-sm btn-primary" title="Back to Profits">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        
        <form method="GET" class="row mb-3">
            <div class="col-md-3">
                <select class="form-control" name="month">
                    <option value="">-- Month --</option>
                    <?php $__currentLoopData = range(1,12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($m); ?>" <?php echo e((string)request('month', $selectedMonth ?? '') === (string)$m ? 'selected' : ''); ?>>
                            <?php echo e(\Carbon\Carbon::create()->month($m)->format('F')); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control" name="year">
                    <option value="">-- Year --</option>
                    <?php $__currentLoopData = range(2023, now()->year); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($y); ?>" <?php echo e((string)request('year', $selectedYear ?? '') === (string)$y ? 'selected' : ''); ?>>
                            <?php echo e($y); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-sm btn-primary"><i class="fas fa-filter"></i> Filter</button>
            </div>
        </form>

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
                                    <th>Partner</th>
                                    <th>Period</th>
                                    <th>Amount (Rs)</th>
                                    <th>History Status</th>
                                    <th>Note</th>
                                    <th>Performed By</th>
                                    <th>Performed At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 0; ?>
                                <?php $__empty_1 = true; $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $h = strtolower($history->status ?? '');
                                    ?>

                                    
                                    <?php if(!in_array($h, ['paid','balance'])) continue; ?>

                                    <?php $row++; ?>
                                    <tr>
                                        <td><?php echo e($row); ?></td>

                                        <td><?php echo e($history->profit->partner->name ?? $partnerName ?? 'N/A'); ?></td>

                                        <td class="text-center">
                                            <div>
                                                <?php echo e($history->month
                                                    ? \Carbon\Carbon::create()->month($history->month)->format('F')
                                                    : '—'); ?>

                                            </div>
                                            <small class="text-muted"><?php echo e($history->year ?? '—'); ?></small>
                                        </td>

                                        
                                        <td><?php echo e(number_format((float)$history->amount, 2)); ?></td>

                                        
                                        <td>
                                            <span class="badge <?php echo e($h === 'paid' ? 'badge-success' : 'badge-info'); ?>">
                                                <?php echo e(ucfirst($h)); ?>

                                            </span>
                                        </td>

                                        <td><?php echo e($history->note ?? '—'); ?></td>

                                        <td><?php echo e($history->performedBy->name ?? '—'); ?></td>

                                        <td>
                                            <?php if($history->performed_at): ?>
                                                <?php echo e(\Carbon\Carbon::parse($history->performed_at)->format('d M Y h:i A')); ?>

                                            <?php else: ?>
                                                <?php echo e(optional($history->created_at)->format('d M Y h:i A') ?? '—'); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">No history found.</td>
                                    </tr>
                                <?php endif; ?>

                                <?php if(($row ?? 0) === 0): ?>
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">No paid/balance entries found.</td>
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