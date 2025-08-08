<!-- Footer -->
<footer id="footer" class="footer divider layer-overlay overlay-dark-9" data-bg-img="images/bg/bg2.jpg">
    <div class="container">
        <div class="row border-bottom">
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <img class="mt-5 mb-20" alt="" src="<?php echo e(asset('assets/website/images/logo/black-logo.png')); ?>"
                        width="230">
                    <p>Main Bakar Mandi Road Liaquatabad, Near UBL Bank, Faisalabad.</p>
                    <ul class="list-inline mt-5">
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-color-2 mr-5"></i> <a
                                class="text-gray" href="#">+(92) 340 394 6000</a> </li>
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-color-2 mr-5"></i> <a
                                class="text-gray" href="#"><span class="__cf_email__"
                                    data-cfemail="a5c6cacbd1c4c6d1e5dccad0d7c1cac8c4cccb8bc6cac8">[info@skillverse.com.pk]</span></a>
                        </li>
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-theme-color-2 mr-5"></i> <a
                                class="text-gray" href="#">www.skillverse.com.pk</a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h4 class="widget-title">Useful Links</h4>
                    <ul class="list angle-double-right list-border">
                        <li><a href="<?php echo e(route('about')); ?>">About Us</a></li>
                        <li><a href="<?php echo e(route('course')); ?>">Our Courses</a></li>
                        <li><a href="<?php echo e(route('event')); ?>">Events</a></li>
                        <li><a href="<?php echo e(route('blog')); ?>">Blog</a></li>
                        <li><a href="<?php echo e(route('contact')); ?>">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h4 class="widget-title">Tags</h4>
                    <div class="tags">
                        <a href="#about">about</a>
                        <a href="#course">courses</a>
                        <a href="#choose">choose us</a>
                        <a href="#counter">courte</a>
                        <a href="#gallary">gallary</a>
                        <a href="#client">happy students</a>
                        <a href="#blog">latest blog</a>
                        <a href="#">success</a>
                        <a href="#">campus</a>
                        <a href="#">university</a>
                        <a href="#">system</a>
                        <a href="#">support</a>
                        <a href="#">features</a>
                        <a href="#">evidence</a>
                        <a href="#">teaching</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h4 class="widget-title line-bottom-theme-colored-2">Opening Hours</h4>
                    <div class="opening-hours">
                        <ul class="list-border">
                            <li class="clearfix"> <span> Mon - Thurs : </span>
                                <div class="value pull-right"> 10.00 am - 7.00 pm </div>
                            </li>
                            <li class="clearfix"> <span> Fri : </span>
                                <div class="value pull-right"> 2.00 pm - 8.00 pm </div>
                            </li>
                            <li class="clearfix"> <span> Sat - Sun : </span>
                                <div class="value pull-right"> Closed </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-30">
            
            <div class="col-md-5">
                <div class="widget dark">
                    <h5 class="widget-title mb-10">Connect With Us</h5>
                    <ul class="styled-icons icon-bordered icon-sm">
                        <li><a href="https://www.facebook.com/profile.php?id=61568151690543"><i class="fab fa-facebook text-white"></i></a></li>
                        <li><a href="https://www.youtube.com/" target="_blank"><i
                                    class="fab fa-youtube text-white"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram text-white"></i></a></li>
                        <li><a href="https://www.tiktok.com/@skill.verse"><i class="fab fa-tiktok text-white"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin text-white"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-2">
                <div class="widget dark">
                    <h5 class="widget-title mb-10">Subscribe Us</h5>
                    <!-- Mailchimp Subscription Form Starts Here -->
                    <form id="mailchimp-subscription-form-footer" class="newsletter-form">
                        <div class="input-group">
                            <input type="email" value="" name="EMAIL" placeholder="Your Email"
                                class="form-control input-lg font-16" data-height="45px" id="mce-EMAIL-footer">
                            <span class="input-group-btn">
                                <button data-height="45px" class="btn bg-theme-color-2 text-white btn-xs m-0 font-14"
                                    type="submit">Subscribe</button>
                            </span>
                        </div>
                    </form>
                    <!-- Mailchimp Subscription Form Validation-->
                    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                    <script type="text/javascript">
                        $('#mailchimp-subscription-form-footer').ajaxChimp({
                            callback: mailChimpCallBack,
                            url: '//thememascot.us9.list-manage.com/subscribe/post?u=a01f440178e35febc8cf4e51f&amp;id=49d6d30e1e'
                        });

                        function mailChimpCallBack(resp) {
                            // Hide any previous response text
                            var $mailchimpform = $('#mailchimp-subscription-form-footer'),
                                $response = '';
                            $mailchimpform.children(".alert").remove();
                            if (resp.result === 'success') {
                                $response =
                                    '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    resp.msg + '</div>';
                            } else if (resp.result === 'error') {
                                $response =
                                    '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    resp.msg + '</div>';
                            }
                            $mailchimpform.prepend($response);
                        }
                    </script>
                    <!-- Mailchimp Subscription Form Ends Here -->
                </div>
            </div>
        </div>
    </div>
    
</footer>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end wrapper -->
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/website/layouts/footer.blade.php ENDPATH**/ ?>