

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Update Course Outline</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('course-outline.index', $course->id)); ?>" class="btn btn-sm btn-primary">All Outlines</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit Course Outline – <?php echo e($outline->week); ?></h2>
                        </div>
                        <div class="body">
                            <form id="basic-form"
                                  action="<?php echo e(route('course-outline.update', ['course' => $course->id, 'id' => $outline->id])); ?>"
                                  method="POST" novalidate>
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                
                                <div class="form-group">
                                    <label for="week">Week</label>
                                    <input type="text" name="week" class="form-control"
                                           value="<?php echo e(old('week', $outline->week)); ?>" required>
                                    <?php $__errorArgs = ['week'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div id="topics-wrapper">
                                    <?php $topics = old('topics', $outline->topics ?? []); ?>
                                    <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-group topic-block">
                                            <label>Topic</label>
                                            <input type="text" name="topics[<?php echo e($index); ?>][topic]" class="form-control"
                                                   value="<?php echo e($topic['topic']); ?>" required>

                                            <label class="mt-2">Time</label>
                                            <input type="text" name="topics[<?php echo e($index); ?>][time]" class="form-control"
                                                   value="<?php echo e($topic['time']); ?>">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="addTopic()">+ Add Another Topic</button>

                                <br>
                                <button type="submit" class="btn btn-primary">Update Course Outline</button>
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
    let topicIndex = <?php echo e(count($topics)); ?>;

    function addTopic() {
        const wrapper = document.getElementById('topics-wrapper');
        const html = `
            <div class="form-group topic-block">
                <label>Topic</label>
                <input type="text" name="topics[${topicIndex}][topic]" class="form-control" required>
                <label class="mt-2">Time</label>
                <input type="text" name="topics[${topicIndex}][time]" class="form-control" required>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);
        topicIndex++;
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/website/course/course-outline/update.blade.php ENDPATH**/ ?>