
<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?php echo e(asset('assets/website/images/institute/15.jpg')); ?>">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Course Details</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                
                                <li class="active text-gray-silver">Course Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Blog -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 blog-pull-right">
                        <div class="single-service">
                            <img src="<?php echo e($course->image); ?>" alt="">
                            <h3 class="text-theme-colored line-bottom text-theme-colored"><?php echo e($course->title); ?></h3>
                            <h4 class="mt-0"><span class="text-theme-color-2">Duration :</span> <?php echo e($course->duration); ?></h4>
                            
                            <h5><?php echo e($course->description); ?></p>
                                <h4 class="line-bottom mt-20 mb-20 text-theme-colored">Course Outline</h4>

                                <?php if($courseOutlines->isNotEmpty()): ?>
                                    <ul id="myTab" class="nav nav-tabs boot-tabs">
                                        <?php $__currentLoopData = $courseOutlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $outline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="<?php echo e($index === 0 ? 'active' : ''); ?>">
                                                <a href="#week<?php echo e($index); ?>"
                                                    data-toggle="tab"><?php echo e($outline->week); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>

                                    <div id="myTabContent" class="tab-content">
                                        <?php $__currentLoopData = $courseOutlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $outline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="tab-pane fade <?php echo e($index === 0 ? 'in active' : ''); ?>"
                                                id="week<?php echo e($index); ?>">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td colspan="2"
                                                                class="text-center font-16 font-weight-600 bg-theme-color-2 text-white">
                                                                <?php echo e($outline->week); ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Topic</th>
                                                            <th>Time</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $outline->topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($topic['topic']); ?></td>
                                                                <td><?php echo e($topic['time']); ?></td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <p>No course outline available yet.</p>
                                <?php endif; ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="sidebar sidebar-left mt-sm-30 ml-40">
                            <div class="widget">
                                <h4 class="widget-title line-bottom">Courses <span class="text-theme-color-2">List</span>
                                </h4>
                                <div class="services-list">
                                    <ul class="list list-border angle-double-right">
                                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="<?php echo e($item->id == $course->id ? 'active' : ''); ?>">
                                                <a href="<?php echo e(route('course.detail', $item->id)); ?>"><?php echo e($item->title); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="widget">
                                <h4 class="widget-title line-bottom">Course <span
                                        class="text-theme-color-2">Information</span>
                                </h4>
                                <div class="opening-hours">
                                    <ul class="list-border">
                                        <li class="clearfix"> <span> Duration : </span>
                                            <div class="value pull-right"> <?php echo e($course->duration); ?> </div>
                                        </li>
                                        <li class="clearfix"> <span> Level :</span>
                                            <div class="value pull-right"> <?php echo e($course->level); ?> </div>
                                        </li>
                                        <li class="clearfix"> <span> Mode : </span>
                                            <div class="value pull-right"> <?php echo e($course->mode); ?> </div>
                                        </li>
                                        <li class="clearfix"> <span> Certified : </span>
                                            <div class="value pull-right"> Yes </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget">
                                

                                <!-- Quick Contact Form Validation-->
                                <script type="text/javascript">
                                    $("#quick_contact_form_sidebar").validate({
                                        submitHandler: function(form) {
                                            var form_btn = $(form).find('button[type="submit"]');
                                            var form_result_div = '#form-result';
                                            $(form_result_div).remove();
                                            form_btn.before(
                                                '<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>'
                                            );
                                            var form_btn_old_msg = form_btn.html();
                                            form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                                            $(form).ajaxSubmit({
                                                dataType: 'json',
                                                success: function(data) {
                                                    if (data.status == 'true') {
                                                        $(form).find('.form-control').val('');
                                                    }
                                                    form_btn.prop('disabled', false).html(form_btn_old_msg);
                                                    $(form_result_div).html(data.message).fadeIn('slow');
                                                    setTimeout(function() {
                                                        $(form_result_div).fadeOut('slow')
                                                    }, 6000);
                                                }
                                            });
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/website/pages/course/course-detail.blade.php ENDPATH**/ ?>