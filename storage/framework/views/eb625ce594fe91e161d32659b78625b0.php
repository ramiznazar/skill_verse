
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
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>When</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                            <th>By</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $followUps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $fu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($followUps->firstItem() + $i); ?></td>
                                                <td><?php echo e(optional($fu->followed_at)->format('d M Y, h:i A') ?? '-'); ?></td>
                                                <td><?php echo e($fu->contact_method === 'in_person' ? 'In-person' : ucfirst(str_replace('_', ' ', $fu->contact_method ?? '-'))); ?>

                                                </td>
                                                <td><?php echo e($fu->status ? ucwords(str_replace('_', ' ', $fu->status)) : '-'); ?>

                                                </td>
                                                <td style="max-width:480px; white-space:normal;"><?php echo e($fu->note ?? '-'); ?>

                                                </td>
                                                <td><?php echo e($fu->user->name ?? '-'); ?></td>
                                                <td class="text-nowrap">
                                                    <a href="<?php echo e(route('lead-followups.edit', [$lead->id, $fu->id])); ?>"
                                                        class="btn btn-sm btn-icon btn-pure btn-default" title="Edit">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <form
                                                        action="<?php echo e(route('lead-followups.destroy', [$lead->id, $fu->id])); ?>"
                                                        method="POST" style="display:inline"
                                                        onsubmit="return confirm('Delete this follow-up?')">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                        <button class="btn btn-sm btn-icon btn-pure btn-default"
                                                            title="Delete">
                                                            <i class="icon-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No follow-ups yet.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
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