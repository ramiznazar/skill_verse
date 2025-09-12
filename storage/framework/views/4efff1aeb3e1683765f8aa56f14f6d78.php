
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Teachers Balance</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('teacher-salary.index')); ?>" class="btn btn-sm btn-primary" title="">Back to
                        Teachers</a>
                </div>
            </div>
        </div>
        
        <?php if(session('paid')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('paid')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        
        <?php if(session('delete')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('delete')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        
        <?php if(session('update')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo e(session('update')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Balances</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead class="">
                                        <tr>
                                            <th>#</th>
                                            <th>Teacher Name</th>
                                            <th>Month</th>
                                            <th>Year</th>
                                            <th>Pay Type</th>
                                            <th>%</th>
                                            <th>Fixed</th>
                                            <th>Amount (PKR)</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $balances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $balance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $teacher = $balance->teacher ?? null;
                                                // Use teacher's current setup (no snapshot available on balances)
$payType = $teacher->pay_type ?? 'percentage';
                                                $percent =
                                                    (int) ($teacher->percentage ??
                                                        (is_numeric($teacher->salary ?? null) ? $teacher->salary : 0)); // legacy fallback
                                                $fixedAmt = (int) ($teacher->fixed_salary ?? 0);
                                            ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($teacher->name ?? 'N/A'); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::create()->month($balance->month)->format('F')); ?></td>
                                                <td><?php echo e($balance->year); ?></td>

                                                
                                                <td>
                                                    <span
                                                        class="badge badge-<?php echo e($payType === 'fixed' ? 'primary' : 'info'); ?>">
                                                        <?php echo e(ucfirst($payType)); ?>

                                                    </span>
                                                </td>

                                                
                                                <td><?php echo e($percent); ?>%</td>

                                                
                                                <td><?php echo e($fixedAmt > 0 ? number_format($fixedAmt) . ' PKR' : '—'); ?></td>

                                                <td><?php echo e(number_format($balance->amount, 2)); ?></td>
                                                <td><?php echo e($balance->created_at->format('d M Y')); ?></td>
                                                <td>
                                                    <span
                                                        class="badge <?php echo e($balance->status === 'paid' ? 'badge-success' : 'badge-warning'); ?>">
                                                        <?php echo e(ucfirst($balance->status)); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <form action="<?php echo e(route('teacher-balance.status-paid', $balance->id)); ?>"
                                                        method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <button class="btn btn-sm btn-success">Mark as Paid</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/teacher/salary/balance.blade.php ENDPATH**/ ?>