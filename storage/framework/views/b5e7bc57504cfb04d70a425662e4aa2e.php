


<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Notification Details</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('admin.notifications.table')); ?>" class="btn btn-sm btn-secondary">← Back to List</a>
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

                    
                    <div class="card mb-3">
                        <div class="header d-flex justify-content-between align-items-center">
                            <h2 class="mb-0">Overview</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">
                            <div class="d-flex align-items-start">
                                <div class="mr-3" style="font-size:28px;">
                                    <i class="<?php echo e($notification->icon ?: 'fa fa-bell'); ?>"></i>
                                </div>
                                <div class="flex-fill">
                                    <div class="mb-2">
                                        <span class="badge badge-secondary"><?php echo e(ucfirst($notification->type)); ?></span>
                                        <span class="badge badge-<?php echo e($notification->status ? 'success' : 'dark'); ?>"><?php echo e($notification->status ? 'Active' : 'Inactive'); ?></span>
                                    </div>

                                    <h5 class="mb-1"><?php echo e($notification->title); ?></h5>

                                    <?php if($notification->message): ?>
                                        <p class="mb-2"><?php echo e($notification->message); ?></p>
                                    <?php endif; ?>

                                    <div class="text-muted small">
                                        <span>Created: <?php echo e($notification->created_at->format('d M Y, h:i A')); ?></span>
                                        <?php if($notification->updated_at): ?>
                                            <span class="ml-3">Updated: <?php echo e($notification->updated_at->format('d M Y, h:i A')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="card">
                        <div class="header d-flex justify-content-between align-items-center">
                            <h2 class="mb-0">Recipients</h2>
                            
                            <div class="small">
                                <span class="badge badge-warning">Unread</span>
                                <span class="badge badge-success">Read</span>
                            </div>
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Assigned</th>
                                            <th>Last Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $recipients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e(($recipients->currentPage() - 1) * $recipients->perPage() + $idx + 1); ?></td>
                                                <td><?php echo e($u->name); ?></td>
                                                <td><?php echo e($u->email); ?></td>
                                                <td>
                                                    <?php if($u->is_read): ?>
                                                        <span class="badge badge-success">Read</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-warning">Unread</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e(\Carbon\Carbon::parse($u->assigned_at)->format('d M Y, h:i A')); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::parse($u->last_action_at)->format('d M Y, h:i A')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No recipients found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php if($recipients->hasPages()): ?>
                                <div class="mt-3">
                                    <?php echo e($recipients->links('pagination::bootstrap-4')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div> 
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/notification/show.blade.php ENDPATH**/ ?>