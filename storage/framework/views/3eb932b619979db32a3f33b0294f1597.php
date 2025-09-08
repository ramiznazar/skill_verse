

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Partner Profits</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    
                    <form method="POST" action="<?php echo e(route('admin.partner_profits.generate_monthly')); ?>"
                        style="display:inline-block;">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="month" value="<?php echo e(request('month') ?: $selectedMonth ?? now()->month); ?>">
                        <input type="hidden" name="year" value="<?php echo e(request('year') ?: $selectedYear ?? now()->year); ?>">
                        <button type="submit" class="btn btn-sm btn-primary">Generate Monthly</button>
                    </form>

                    
                    <a href="<?php echo e(route('admin.partner_profits.partner_balances.index')); ?>" class="btn btn-sm btn-info">
                        Partner Balances
                    </a>

                    
                    <?php if(Auth::user()->role !== 'partner'): ?>
                        <a href="<?php echo e(route('admin.partner_profits.full_history', request()->query())); ?>"
                            class="btn btn-sm btn-secondary">
                            Full History
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <div class="container-fluid">
            
            <?php if(isset($summary)): ?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="alert alert-light border">
                            <div><strong>Total Fees:</strong> Rs <?php echo e(number_format($summary['fees'] ?? 0, 2)); ?></div>
                            <div><strong>Total Expenses:</strong> Rs <?php echo e(number_format($summary['expenses'] ?? 0, 2)); ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-light border">
                            <div><strong>Net Profit:</strong>
                                <?php $np = $summary['netProfit'] ?? 0; ?>
                                <span class="<?php echo e($np < 0 ? 'text-danger' : 'text-success'); ?>">
                                    Rs <?php echo e(number_format($np, 2)); ?>

                                </span>
                            </div>
                            <div><small>(<?php echo e(\Carbon\Carbon::create()->month($selectedMonth ?? now()->month)->format('F')); ?>

                                    <?php echo e($selectedYear ?? now()->year); ?>)</small></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            
            <?php $__currentLoopData = ['store' => 'success', 'update' => 'warning', 'delete' => 'danger', 'success' => 'success', 'error' => 'danger', 'info' => 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(session($msg)): ?>
                    <div class="alert alert-<?php echo e($type); ?> alert-dismissible fade show" role="alert">
                        <?php echo e(session($msg)); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><i class="fas fa-wallet text-info mr-2"></i> All Partner Profits</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="fas fa-sync-alt"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="fas fa-expand"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">
                            <!-- Filters -->
                            <form method="GET" action="<?php echo e(route('admin.partner_profits.index')); ?>" class="row mb-3">
                                <div class="col-md-3">
                                    <select class="form-control" name="month">
                                        <option value="">-- Select Month --</option>
                                        <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($m); ?>"
                                                <?php echo e((string) request('month', $selectedMonth ?? '') === (string) $m ? 'selected' : ''); ?>>
                                                <?php echo e(\Carbon\Carbon::create()->month($m)->format('F')); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="year">
                                        <option value="">-- Select Year --</option>
                                        <?php $__currentLoopData = range(2023, now()->year); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($y); ?>"
                                                <?php echo e((string) request('year', $selectedYear ?? '') === (string) $y ? 'selected' : ''); ?>>
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
                                            <th>Name</th>
                                            <th>Period</th>
                                            <th>% / Rate</th>
                                            <th>Total Share</th>
                                            <th>Balance</th>
                                            <th>Paid</th>
                                            <th>Unpaid</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $profits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($profit->partner->name ?? '—'); ?></td>
                                                <td class="">
                                                    <div><?php echo e(\Carbon\Carbon::create()->month($profit->month)->format('F')); ?>

                                                    </div>
                                                    <small class="text-muted"><?php echo e($profit->year); ?></small>
                                                </td>

                                                <td><?php echo e(number_format((float) ($profit->partner->percentage ?? 0), 2)); ?>%
                                                </td>

                                                <td><?php echo e(number_format((float) $profit->amount, 2)); ?></td>
                                                <td class="text-warning">
                                                    <?php echo e(number_format((float) ($profit->balance_amount ?? 0), 2)); ?></td>
                                                <td class="text-success">
                                                    <?php echo e(number_format((float) ($profit->settled ?? 0), 2)); ?> PKR</td>

                                                <td class="text-danger"><?php echo e(number_format((float) ($profit->due ?? 0), 2)); ?>

                                                    PKR</td>

                                                <td>
                                                    <span
                                                        class="badge
                            <?php if(($profit->derived_status ?? 'unpaid') === 'paid'): ?> badge-success
                            <?php elseif(($profit->derived_status ?? '') === 'balance'): ?> badge-info
                            <?php else: ?> badge-warning <?php endif; ?>">
                                                        <?php echo e(ucfirst($profit->derived_status ?? 'unpaid')); ?>

                                                    </span>
                                                </td>

                                                <td>
                                                    <?php if(Auth::user()->role !== 'partner'): ?>
                                                        
                                                        <form method="POST"
                                                            action="<?php echo e(route('admin.partner_profits.mark_as_paid', $profit->id)); ?>"
                                                            style="display:inline-block;">
                                                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-success">Paid</button>
                                                        </form>

                                                        
                                                        <form method="POST"
                                                            action="<?php echo e(route('admin.partner_profits.move_to_balance', $profit->id)); ?>"
                                                            style="display:inline-block;">
                                                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-warning">Balance</button>
                                                        </form>
                                                    <?php endif; ?>

                                                    
                                                    <a href="<?php echo e(route('admin.partner_profits.history', $profit->partner_id)); ?>"
                                                        class="btn btn-sm btn-info">
                                                        History
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="10" class="text-center">No profits found.</td>
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

<?php $__env->startSection('additional-javascript'); ?>
    <script>
        $('.sparkbar').sparkline('html', {
            type: 'bar'
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/partners/partner_profits/index.blade.php ENDPATH**/ ?>