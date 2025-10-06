
<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Course Details</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="<?php echo e(route('course.index')); ?>" class="btn btn-sm btn-primary">All Courses</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="body">

                
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <?php if($course->image): ?>
                            <img src="<?php echo e(asset($course->image)); ?>" 
                                 class="img-thumbnail" width="150" height="150" alt="Course Image">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/150" class="img-thumbnail" alt="No Image">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-9">
                        <h4 class="mb-2"><?php echo e($course->title); ?></h4>
                        <p><strong>Slug:</strong> <?php echo e($course->slug); ?></p>
                        <p><strong>Category:</strong> <?php echo e($course->courseCategory->name ?? 'N/A'); ?></p>
                        <p><strong>Duration:</strong> <?php echo e($course->duration ?? 'N/A'); ?></p>
                        <p><strong>Status:</strong> 
                            <?php if($course->is_active): ?>
                                <span class="badge badge-success">Active</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Inactive</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <hr>

                
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Full Fee:</strong> ₨<?php echo e(number_format($course->full_fee)); ?></p>
                        <p><strong>Discount:</strong> <?php echo e($course->discount); ?>%</p>
                        <p><strong>Minimum Fee:</strong> ₨<?php echo e(number_format($course->min_fee)); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Created At:</strong> <?php echo e($course->created_at->format('d M Y')); ?></p>
                        <p><strong>Updated At:</strong> <?php echo e($course->updated_at->format('d M Y')); ?></p>
                        <p><strong>Added By:</strong> <?php echo e($course->created_by ?? 'N/A'); ?></p>
                    </div>
                </div>

                <hr>

                
                <div class="row">
                    <div class="col-md-12">
                        <h5>Short Description</h5>
                        <p><?php echo e($course->short_description ?? 'N/A'); ?></p>

                        <h5 class="mt-3">Detailed Description</h5>
                        <p><?php echo nl2br(e($course->description ?? 'N/A')); ?></p>
                    </div>
                </div>

                <hr>

                
                <div class="row">
                    <div class="col-md-6">
                        <h5>Outlines</h5>
                        <?php if(isset($course->outlines) && count($course->outlines) > 0): ?>
                            <ul>
                                <?php $__currentLoopData = $course->outlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($outline->title); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">No outlines added yet.</p>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <h5>LMS Courses</h5>
                        <?php if(isset($course->lmsCourses) && count($course->lmsCourses) > 0): ?>
                            <ul>
                                <?php $__currentLoopData = $course->lmsCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($lms->title); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">No LMS courses added yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/website/course/view.blade.php ENDPATH**/ ?>