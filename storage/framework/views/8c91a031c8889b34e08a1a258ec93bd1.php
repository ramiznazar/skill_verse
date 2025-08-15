
<?php $__env->startSection('content'); ?>
    <div class="main-content">

        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
            data-bg-img="<?php echo e(asset('assets/website/images/institute/12.jpg')); ?>">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Blog</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                
                                <li class="active text-gray-silver">Blogs</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container mt-30 mb-30 pt-30 pb-30">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="blog-posts">
                            <div class="col-md-12">
                                <div class="row list-dashed">

                                    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <article class="post clearfix mb-30 pb-30">
                                            <?php if($blog->image): ?>
                                                <div class="entry-header">
                                                    <div class="post-thumb thumb">
                                                        <img src="<?php echo e(asset($blog->image)); ?>" alt="<?php echo e($blog->title); ?>"
                                                            class="img-responsive img-fullwidth"
                                                            style="height: 400px !important;">
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <div class="entry-content border-1px p-20 pr-10">
                                                <div class="entry-meta media mt-0 no-bg no-border">
                                                    <div
                                                        class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                                        <?php
                                                            $date = \Carbon\Carbon::parse($blog->date);
                                                        ?>
                                                        <ul>
                                                            <li class="font-16 text-white font-weight-600">
                                                                <?php echo e($date->format('d')); ?>

                                                            </li>
                                                            <li class="font-12 text-white text-uppercase">
                                                                <?php echo e($date->format('M')); ?>

                                                            </li>
                                                        </ul>

                                                    </div>
                                                    <div class="media-body pl-15">
                                                        <div class="event-content pull-left flip">
                                                            <h4 class="entry-title text-white text-uppercase m-0 mt-5">
                                                                <a
                                                                    href="#"><?php echo e($blog->title); ?></a>
                                                            </h4>

                                                            <span class="mb-10 text-gray-darkgray mr-10 font-13">
                                                                <i
                                                                    class="fa fa-thumbs-up mr-5 text-theme-colored"></i><?php echo e($blog->best_for); ?>

                                                            </span>

                                                            <?php if($blog->duration): ?>
                                                                <span class="mb-10 text-gray-darkgray mr-10 font-13">
                                                                    <i
                                                                        class="fa fa-clock mr-5 text-theme-colored"></i><?php echo e($blog->duration); ?>

                                                                </span>
                                                            <?php endif; ?>

                                                            <span class="mb-10 text-gray-darkgray mr-10 font-13">
                                                                <i
                                                                    class="fa fa-certificate mr-5 text-theme-colored"></i>Certified
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <p class="mt-10">
                                                    <?php echo e($blog->description); ?>

                                                </p>

                                                

                                                <div class="clearfix"></div>
                                            </div>
                                        </article>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="col-md-12 text-left">
                                    <?php echo e($blogs->links('pagination::bootstrap-4')); ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/website/pages/blog/blog.blade.php ENDPATH**/ ?>