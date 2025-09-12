
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Salary History <?php echo e($teacher ? ' - ' . $teacher->name : ''); ?></h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('teacher-salary.index')); ?>" class="btn btn-sm btn-secondary">Back to Salaries</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Teacher Salary History</h2>
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
                                            <th>Month</th>
                                            <th>Year</th>
                                            <th>Pay Type</th>
                                            <th>%</th>
                                            <th>Fixed</th>
                                            <th>Amount</th>
                                            <th>Performed By</th>
                                            <th>Performed At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php
                                                // We loaded with(['teacher','salary']) in controller
                                                $teacher = $history->teacher ?? null;
                                                $row = $history->salary; // monthly snapshot if exists
                                                $collected = (int) ($row->total_fee_collected ?? 0);

                                                // Determine pay type snapshot (fallback to teacher record if missing on history->salary)
                                                $payType = $row->pay_type ?? ($teacher->pay_type ?? 'percentage');

                                                // % snapshot + computed %
                                                $percent =
                                                    (int) ($row->percentage ??
                                                        (int) ($teacher->percentage ??
                                                            (is_numeric($teacher->salary ?? null)
                                                                ? $teacher->salary
                                                                : 0)));

                                                $pctAmt =
                                                    (int) ($row->computed_percentage_amount ??
                                                        (int) round($collected * ($percent / 100)));

                                                // Fixed snapshot
                                                $fixedAmt =
                                                    (int) ($row->computed_fixed_amount ??
                                                        (int) ($teacher->fixed_salary ?? 0));
                                            ?>

                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>

                                                <td>
                                                    <?php
                                                        $status = $history->status;
                                                        $badge = 'badge-warning';
                                                        if (
                                                            strtolower($status) === 'paid' ||
                                                            $status === 'Balance → Paid'
                                                        ) {
                                                            $badge = 'badge-success';
                                                        } elseif (strtolower($status) === 'balance') {
                                                            $badge = 'badge-info';
                                                        }
                                                    ?>
                                                    <span class="badge <?php echo e($badge); ?>"><?php echo e($status); ?></span>
                                                </td>

                                                <td><?php echo e(\Carbon\Carbon::create()->month($history->month)->format('F')); ?>

                                                </td>
                                                <td><?php echo e($history->year); ?></td>

                                                
                                                <td>
                                                    <span
                                                        class="badge badge-<?php echo e($payType === 'fixed' ? 'primary' : 'info'); ?>">
                                                        <?php echo e(ucfirst($payType)); ?>

                                                    </span>
                                                </td>

                                                
                                                <td>
                                                    <?php echo e($percent); ?>%
                                                    <?php if($pctAmt > 0): ?>
                                                        <small class="text-muted d-block">≈ <?php echo e(number_format($pctAmt)); ?>

                                                            PKR</small>
                                                    <?php endif; ?>
                                                </td>

                                                
                                                <td>
                                                    <?php echo e($fixedAmt > 0 ? number_format($fixedAmt) . ' PKR' : '—'); ?>

                                                </td>

                                                
                                                <td><strong><?php echo e(number_format((int) $history->amount)); ?> PKR</strong></td>

                                                <td><?php echo e($history->performedBy->name ?? '-'); ?></td>
                                                <td><?php echo e($history->performed_at ? $history->performed_at->format('Y-m-d H:i') : '-'); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="10" class="text-center">No history found.</td>
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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/teacher/salary/history.blade.php ENDPATH**/ ?>