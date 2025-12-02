
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Commission</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    
                    
                </div>
            </div>
        </div>
        
        <?php if(session('store')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('store')); ?>

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
                            <h2>Referral Commission</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table mt-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Referral Name</th>
                                            <th>Contact</th>
                                            <th>Students</th>
                                            <th>Total Fee</th>
                                            <th>Avg %</th>
                                            <th>Total Amount</th>
                                            <th>Paid</th>
                                            <th>Unpaid</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $referrers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $ref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($i + 1); ?></td>
                                                <td><?php echo e($ref->referral_name ?? 'N/A'); ?></td>
                                                <td><?php echo e($ref->referral_contact ?? 'N/A'); ?></td>
                                                <td><?php echo e($ref->total_students); ?></td>

                                                <td><strong><?php echo e(number_format((float) $ref->total_student_fee)); ?></strong>
                                                </td>
                                                <td><?php echo e(rtrim(rtrim(number_format((float) $ref->avg_pct, 2), '0'), '.')); ?>%
                                                </td>
                                                <td><strong><?php echo e(number_format((float) $ref->total_amount)); ?></strong></td>

                                                <td class="text-success"><?php echo e(number_format((float) $ref->paid_total, 2)); ?>

                                                    PKR</td>
                                                <td class="text-danger"><?php echo e(number_format((float) $ref->unpaid_total, 2)); ?>

                                                    PKR</td>

                                                <td>
                                                    
                                                    <form method="POST" action="<?php echo e(route('referral-commission.paid')); ?>"
                                                        style="display:inline-block;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <input type="hidden" name="referral_name"
                                                            value="<?php echo e($ref->referral_name); ?>">
                                                        <input type="hidden" name="contact_key"
                                                            value="<?php echo e($ref->contact_key); ?>"> 
                                                        <button type="submit" class="btn btn-sm btn-success">Paid</button>
                                                    </form>

                                                    
                                                    <a href="<?php echo e(route('referral-commission.history', [$ref->referral_name, $ref->contact_key])); ?>"
                                                        class="btn btn-sm btn-info">
                                                        History
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="10" class="text-center">No referral commissions found.</td>
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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/referral-commission/index.blade.php ENDPATH**/ ?>