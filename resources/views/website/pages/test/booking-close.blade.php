@extends('website.layouts.main')

@section('content')
    <main id="main">

        <!-- heading banner -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
            data-bg-img="{{ asset('assets/website/images/bg/bg3.jpg') }}">
            <div class="container pt-70 pb-20">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Interview Booking Closed</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li class="active text-gray-silver">Interview Booking Closed</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- booking closed message -->
        <section class="container text-center py-80">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 mt-50">

                    <!-- Icon Circle -->
                    <div
                        style="
                    width:130px;
                    height:130px;
                    background:#f1f1f1;
                    border-radius:50%;
                    margin:0 auto 25px;
                    display:flex;
                    justify-content:center;
                    align-items:center;
                    ">
                        <i class="fa fa-calendar-times-o" style="font-size:60px; color:#d9534f;"></i>
                    </div>

                    <h2 class="font-weight-600 mb-20">
                        Bookings Are Currently Closed
                    </h2>

                    <p class="mb-30" style="font-size:17px; line-height:28px;">
                        Our admission team is currently reviewing the test schedule.
                        <br>
                        New interview slots will be available soon.
                        <br>
                        Please check back shortly or contact our support team for guidance.
                    </p>

                    <!-- CTA Buttons -->
                    {{-- <a href="" class="btn btn-theme-colored btn-lg mr-10">
                        View Trending Courses
                    </a> --}}

                    <a href="https://wa.me/923403946000" target="_blank" class="btn btn-dark btn-lg">
                        Contact Support
                    </a>

                    <div class="mt-40">
                        <small class="text-muted">
                            Need assistance? Call us at <b>0340-3946000</b>
                        </small>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
