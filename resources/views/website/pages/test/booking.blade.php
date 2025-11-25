@extends('website.layouts.main')

@section('content')
    <div class="main-content">

        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
            data-bg-img="{{ asset('assets/website/images/bg/bg3.jpg') }}">
            <div class="container pt-70 pb-20">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Interview Booking</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li class="active text-gray-silver">Interview Booking</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Booking Form -->
        <section class="divider">
            <div class="container">
                <div class="row pt-30">
                    <div class="col-md-12">
                        {{-- <div class="col-md-8 col-md-offset-2"> --}}

                        <h3 class="line-bottom mt-0 mb-20">Register for 80% Discount Interview</h3>
                        <p class="mb-20">
                            Fill out the form below to receive your interview date and time. Limited slots are available
                            each day, and if today is fully booked, you’ll be automatically scheduled for the next available
                            day.
                        </p>

                        <form action="{{ route('test.booking.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Full Name" required>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter Email Address" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="Enter Phone Number" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="course_id" class="form-control" required>
                                            <option value="">Select Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Interview Slot</label>
                                        <select name="slot" class="form-control" required>
                                            <option value="">Select date & time</option>

                                            @forelse ($slots as $slot)
                                                <option value="{{ $slot['id'] }}|{{ $slot['time'] }}">
                                                    {{ \Carbon\Carbon::parse($slot['date'])->format('d M Y') }}
                                                    — {{ \Carbon\Carbon::parse($slot['time'])->format('h:i A') }}
                                                    ({{ $slot['available'] }} seats left)
                                                </option>
                                            @empty
                                                <option value="">No interview slots available</option>
                                            @endforelse
                                        </select>

                                        @error('slot')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <textarea name="purpose" class="form-control required" rows="5"
                                    placeholder="Tell us why you want to join (optional)"></textarea>
                            </div>

                            <button type="submit"
                                class="btn btn-theme-colored btn-flat text-uppercase 
                            border-left-theme-color-2-4px">
                                Book My Test
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
