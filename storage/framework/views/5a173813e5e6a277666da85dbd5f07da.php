
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Fee Colecting</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary" title="">Create New</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Fee Collector</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <button type="button" class="btn btn-sm btn-default btn-filter" data-target="all">All</button>
                            <button type="button" class="btn btn-sm btn-success btn-filter" data-target="hand">By
                                Hand</button>
                            <button type="button" class="btn btn-sm btn-info btn-filter" data-target="account">By
                                Account</button>

                            <div class="table-responsive mt-3">
                                <table class="table table-filter table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Method</th>
                                            <th>No Of Students</th>
                                            <th>Amount</th>
                                            <th>Collector</th>
                                            <th>History</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $groupedSubmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $first = $group->first();
                                                $totalAmount = $group->sum('amount');
                                                $studentCount = $group->pluck('admission_id')->filter()->unique()->count();
                                            ?>
                                            <tr data-status="<?php echo e($first->payment_method); ?>">
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td>
                                                    <span
                                                        class="badge badge-<?php echo e($first->payment_method === 'hand' ? 'success' : 'info'); ?>">
                                                        <?php echo e(ucfirst($first->payment_method)); ?>

                                                    </span>
                                                </td>
                                                <td><?php echo e($studentCount); ?></td>
                                                <td><?php echo e(number_format($totalAmount)); ?> PKR</td>
                                                <td>
                                                    <?php if($first->payment_method === 'hand'): ?>
                                                        <strong>Collected By:</strong> <?php echo e($first->user->name ?? 'N/A'); ?>

                                                    <?php elseif($first->payment_method === 'account'): ?>
                                                        <strong>Type:</strong> <?php echo e($first->account->type ?? 'N/A'); ?><br>
                                                        <strong>Name:</strong> <?php echo e($first->account->name ?? 'N/A'); ?><br>
                                                        <strong>Number:</strong> <?php echo e($first->account->number ?? 'N/A'); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($first->payment_method === 'hand' && $first->user_id): ?>
                                                        <a href="<?php echo e(route('collector.history', $first->user_id)); ?>"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fa fa-history"></i>
                                                        </a>
                                                    <?php elseif($first->payment_method === 'account' && $first->account_id): ?>
                                                        <a href="<?php echo e(route('account.history', $first->account_id)); ?>"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fa fa-history"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.star').on('click', function() {
                $(this).toggleClass('star-checked');
            });

            $('.ckbox label').on('click', function() {
                $(this).parents('tr').toggleClass('selected');
            });

            $('.btn-filter').on('click', function() {
                var $target = $(this).data('target');
                if ($target != 'all') {
                    $('.table tr').css('display', 'none');
                    $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
                } else {
                    $('.table tr').css('display', 'none').fadeIn('slow');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/fee-collector/index.blade.php ENDPATH**/ ?>