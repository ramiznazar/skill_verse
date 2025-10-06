
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Course Outlines</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('course-outline.index', $course->id)); ?>" class="btn btn-sm btn-primary"
                        title="">All Outlines</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Course</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="<?php echo e(route('course-outline.store', $course->id)); ?>" method="POST"
                                novalidate>
                                <?php echo csrf_field(); ?>

                                
                                <div class="form-group">
                                    <label for="week">Week</label>
                                    <input type="text" name="week" class="form-control" placeholder="e.g., Week 1"
                                        value="<?php echo e(old('week')); ?>">
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

                                
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control"
                                        placeholder="e.g., Introduction to HTML & Tools" value="<?php echo e(old('title')); ?>"
                                        required>
                                    <?php $__errorArgs = ['title'];
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
                                    <div class="form-group topic-block">
                                        <label>Topic</label>
                                        <input type="text" name="topics[0][topic]" class="form-control"
                                            placeholder="Enter topic" required>

                                        
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="addTopic()">+ Add
                                    Another Topic</button>

                                <br>
                                <button type="submit" class="btn btn-primary">Add Course Outline</button>
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
        $(function() {
            // validation needs name of the element
            $('#food').multiselect();

            // initialize after multiselect
            $('#basic-form').parsley();
        });
    </script>
<?php $__env->stopSection(); ?>

<script>
    let topicIndex = 1;

    function addTopic() {
        const wrapper = document.getElementById('topics-wrapper');
        const newTopicHTML = `
            <div class="form-group topic-block">
                <label>Topic</label>
                <input type="text" name="topics[${topicIndex}][topic]" class="form-control" placeholder="Enter topic" required>

                
            </div>
        `;
        //<label class="mt-2">Time</label>
        //        <input type="text" name="topics[${topicIndex}][time]" class="form-control" placeholder="e.g., 45 mins" required>
        wrapper.insertAdjacentHTML('beforeend', newTopicHTML);
        topicIndex++;
    }
</script>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/website/course/course-outline/create.blade.php ENDPATH**/ ?>