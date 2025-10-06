

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Notifications</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    
                    
                </div>
            </div>
        </div>

        
        <?php $__currentLoopData = ['store' => 'success', 'delete' => 'danger', 'update' => 'warning', 'status' => 'success']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            <h2>All Notifications</h2>
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
                            
                            <form method="GET" action="<?php echo e(route('admin.notifications.table')); ?>" id="filterForm" class="mb-3">
                                <div class="input-group mb-2">
                                    <input type="text"
                                           name="search"
                                           value="<?php echo e($search ?? request('search')); ?>"
                                           class="form-control"
                                           placeholder="Search title / message / type..."
                                           autocomplete="off">
                                </div>

                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-md-3 mb-2">
                                        <select name="type" class="form-control">
                                            <option value="" <?php echo e(($type ?? request('type')) === '' ? 'selected' : ''); ?>>All Types</option>
                                            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($t); ?>"
                                                    <?php echo e((string)($type ?? request('type')) === (string)$t ? 'selected' : ''); ?>>
                                                    <?php echo e(ucfirst($t)); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <select name="status" class="form-control">
                                            <option value="" <?php echo e(($status ?? request('status')) === '' ? 'selected' : ''); ?>>All Status</option>
                                            <option value="1" <?php echo e(($status ?? request('status')) === '1' ? 'selected' : ''); ?>>Active</option>
                                            <option value="0" <?php echo e(($status ?? request('status')) === '0' ? 'selected' : ''); ?>>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <input type="date" name="date_from" class="form-control"
                                               value="<?php echo e($dateFrom ?? request('date_from')); ?>" placeholder="From">
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <input type="date" name="date_to" class="form-control"
                                               value="<?php echo e($dateTo ?? request('date_to')); ?>" placeholder="To">
                                    </div>
                                </div>
                            </form>

                            
                            <form method="POST" action="<?php echo e(route('admin.notifications.bulkStatus')); ?>">
                                <?php echo csrf_field(); ?>

                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width:36px;">
                                                    <input type="checkbox" id="checkAll">
                                                </th>
                                                <th>#</th>
                                                <th>Title & Message</th>
                                                <th>Type</th>
                                                <th>Recipients</th>
                                                <th>Unread</th>
                                                <th>Read</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="ids[]" value="<?php echo e($n->id); ?>" class="row-check">
                                                    </td>
                                                    <td><?php echo e($loop->iteration + ($notifications->currentPage() - 1) * $notifications->perPage()); ?></td>
                                                    <td>
                                                        <div class="d-flex align-items-start">
                                                            <div class="mr-2" style="font-size:18px;">
                                                                <i class="<?php echo e($n->icon ?: 'fa fa-bell'); ?>"></i>
                                                            </div>
                                                            <div>
                                                                <div class="font-weight-bold"><?php echo e($n->title); ?></div>
                                                                <div class="text-muted small text-truncate" style="max-width:420px;">
                                                                    <?php echo e($n->message); ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-secondary"><?php echo e(ucfirst($n->type)); ?></span>
                                                    </td>
                                                    <td><?php echo e($n->recipients_count); ?></td>
                                                    <td>
                                                        <?php if($n->unread_count > 0): ?>
                                                            <span class="badge badge-warning"><?php echo e($n->unread_count); ?></span>
                                                        <?php else: ?>
                                                            <span class="text-muted">0</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($n->read_count); ?></td>
                                                    <td>
                                                        <span class="badge badge-<?php echo e($n->status ? 'success' : 'dark'); ?>">
                                                            <?php echo e($n->status ? 'Active' : 'Inactive'); ?>

                                                        </span>
                                                    </td>
                                                    <td><?php echo e($n->created_at->format('d M Y, h:i A')); ?></td>
                                                    <td class="text-nowrap">
                                                        <a href="<?php echo e(route('admin.notifications.show', $n)); ?>"
                                                           class="btn btn-sm btn-icon btn-pure btn-default"
                                                           data-toggle="tooltip" data-original-title="View">
                                                            <i class="icon-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="10" class="text-center text-muted">No notifications found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                
                                <div class="mt-3">
                                    <?php echo e($notifications->links('pagination::bootstrap-4')); ?>

                                </div>

                                
                                <div class="d-flex gap-2 mt-3">
                                    <button name="status" value="1" class="btn btn-success btn-sm">Activate</button>
                                    <button name="status" value="0" class="btn btn-dark btn-sm">Deactivate</button>
                                </div>
                            </form>

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
    if (search) {
        search.addEventListener('input', () => {
            clearTimeout(t);
            t = setTimeout(() => form.submit(), 500);
        });
    }

    // bulk check
    const checkAll = document.getElementById('checkAll');
    if (checkAll) {
        checkAll.addEventListener('change', function(){
            document.querySelectorAll('.row-check').forEach(cb => cb.checked = this.checked);
        });
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/notification/index.blade.php ENDPATH**/ ?>