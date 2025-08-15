
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Events</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('event.create')); ?>" class="btn btn-sm btn-primary" title="">Create New</a>
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
                            <h2>All Events</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Time & Date</th>
                                            <th>Map</th>
                                            <th>Address</th>
                                            <th>Description</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><img src="<?php echo e(asset($event->image)); ?>" width="100" alt=""></td>
                                                <td><?php echo e($event->title); ?></td>
                                                <td>
                                                    <strong class="text-muted"><?php echo e($event->start_time); ?> - <?php echo e($event->end_time); ?></strong> <br>
                                                    <small class="text-info"><?php echo e($event->date); ?></small>
                                                </td>
                                                <td><?php echo e($event->map); ?></td>
                                                <td><?php echo e($event->address); ?></td>
                                                <td><?php echo e(\Illuminate\Support\Str::words($event->description, 7, '...')); ?></td>
                                                <td class="actions">
                                                    <div class="d-flex align-items-center" style="gap: 5px;" >
                                                        <!-- Event Links -->
                                                        <a href="<?php echo e(route('event-link.index',$event->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Event Links">
                                                            <i class="fas fa-microphone-alt" aria-hidden="true"></i>
                                                        </a>
                                                        <!-- Event Participants -->
                                                        <a href="<?php echo e(route('event-participant.index',$event->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Event Participants">
                                                            <i class="bi bi-people" aria-hidden="true"></i>
                                                        </a>
                                                        <!-- Edit Button -->
                                                        <a href="<?php echo e(route('event.edit', $event->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>
                                                        <!-- Delete Button -->
                                                        <form action="<?php echo e(route('event.destroy', $event->id)); ?>"
                                                            method="POST" onsubmit="return confirm('Are you sure?')">
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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/website/event/all-event.blade.php ENDPATH**/ ?>