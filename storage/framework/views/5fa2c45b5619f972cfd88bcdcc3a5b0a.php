
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Expenses</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <?php if(Auth::user()->role !== 'partner'): ?>
                        <a href="<?php echo e(route('expense.create')); ?>" class="btn btn-sm btn-primary">Create New</a>
                    <?php endif; ?>
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
            <div class="card">
                <div class="header">
                    <h2>All Expenses</h2>
                </div>
                <div class="body">

                    
                    <form method="GET" action="<?php echo e(route('expense.index')); ?>" id="filterForm" class="mb-3">
                        <div class="input-group mb-2">
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control"
                                placeholder="Search expense title or purpose...">
                        </div>

                        <div class="row" style="margin-top:15px;">
                            <div class="col-md-4 mb-2">
                                <input type="month" name="month" value="<?php echo e(request('month')); ?>" class="form-control"
                                    placeholder="Filter by Month">
                            </div>

                            <div class="col-md-4 mb-2">
                                <select name="type" class="form-control">
                                    <option value="">All Types</option>
                                    <option value="essential" <?php echo e(request('type') === 'essential' ? 'selected' : ''); ?>>
                                        Essential</option>
                                    <option value="non-essential"
                                        <?php echo e(request('type') === 'non-essential' ? 'selected' : ''); ?>>Non-Essential</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-2">
                                <select name="ref_type" class="form-control">
                                    <option value="">All Categories</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cat); ?>"
                                            <?php echo e(request('ref_type') === $cat ? 'selected' : ''); ?>>
                                            <?php echo e(ucfirst($cat)); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </form>

                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="alert alert-info mb-0">
                                <strong>Total Expenses:</strong> ₨ <?php echo e(number_format($totalExpense)); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-warning mb-0">
                                <strong>Essential Total:</strong> ₨ <?php echo e(number_format($essentialTotal)); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-success mb-0">
                                <strong>Non-Essential Total:</strong> ₨ <?php echo e(number_format($nonEssentialTotal)); ?>

                            </div>
                        </div>
                    </div>

                    
                    <div class="table-responsive">
                        <table class="table table-hover m-b-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Purpose</th>
                                    <?php if(Auth::user()->role !== 'partner'): ?>
                                        <th>Actions</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration + ($expenses->currentPage() - 1) * $expenses->perPage()); ?>

                                        </td>
                                        <td><?php echo e($expense->title); ?></td>
                                        <td>₨ <?php echo e(number_format($expense->amount)); ?></td>
                                        <td>
                                            <span
                                                class="badge badge-<?php echo e($expense->type === 'essential' ? 'success' : 'danger'); ?>">
                                                <?php echo e(ucfirst($expense->type)); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <?php if($expense->ref_type): ?>
                                                <span class="badge badge-info"><?php echo e(ucfirst($expense->ref_type)); ?></span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary">N/A</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(\Carbon\Carbon::parse($expense->date)->format('d-M-Y')); ?></td>
                                        <td><?php echo e($expense->purpose); ?></td>

                                        <?php if(Auth::user()->role !== 'partner'): ?>
                                            <td>
                                                <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                    <a href="<?php echo e(route('expense.edit', $expense->id)); ?>"
                                                        class="btn btn-sm btn-icon btn-pure btn-default" title="Edit">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <form action="<?php echo e(route('expense.destroy', $expense->id)); ?>"
                                                        method="POST" onsubmit="return confirm('Are you sure?')">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-icon btn-pure btn-default" title="Delete">
                                                            <i class="icon-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No expenses found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="mt-3">
                        <?php echo e($expenses->links('pagination::bootstrap-4')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-javascript'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filterForm');
            const inputs = form.querySelectorAll('input, select');
            let timeout;

            inputs.forEach(el => {
                el.addEventListener('change', () => form.submit());
                if (el.type === 'text') {
                    el.addEventListener('input', () => {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => form.submit(), 500);
                    });
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/expense/index.blade.php ENDPATH**/ ?>