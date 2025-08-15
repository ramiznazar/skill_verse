
<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
            data-bg-img="<?php echo e(asset('assets/website/images/institute/26.jpg')); ?>">
            <div class="container pt-60 pb-60">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3 class="font-28 text-white">Event Details</h2>
                                <ol class="breadcrumb text-center text-black mt-10">
                                    <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                    <li><a href="<?php echo e(route('event')); ?>">Events</a></li>
                                    <li class="active text-theme-colored">Event Details</li>
                                </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-theme-colored">
            <div class="container pt-40 pb-40">
                <div class="row text-center">
                    <div class="col-md-12">
                        <h2 id="basic-coupon-clock" class="text-white"></h2>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <ul>
                            <li>
                                <h5>Topics:</h5>
                                <p><?php echo e($event->topics); ?></p>
                            </li>
                            <li>
                                <h5>Speakers:</h5>
                                <p><?php echo e($event->speakers); ?></p>
                            </li>
                            <li>
                                <h5>Audience:</h5>
                                <p><?php echo e($event->audience); ?></p>
                            </li>
                            <li>
                                <h5>Location:</h5>
                                <p><?php echo e($event->address); ?></p>
                            </li>
                            <li>
                                <h5>Starting Time:</h5>
                                <p><?php echo e($event->start_time); ?></p>
                            </li>
                            <li>
                                <h5>Ending Time:</h5>
                                <p><?php echo e($event->end_time); ?></p>
                            </li>
                            <li>
                                <h5>Share:</h5>
                                <div class="styled-icons icon-sm icon-gray icon-circled">
                                    <?php
                                        function getEventSocialLink($links, $platform)
                                        {
                                            foreach ($links as $link) {
                                                if (strtolower($link->title) === strtolower($platform)) {
                                                    return $link->link;
                                                }
                                            }
                                            return '#';
                                        }
                                    ?>

                                    <a href="<?php echo e(getEventSocialLink($socialLinks, 'facebook')); ?>" target="_blank"><i
                                            class="fa fa-facebook"></i></a>
                                    <a href="<?php echo e(getEventSocialLink($socialLinks, 'youtube')); ?>" target="_blank"><i
                                            class="fab fa-youtube"></i></a>
                                    <a href="<?php echo e(getEventSocialLink($socialLinks, 'tiktok')); ?>" target="_blank"><i
                                            class="fab fa-tiktok"></i></a>
                                    <a href="<?php echo e(getEventSocialLink($socialLinks, 'linkedin')); ?>" target="_blank"><i
                                            class="fab fa-linkedin"></i></a>
                                    <a href="<?php echo e(getEventSocialLink($socialLinks, 'instagram')); ?>" target="_blank"><i
                                            class="fab fa-instagram"></i></a>

                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <div class="owl-carousel-1col" data-nav="true">
                            
                            <?php if($event->image): ?>
                                <div class="item">
                                    <img src="<?php echo e(asset($event->image)); ?>" alt="Main Event Image" class="img-responsive"
                                        style="width: 100%; height: auto;" />
                                </div>
                            <?php endif; ?>

                            
                            <?php if($event->additional_images): ?>
                                <?php $__currentLoopData = json_decode($event->additional_images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item">
                                        <img src="<?php echo e(asset('assets/admin/images/code/event/' . $img)); ?>"
                                            alt="Additional Event Image" class="img-responsive"
                                            style="width: 100%; height: auto;" />
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>


                </div>
                <div class="row mt-60">
                    <div class="col-md-6">
                        <h4 class="mt-0">Event Description</h4>
                        <p><?php echo e($event->description); ?></p>
                    </div>
                    <div class="col-md-6">
                        <blockquote>
                            <p>"<?php echo e($event->quote); ?>"</p>
                            <footer> <?php echo e($event->quote_by); ?><cite title="Source Title"> Skillverse</cite></footer>
                        </blockquote>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col-md-12">
                        <h4 class="mb-20">Honored Guests</h4>
                        <div class="owl-carousel-6col" data-nav="true">

                            <?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item">
                                    <div class="attorney">
                                        <div class="thumb"><img src="images/team/1.jpg" alt=""></div>
                                        <div class="content text-center">
                                            <h5 class="author mb-0"><a class="text-theme-colored"
                                                    href="#"><?php echo e($participant->name); ?></a></h5>
                                            <h6 class="title text-gray font-12 mt-0 mb-0"><?php echo e($participant->post); ?></h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Registration Form -->
        
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('additional-javascript'); ?>
    <!-- Final Countdown Timer Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.43/moment-timezone-with-data.min.js"></script>

    <?php
        $eventDate = $event->date; // e.g., "2025-07-24"
        $eventTime = \Carbon\Carbon::createFromFormat('g:i A', $event->start_time)->format('H:i:s'); // "03:00:00"
        $datetimeString = $eventDate . ' ' . $eventTime; // "2025-07-24 03:00:00"
    ?>

    <script>
        $(document).ready(function() {
            const eventDateTime = moment.tz("<?php echo e($datetimeString); ?>", "YYYY-MM-DD HH:mm:ss", "Asia/Karachi");

            $('#basic-coupon-clock').countdown(eventDateTime.toDate(), function(event) {
                $(this).html(event.strftime('%D days %H:%M:%S'));
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/website/pages/event/event-detail.blade.php ENDPATH**/ ?>