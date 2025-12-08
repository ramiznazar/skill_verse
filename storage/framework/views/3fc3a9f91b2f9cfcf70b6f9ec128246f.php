

<?php $__env->startSection('content'); ?>
<div id="main-content">

    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Interview Days</h2>
            </div>

            <div class="col-md-6 col-sm-12 text-right">
                <a href="<?php echo e(route('test.days.create')); ?>" class="btn btn-primary btn-sm">Add New Day</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">

                <div class="card">
                    <div class="header">
                        <h2>All Interview Days</h2>
                    </div>

                    <div class="body">
                        <div class="table-responsive">
                                <table class="table m-b-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Slots Summary</th>
                                        <th>Status</th>
                                        <th>Note</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $slots = json_decode($day->slots, true);
                                        ?>
                                        

                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>

                                            <td>
                                                <strong><?php echo e($day->test_date); ?></strong>
                                            </td>

                                            <td>
                                                
                                                <?php if(!$slots || count($slots) == 0): ?>
                                                    <span class="badge badge-secondary">No Slots</span>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="mb-1">
                                                            <span class="badge badge-info">
                                                                <?php echo e($slot['time']); ?>

                                                            </span>

                                                            <span class="badge badge-primary">
                                                                <?php echo e($slot['booked']); ?>/<?php echo e($slot['capacity']); ?>

                                                            </span>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <?php if($day->is_open): ?>
                                                    <span class="badge badge-success">Open</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">Closed</span>
                                                <?php endif; ?>
                                            </td>

                                            <td><?php echo e($day->note ?? '-'); ?></td>

                                            <td>
                                                <a href="<?php echo e(route('test.days.edit', $day->id)); ?>" 
                                                   class="btn btn-sm btn-info">
                                                   <i class="icon-pencil"></i>
                                                </a>

                                                <form action="<?php echo e(route('test.days.delete', $day->id)); ?>"
                                                      method="POST"
                                                      style="display:inline-block;"
                                                      onsubmit="return confirm('Are you sure?')">

                                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>

                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="icon-trash"></i>
                                                    </button>

                                                </form>
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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/test/days/index.blade.php ENDPATH**/ ?>