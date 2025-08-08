@extends('website.layouts.main')
@section('content')
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
            data-bg-img="{{ asset('assets/website/images/institute/26.jpg') }}">
            <div class="container pt-60 pb-60">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3 class="font-28 text-white">Event Details</h2>
                                <ol class="breadcrumb text-center text-black mt-10">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('event') }}">Events</a></li>
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
                                <p>{{ $event->topics }}</p>
                            </li>
                            <li>
                                <h5>Speakers:</h5>
                                <p>{{ $event->speakers }}</p>
                            </li>
                            <li>
                                <h5>Audience:</h5>
                                <p>{{ $event->audience }}</p>
                            </li>
                            <li>
                                <h5>Location:</h5>
                                <p>{{ $event->address }}</p>
                            </li>
                            <li>
                                <h5>Starting Time:</h5>
                                <p>{{ $event->start_time }}</p>
                            </li>
                            <li>
                                <h5>Ending Time:</h5>
                                <p>{{ $event->end_time }}</p>
                            </li>
                            <li>
                                <h5>Share:</h5>
                                <div class="styled-icons icon-sm icon-gray icon-circled">
                                    @php
                                        function getEventSocialLink($links, $platform)
                                        {
                                            foreach ($links as $link) {
                                                if (strtolower($link->title) === strtolower($platform)) {
                                                    return $link->link;
                                                }
                                            }
                                            return '#';
                                        }
                                    @endphp

                                    <a href="{{ getEventSocialLink($socialLinks, 'facebook') }}" target="_blank"><i
                                            class="fa fa-facebook"></i></a>
                                    <a href="{{ getEventSocialLink($socialLinks, 'youtube') }}" target="_blank"><i
                                            class="fab fa-youtube"></i></a>
                                    <a href="{{ getEventSocialLink($socialLinks, 'tiktok') }}" target="_blank"><i
                                            class="fab fa-tiktok"></i></a>
                                    <a href="{{ getEventSocialLink($socialLinks, 'linkedin') }}" target="_blank"><i
                                            class="fab fa-linkedin"></i></a>
                                    <a href="{{ getEventSocialLink($socialLinks, 'instagram') }}" target="_blank"><i
                                            class="fab fa-instagram"></i></a>

                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <div class="owl-carousel-1col" data-nav="true">
                            {{-- Main Image --}}
                            @if ($event->image)
                                <div class="item">
                                    <img src="{{ asset($event->image) }}" alt="Main Event Image" class="img-responsive"
                                        style="width: 100%; height: auto;" />
                                </div>
                            @endif

                            {{-- Additional Images --}}
                            @if ($event->additional_images)
                                @foreach (json_decode($event->additional_images) as $img)
                                    <div class="item">
                                        <img src="{{ asset('assets/admin/images/code/event/' . $img) }}"
                                            alt="Additional Event Image" class="img-responsive"
                                            style="width: 100%; height: auto;" />
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>


                </div>
                <div class="row mt-60">
                    <div class="col-md-6">
                        <h4 class="mt-0">Event Description</h4>
                        <p>{{ $event->description }}</p>
                    </div>
                    <div class="col-md-6">
                        <blockquote>
                            <p>"{{ $event->quote }}"</p>
                            <footer> {{ $event->quote_by }}<cite title="Source Title"> Skillverse</cite></footer>
                        </blockquote>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col-md-12">
                        <h4 class="mb-20">Honored Guests</h4>
                        <div class="owl-carousel-6col" data-nav="true">

                            @foreach ($participants as $participant)
                                <div class="item">
                                    <div class="attorney">
                                        <div class="thumb"><img src="images/team/1.jpg" alt=""></div>
                                        <div class="content text-center">
                                            <h5 class="author mb-0"><a class="text-theme-colored"
                                                    href="#">{{ $participant->name }}</a></h5>
                                            <h6 class="title text-gray font-12 mt-0 mb-0">{{ $participant->post }}</h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Registration Form -->
        {{-- <section class="divider parallax layer-overlay overlay-white-8" data-bg-img="images/bg/bg1.jpg">
            <div class="container-fluid">
                <div class="section-title">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <h3 class="title text-theme-colored">Registration Form</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form id="booking-form" name="booking-form" action="includes/event-register.php" method="post"
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Name" name="register_name" required=""
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Email" name="register_email"
                                            class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Phone" name="register_phone"
                                            class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Ticket types</label>
                                        <select name="ticket_type" class="form-control">
                                            <option>One Person</option>
                                            <option>Two Person</option>
                                            <option>Family Pack</option>
                                            <option>Premium</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Event types</label>
                                        <select name="event_type" class="form-control">
                                            <option>Event 1</option>
                                            <option>Event 2</option>
                                            <option>Event 3</option>
                                            <option>All package</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group text-center">
                                        <input name="form_botcheck" class="form-control" type="hidden"
                                            value="" />
                                        <button data-loading-text="Please wait..."
                                            class="btn btn-dark btn-theme-colored btn-sm btn-block mt-20 pt-10 pb-10"
                                            type="submit">Register now</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Job Form Validation-->
                        <script type="text/javascript">
                            $("#booking-form").validate({
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

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mb-20">Photo Gallery</h4>
                        <div class="owl-carousel-5col" data-nav="true">
                            <div class="item"><img src="https://placehold.it/285x215" alt=""></div>
                            <div class="item"><img src="https://placehold.it/285x215" alt=""></div>
                            <div class="item"><img src="https://placehold.it/285x215" alt=""></div>
                            <div class="item"><img src="https://placehold.it/285x215" alt=""></div>
                            <div class="item"><img src="https://placehold.it/285x215" alt=""></div>
                            <div class="item"><img src="https://placehold.it/285x215" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    </div>
@endsection
@section('additional-javascript')
    <!-- Final Countdown Timer Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.43/moment-timezone-with-data.min.js"></script>

    @php
        $eventDate = $event->date; // e.g., "2025-07-24"
        $eventTime = \Carbon\Carbon::createFromFormat('g:i A', $event->start_time)->format('H:i:s'); // "03:00:00"
        $datetimeString = $eventDate . ' ' . $eventTime; // "2025-07-24 03:00:00"
    @endphp

    <script>
        $(document).ready(function() {
            const eventDateTime = moment.tz("{{ $datetimeString }}", "YYYY-MM-DD HH:mm:ss", "Asia/Karachi");

            $('#basic-coupon-clock').countdown(eventDateTime.toDate(), function(event) {
                $(this).html(event.strftime('%D days %H:%M:%S'));
            });
        });
    </script>
@endsection
