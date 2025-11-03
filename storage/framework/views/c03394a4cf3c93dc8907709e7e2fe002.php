
<?php $__env->startSection('content'); ?>
    <div class="main-content bg-lighter">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
            data-bg-img="<?php echo e(asset('assets/website/images/institute/15.jpg')); ?>">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Courses</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                
                                <li class="active text-gray-silver">Courses</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Course gird -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-9 blog-pull-right">
                        <div class="row">

                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-6 col-md-4 course-card"
                                    data-category-id="<?php echo e($course->course_category_id); ?>">
                                    <div class="service-block bg-white">
                                        <div class="thumb">
                                            <img alt="featured project" src="<?php echo e($course->image); ?>"
                                                style="width:100%; height:190px; object-fit:cover;">
                                        </div>
                                        <div class="content text-left flip p-25 pt-0">
                                            <h4 class="line-bottom mb-10"><?php echo e($course->title); ?></h4>
                                            <p><?php echo e(\Illuminate\Support\Str::words($course->short_description, 20, '...')); ?>

                                            </p>
                                            <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10"
                                                href="<?php echo e(route('course.detail', $course->slug)); ?>">view details</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="sidebar sidebar-left mt-sm-30">
                            <div class="widget">
                                <h5 class="widget-title line-bottom">Search <span class="text-theme-color-2">Courses</span>
                                </h5>
                                <div class="search-form">
                                    
                                    <form method="GET" action="<?php echo e(route('course')); ?>">
                                        <?php if(!empty($categoryId)): ?>
                                            <input type="hidden" name="category" value="<?php echo e($categoryId); ?>">
                                        <?php endif; ?>
                                        <div class="input-group">
                                            <input type="text" id="course-search" name="q"
                                                value="<?php echo e($q ?? ''); ?>" placeholder="Click to Search"
                                                class="form-control search-input">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn search-button"><i
                                                        class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="widget">
                                <h5 class="widget-title line-bottom">Course <span
                                        class="text-theme-color-2">Categories</span></h5>
                                <div class="categories">
                                    <ul class="list list-border angle-double-right">
                                        
                                        <li>
                                            <a href="<?php echo e(route('course', array_filter(['q' => $q ?? null]))); ?>"
                                                class="<?php echo e(empty($categoryId) ? 'active-category' : ''); ?>">
                                                All
                                                <span>(<?php echo e($categories->sum('course_count')); ?>)</span>
                                            </a>
                                        </li>

                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                
                                                <a href="<?php echo e(route('course', array_filter(['category' => $category->id, 'q' => $q ?? null]))); ?>"
                                                    class="<?php echo e(isset($categoryId) && (int) $categoryId === (int) $category->id ? 'active-category' : ''); ?>">
                                                    <?php echo e($category->name); ?>

                                                    <span>(<?php echo e($category->course_count); ?>)</span>
                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>

                                </div>
                            </div>
                            <div class="widget">
                                <h5 class="widget-title line-bottom">Popular<span class="text-theme-color-2">Courses</span>
                                </h5>
                                
                                <div class="latest-posts">

                                    

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-md-12 text-left">
                            
                            <?php echo e($courses->links('pagination::bootstrap-4')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-javascript'); ?>
    
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('course-search');
            const courseCards = document.querySelectorAll('.course-card');

            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();

                courseCards.forEach(card => {
                    const title = card.querySelector('h4').textContent.toLowerCase();
                    const description = card.querySelector('p').textContent.toLowerCase();

                    const matches = title.includes(query) || description.includes(query);

                    card.style.display = matches ? 'block' : 'none';
                });
            });
        });
    </script>

    <style>
        .active-category {
            font-weight: bold;
            color: #007bff;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/website/pages/course/course.blade.php ENDPATH**/ ?>