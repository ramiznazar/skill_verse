
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Follow-ups • <?php echo e($lead->name); ?> <?php if($lead->course): ?>
                            <small class="text-muted">(<?php echo e($lead->course->title); ?>)</small>
                        <?php endif; ?>
                    </h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('lead-followups.create', $lead->id)); ?>" class="btn btn-sm btn-primary">Create New</a>
                    <a href="<?php echo e(route('lead.index')); ?>" class="btn btn-sm btn-secondary">All Leads</a>
                </div>
            </div>
        </div>

        
        <?php $__currentLoopData = ['store' => 'success', 'update' => 'warning', 'delete' => 'danger']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            <h2>Follow-ups (<?php echo e($followUps->total()); ?>)</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <div class="timeline">
    <?php $__empty_1 = true; $__currentLoopData = $followUps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="timeline-item mb-4 p-3 border rounded shadow-sm">
            <div class="d-flex justify-content-between">
                <strong><?php echo e(optional($fu->followed_at)->format('d M Y, h:i A') ?? '-'); ?></strong>
                <span class="badge badge-<?php echo e($fu->status === 'interested' ? 'info' : ($fu->status === 'not_interested' ? 'dark' : ($fu->status === 'converted' ? 'success' : ($fu->status === 'lost' ? 'danger' : 'secondary')))); ?>">
                    <?php echo e(ucwords(str_replace('_', ' ', $fu->status))); ?>

                </span>
            </div>
            <div class="mt-2">
                <span class="badge badge-primary"><?php echo e(ucfirst(str_replace('_', ' ', $fu->contact_method))); ?></span>
                <p class="mt-2 mb-1"><?php echo e($fu->note ?? '-'); ?></p>
                <small class="text-muted">By: <?php echo e($fu->user->name ?? '-'); ?></small>
            </div>
            <div class="mt-2 d-flex">
                <a href="<?php echo e(route('lead-followups.edit', [$lead->id, $fu->id])); ?>" class="btn btn-sm btn-outline-warning mr-2">Edit</a>
                <form action="<?php echo e(route('lead-followups.destroy', [$lead->id, $fu->id])); ?>" method="POST" onsubmit="return confirm('Delete this follow-up?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-muted">No follow-ups yet.</p>
    <?php endif; ?>
</div>


<div class="mt-3">
    <?php echo e($followUps->links('pagination::bootstrap-4')); ?>

</div>

                            </div>

                            <div class="mt-3">
                                <?php echo e($followUps->links()); ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/lead/follow-up/index.blade.php ENDPATH**/ ?>