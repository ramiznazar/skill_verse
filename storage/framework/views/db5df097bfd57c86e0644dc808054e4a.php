

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Student Admissions</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('admission.create')); ?>" class="btn btn-sm btn-primary">Create New</a>
                </div>
            </div>
        </div>

        
        <?php $__currentLoopData = ['store' => 'success', 'delete' => 'danger', 'update' => 'warning']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(session($key)): ?>
                <div class="alert alert-<?php echo e($type); ?> alert-dismissible fade show" role="alert">
                    <?php echo e(session($key)); ?>

                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Admissions</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse">
                                        <i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">

                            
                            <form method="GET" action="<?php echo e(route('admission.index')); ?>" id="filterForm" class="mb-3">
                                <div class="input-group mb-2">
                                    <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                                           class="form-control" placeholder="Search student..." autocomplete="off">
                                </div>

                                <div class="row" style="margin-top: 15px;" >
                                    <div class="col-md-3 mb-2">
                                        <select name="course_id" class="form-control">
                                            <option value="">Filter by Course</option>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($course->id); ?>"
                                                    <?php echo e((string)request('course_id') === (string)$course->id ? 'selected' : ''); ?>>
                                                    <?php echo e($course->title); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <select name="batch_id" class="form-control">
                                            <option value="">Filter by Batch</option>
                                            <?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($batch->id); ?>"
                                                    <?php echo e((string)request('batch_id') === (string)$batch->id ? 'selected' : ''); ?>>
                                                    <?php echo e($batch->title); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <select name="status" class="form-control">
                                            <option value="all" <?php echo e(request('status', 'all') === 'all' ? 'selected' : ''); ?>>All Student Status</option>
                                            <option value="active" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>Active</option>
                                            <option value="unactive" <?php echo e(request('status') === 'unactive' ? 'selected' : ''); ?>>Unactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <select name="payment" class="form-control">
                                            <option value="" <?php echo e(request('payment') ? '' : 'selected'); ?>>All Payment Types</option>
                                            <option value="full_fee" <?php echo e(request('payment') === 'full_fee' ? 'selected' : ''); ?>>Full Payment</option>
                                            <option value="installment" <?php echo e(request('payment') === 'installment' ? 'selected' : ''); ?>>Installment</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Mode</th>
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
                                                <td><?php echo e($loop->iteration + ($admissions->currentPage() - 1) * $admissions->perPage()); ?></td>
                                                
                                                <td><?php echo e($admission->name); ?></td>
                                                <td><?php echo e($admission->course->title ?? '-'); ?></td>
                                                <td><?php echo e($admission->batch->title ?? '-'); ?></td>
                                                 <td>
                                                    <span
                                                        class="badge badge-<?php echo e($admission->mode === 'physical' ? 'success' : 'warning'); ?>">
                                                        <?php echo e(ucfirst($admission->mode)); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-<?php echo e($admission->payment_type === 'full_fee' ? 'success' : 'warning'); ?>">
                                                        <?php echo e(ucfirst($admission->payment_type)); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <div>₨<?php echo e(number_format($admission->full_fee)); ?></div>
                                                    <?php if($admission->payment_type === 'installment'): ?>
                                                        <small class="text-muted">
                                                            <?php if($admission->installment_1 > 0): ?>
                                                                1st: <?php echo e($admission->installment_1); ?>

                                                            <?php endif; ?>
                                                            <?php if($admission->installment_2 > 0): ?>
                                                                | 2nd: <?php echo e($admission->installment_2); ?>

                                                            <?php endif; ?>
                                                            <?php if($admission->installment_3 > 0): ?>
                                                                | 3rd: <?php echo e($admission->installment_3); ?>

                                                            <?php endif; ?>
                                                        </small>
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
                                                           class="btn btn-sm btn-icon btn-pure btn-default"
                                                           data-toggle="tooltip" data-original-title="Submit Fee">
                                                            <i class="fas fa-money-check-alt"></i>
                                                        </a>
                                                        <a href="<?php echo e(route('admission.show', $admission->id)); ?>"
                                                           class="btn btn-sm btn-icon btn-pure btn-default"
                                                           data-toggle="tooltip" data-original-title="View">
                                                            <i class="icon-eye"></i>
                                                        </a>
                                                        <a href="<?php echo e(route('admission.edit', $admission->id)); ?>"
                                                           class="btn btn-sm btn-icon btn-pure btn-default"
                                                           data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil"></i>
                                                        </a>
                                                        <form action="<?php echo e(route('admission.destroy', $admission->id)); ?>"
                                                              method="POST"
                                                              onsubmit="return confirm('Are you sure?')">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-icon btn-pure btn-default"
                                                                    data-toggle="tooltip" data-original-title="Remove">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
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

                            
                            <div class="mt-3">
                                <?php echo e($admissions->links('pagination::bootstrap-4')); ?>

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
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('filterForm');
    const search = form.querySelector('input[name="search"]');
    const selects = form.querySelectorAll('select');

    // auto-submit on select change
    selects.forEach(sel => sel.addEventListener('change', () => form.submit()));

    // debounce search typing
    let t;
    search && search.addEventListener('input', () => {
        clearTimeout(t);
        t = setTimeout(() => form.submit(), 500);
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/admission/index.blade.php ENDPATH**/ ?>