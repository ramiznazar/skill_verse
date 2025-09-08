
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Student Admissions</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('admission.create')); ?>" class="btn btn-sm btn-primary" title="">Create New</a>
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
                            <h2>All Admissions</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Batch</th>
                                            <th>Payment</th>
                                            <th>Fee</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php $__empty_1 = true; $__currentLoopData = $admissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($loop->remaining + 1); ?></td>


                                                
                                                <td>
                                                    <img src="<?php echo e(asset($admission->image ?? 'default-avatar.png')); ?>"
                                                        width="50" height="50"
                                                        style="border-radius: 50%; object-fit: cover;">
                                                </td>
                                                <td><?php echo e($admission->name); ?></td>
                                                <td><?php echo e($admission->course->title ?? '-'); ?></td>
                                                <td><?php echo e($admission->batch->title ?? '-'); ?></td>
                                                <td>
                                                    <span
                                                        class="badge badge-<?php echo e($admission->payment_type === 'full_fee' ? 'success' : 'warning'); ?>">
                                                        <?php echo e(ucfirst($admission->payment_type)); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <div>Fee: ₨<?php echo e(number_format($admission->full_fee)); ?></div>
                                                    <?php if($admission->payment_type === 'installment'): ?>
                                                        <div style="font-size: 12px; color: #666;">
                                                            1st: <?php echo e($admission->installment_1); ?><br>
                                                            2nd: <?php echo e($admission->installment_2); ?><br>
                                                            3rd: <?php echo e($admission->installment_3); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-<?php echo e($admission->student_status === 'active' ? 'success' : 'secondary'); ?>">
                                                        <?php echo e(ucfirst($admission->student_status)); ?>

                                                    </span>
                                                </td>

                                                
                                                <td class="text-nowrap">
                                                    <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                        
                                                        <a href="<?php echo e(route('fee-submission.create', $admission->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-view"
                                                            data-toggle="tooltip" data-original-title="Submit Fee">
                                                            <i class="fas fa-money-check-alt"></i>
                                                        </a>

                                                        <!-- Edit Button -->
                                                        <a href="<?php echo e(route('admission.edit', $admission->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form action="<?php echo e(route('admission.destroy', $admission->id)); ?>"
                                                            method="POST" onsubmit="return confirm('Are you sure?')">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                                data-toggle="tooltip" data-original-title="Remove">
                                                                <i class="icon-trash" aria-hidden="true"></i>
                                                            </button>
                                                    </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="9" class="text-center text-muted">No admissions found.</td>
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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/admission/index.blade.php ENDPATH**/ ?>