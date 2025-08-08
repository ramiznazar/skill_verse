
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Courses</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('course.create')); ?>" class="btn btn-sm btn-primary" title="">Create New</a>
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
                            <h2>All Courses</h2>
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
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Duration</th>
                                            <th>Full Fee</th>
                                            <th>Discount%</th>
                                            <th>MinFee</th>
                                            <th>Short Des</th>
                                            <th>Des</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><span><img src="<?php echo e(asset($course->image)); ?>" width="60"
                                                            height="60" style="border-radius: 50%;"
                                                            alt=""></span></td>
                                                <td><?php echo e($course->title); ?></td>
                                                <td><span
                                                        class="text-info"><?php echo e($course->courseCategory->name ?? 'N/A'); ?></span>
                                                </td>
                                                <td><?php echo e($course->duration); ?></td>
                                                <td><?php echo e($course->full_fee); ?></td>
                                                <td><?php echo e($course->discount); ?>%</td>
                                                <td><?php echo e(intval($course->min_fee)); ?></td>
                                                <td><?php echo e(\Illuminate\Support\Str::words($course->short_description, 5, '...')); ?>

                                                <td><?php echo e(\Illuminate\Support\Str::words($course->description, 7, '...')); ?>

                                                </td>
                                                
                                                <td class="actions">
                                                    <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                        
                                                        <a href="<?php echo e(route('course-lms.index', $course->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Add LMS Course">
                                                            <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                                                        </a>

                                                        
                                                        <a href="<?php echo e(route('course-outline.index', $course->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip"
                                                            data-original-title="Add Programming Language">
                                                            <i class="fas fa-code" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- Edit Button -->
                                                        <a href="<?php echo e(route('course.edit', $course->id)); ?>"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form action="<?php echo e(route('course.destroy', $course->id)); ?>"
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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/website/course/all-course.blade.php ENDPATH**/ ?>