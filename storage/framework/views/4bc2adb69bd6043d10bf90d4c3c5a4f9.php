

<?php $__env->startSection('content'); ?>
    <div class="main-content">

        <!-- Header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
            data-bg-img="<?php echo e(asset('assets/website/images/bg/bg3.jpg')); ?>">
            <div class="container pt-70 pb-20">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Test Booking Summary</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                <li class="active text-gray-silver">Test Summary</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Summary + FAQ Section -->
        <section class="divider">
            <div class="container pb-40 pt-30">
                <div class="row">

                    <!-- LEFT SIDE: TEST DETAILS -->
                    <div class="col-md-6">
                        <div class="bg-light p-30 mb-30" style="border-left:5px solid #ff6000; border-radius:6px;">
                            <h3 class="mt-0 line-bottom">
                                <i class="fa fa-check-circle text-theme-color-2 mr-10"></i>
                                Your Interview Has Been Booked
                            </h3>

                            <p class="font-16 mt-10">
                                Hello <strong><?php echo e($name); ?></strong>,<br>
                                Your interview appointment has been successfully scheduled.
                            </p>

                            <div class="table-responsive mt-20">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-theme-color-2" width="40%">
                                            <i class="fa fa-calendar mr-5"></i> Interview Date
                                        </th>
                                        <td><?php echo e(\Carbon\Carbon::parse($booking->testDay->test_date)->format('d M Y')); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-theme-color-2">
                                            <i class="fa fa-clock-o mr-5"></i> Interview Time
                                        </th>
                                        <td><?php echo e(\Carbon\Carbon::parse($booking->slot_time)->format('h:i A')); ?></td>
                                        
                                    </tr>
                                </table>
                            </div>

                            <!-- Countdown Section -->
                            <h4 class="text-theme-color-2 mt-30 mb-10">
                                <i class="fa fa-hourglass-half mr-5"></i>
                                Time Remaining
                            </h4>

                            <div id="countdown" style="font-size:26px; font-weight:700;  margin-top:10px;"></div>

                        </div>
                    </div>

                    <!-- RIGHT SIDE: STUDENT FAQS -->
                    <div class="col-md-6">
                        <h3 class="line-bottom mb-20 mt-0">Student <span class="text-theme-color-2">FAQs</span></h3>

                        <div id="accordionFAQ" class="panel-group accordion">

                            <div class="panel">
                                <div class="panel-title">
                                    <a class="active" data-parent="#accordionFAQ" data-toggle="collapse" href="#faq1">
                                        <span class="open-sub"></span> What will be asked in the interview?
                                    </a>
                                </div>
                                <div id="faq1" class="panel-collapse collapse in">
                                    <div class="panel-content">
                                        <p>
                                            The interview is simple. We check your goals, interest in the field, your
                                            current skill level,
                                            and why you want to join the course. There are no technical or difficult
                                            questions.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-title">
                                    <a data-parent="#accordionFAQ" data-toggle="collapse" href="#faq2">
                                        <span class="open-sub"></span> What is the purpose of the interview?
                                    </a>
                                </div>
                                <div id="faq2" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>
                                            The interview helps us understand your interest and ensure you select the right
                                            course. It also
                                            helps us guide you properly according to your future goals.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-title">
                                    <a data-parent="#accordionFAQ" data-toggle="collapse" href="#faq3">
                                        <span class="open-sub"></span> What should I bring for the interview?
                                    </a>
                                </div>
                                <div id="faq3" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>
                                             No documents or notes are required.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-title">
                                    <a data-parent="#accordionFAQ" data-toggle="collapse" href="#faq4">
                                        <span class="open-sub"></span> What if I miss my interview?
                                    </a>
                                </div>
                                <div id="faq4" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>
                                            If you miss your interview, you can easily reschedule it. Just fill the form
                                            again or contact our support team to set a new date.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Countdown Script -->
    <script>
        var testDateTime = new Date("<?php echo e($date); ?> <?php echo e($time); ?>").getTime();

        var timer = setInterval(function() {

            var now = new Date().getTime();
            var remaining = testDateTime - now;

            if (remaining <= 0) {
                clearInterval(timer);
                document.getElementById("countdown").innerHTML = "Your test time has arrived!";
                return;
            }

            var days = Math.floor(remaining / (1000 * 60 * 60 * 24));
            var hours = Math.floor((remaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((remaining % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML =
                days + "d : " + hours + "h : " + minutes + "m : " + seconds + "s ";

        }, 1000);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/website/pages/test/summary.blade.php ENDPATH**/ ?>