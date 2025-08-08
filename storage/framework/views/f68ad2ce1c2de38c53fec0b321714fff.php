
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Batches</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('batch.create')); ?>" class="btn btn-sm btn-primary" title="">Create New</a>
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
                            <h2>All Batches</h2>
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
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course</th>
                                            <th>Title</th>
                                            <th>Teacher</th>
                                            <th>Shift</th>
                                            <th>Timing</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Capacity</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td> <span class="text-primary"><?php echo e($batch->course->title ?? 'N/A'); ?></span> </td>
                                                <td><?php echo e($batch->title ?? '-'); ?></td>
                                                <td><?php echo e($batch->teacher->name ?? '-'); ?></td>
                                                <td><span class="badge badge-info text-uppercase"><?php echo e($batch->shift); ?></span> </td>
                                                <td><?php echo e($batch->timing); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::parse($batch->start_date)->format('d M, Y')); ?></td>
                                                <td>
                                                    <?php if($batch->end_date): ?>
                                                        <?php echo e(\Carbon\Carbon::parse($batch->end_date)->format('d M, Y')); ?>

                                                    <?php else: ?>
                                                        <span class="text-muted">N/A</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($batch->capacity ?? '-'); ?></td>

                                                
                                                <td>
                                                    <?php if($batch->status === 'active'): ?>
                                                        <span class="badge badge-success">Active</span>
                                                    <?php elseif($batch->status === 'completed'): ?>
                                                        <span class="badge badge-secondary">Completed</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($batch->note); ?></td>

                                                
                                                <td class="actions">
                                                    <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                        <!-- Edit -->
                                                        <a href="<?php echo e(route('batch.edit', $batch->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- Delete -->
                                                        <form action="<?php echo e(route('batch.destroy', $batch->id)); ?>"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this batch?')">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                                data-toggle="tooltip" data-original-title="Remove">
                                                                <i class="icon-trash" aria-hidden="true"></i>
                                                            </button>
                                                        </form>
                                                    </div>
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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/batch/index.blade.php ENDPATH**/ ?>