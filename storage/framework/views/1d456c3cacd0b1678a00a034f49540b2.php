
<?php $__env->startSection('content'); ?>
    <div class="main-content">

        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?php echo e(asset('assets/website/images/bg/bg3.jpg')); ?>">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Contact</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                
                                <li class="active text-gray-silver">Contact</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Divider: Contact -->
        <section class="divider">
            <div class="container">
                <div class="row pt-30">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="icon-box left media bg-deep p-30 mb-20"> <a class="media-left pull-left"
                                        href="#"> <i class="pe-7s-map-2 text-theme-colored"></i></a>
                                    <div class="media-body"> <strong>OUR OFFICE LOCATION</strong>
                                        <p>Main Bakar Mandi Road Liaquatabad, Near UBL Bank, Faisalabad</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-12">
                                <div class="icon-box left media bg-deep p-30 mb-20"> <a class="media-left pull-left"
                                        href="#"> <i class="pe-7s-call text-theme-colored"></i></a>
                                    <div class="media-body"> <strong>OUR CONTACT NUMBER</strong>
                                        <p>+(92) 340 394 6000</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-12">
                                <div class="icon-box left media bg-deep p-30 mb-20"> <a class="media-left pull-left"
                                        href="#"> <i class="pe-7s-mail text-theme-colored"></i></a>
                                    <div class="media-body"> <strong>OUR CONTACT E-MAIL</strong>
                                        <p><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="691a1c1919061b1d0c2910061c1b0d06040007470a0604">[info@skillverse.com.pk]</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h3 class="line-bottom mt-0 mb-20">Interested in discussing?</h3>
                        <p class="mb-20">
                            We'd love to hear from you! Whether you have questions about our courses, need help with
                            enrollment, or just want to explore how we can support your learning journey — feel free to
                            reach out. Our team is here to assist you every step of the way.
                        </p>
                        <!-- Contact Form -->
                        <form name="contact_form" class=""
                            action="<?php echo e(route('user.message.store')); ?>" method="post">
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input name="name" class="form-control" type="text" placeholder="Enter Name"
                                            required="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input name="email" class="form-control required email" type="email"
                                            placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input name="address" class="form-control required" type="text"
                                            placeholder="Enter Address">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input name="phone" class="form-control" type="text"
                                            placeholder="Enter Phone">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea name="message" class="form-control required" rows="5" placeholder="Enter Message"></textarea>
                            </div>
                            <div class="form-group">
                                <input name="form_botcheck" class="form-control" type="hidden" value="" />
                                <button type="submit"
                                    class="btn btn-flat btn-theme-colored text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px">
                                    Send your message
                                </button>

                                <button type="reset"
                                    class="btn btn-flat btn-theme-colored text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px">Reset</button>
                            </div>
                        </form>

                        <!-- Contact Form Validation-->
                        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                        <script type="text/javascript">
                            $("#contact_form").validate({
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
        </section>

        <!-- Divider: Google Map -->
        <section>
            <div class="container-fluid p-0">
                <div class="row">

                    <!-- Google Map HTML Codes -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d212.80850872480164!2d73.05542456805343!3d31.415885500000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x392242c25c33d4a7%3A0x924bca62d7ecd8a9!2sC384%2B975%2C%20Bakar%20Mandi%20Rd%2C%20Liaquatabad%2C%20Faisalabad%2C%20Pakistan!5e0!3m2!1sen!2s!4v1753481185590!5m2!1sen!2s"
                     width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                   
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('additional-javascript'); ?>
    <script>
        const form = document.getElementById('contact_form');
        const btn = document.getElementById('submit-btn');

        form.addEventListener('submit', function() {
            btn.disabled = true;
            btn.innerText = 'Please wait...';
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/website/pages/contact.blade.php ENDPATH**/ ?>