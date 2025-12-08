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

        @if ($courses->count())
            <section class="bg-lighter">
                <div class="container pt-30 pb-10">
                    <div class="row">
                        <div class="col-md-12 text-center mb-20">
                            {{-- <h4 class="text-uppercase font-24">
                                Trending Courses with <span class="text-theme-colored">Interview Discounts</span>
                            </h4> --}}
                            <p class="text-muted">
                                Book your interview today and lock these special limited-time fees.
                            </p>

                            <p class="text-muted mt-5" style="font-size:14px;">
                                <span style="color:#ff5722; font-weight:600;">Sponsored by HMS Tech Solutions</span> —
                                Empowering Digital Skills & IT Education.
                            </p>
                        </div>

                    </div>

                    <div class="row">
                        @foreach ($courses as $course)
                            @php
                                $discAmount = $course->full_fee - $course->interview_discount_amount;
                            @endphp

                            <div class="col-sm-6 col-md-4">
                                <div class="border-1px bg-white mb-20 p-15 course-discount-card"
                                    style="border-radius:6px; box-shadow:0 5px 15px rgba(0,0,0,0.05);">
                                    <h4 class="mt-0 mb-5">{{ $course->title }}</h4>

                                    <p class="mb-5 text-muted">
                                        <small>Standard Fee</small><br>
                                        <span style="text-decoration:line-through; color:#999;">
                                            Rs {{ number_format($course->full_fee) }}
                                        </span>
                                    </p>

                                    <p class="mb-5">
                                        <small>Interview Discount</small><br>

                                        <span class="badge" style="background:#ff9800; color:#fff;">
                                            {{ number_format($course->interview_discount_per) }}%
                                            OFF
                                        </span>

                                        <span class="text-theme-colored ml-5">
                                            – Rs {{ number_format($discAmount) }}
                                        </span>
                                    </p>

                                    <p class="mb-0">
                                        <small class="text-muted">Final Fee After Discount</small><br>
                                        <span class="font-20 text-theme-colored font-weight-700">
                                            Rs {{ number_format($course->interview_discount_amount) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Section: Booking Form -->
        <section class="divider">
            <div class="container">
                <div class="row pt-30">
                    <div class="col-md-12">

                        <h3 class="line-bottom mt-0 mb-20">Register for Interview & Unlock Your Discount</h3>
                        <p class="mb-20">
                            Fill out the form below to receive your interview date and time. Limited slots are available
                            each day, and if today is fully booked, you’ll be automatically scheduled for the next available
                            day.
                        </p>

                        {{-- Show Error Messages (Professional Alert) --}}
                        @if ($errors->any())
                            <div class="alert alert-danger"
                                style="border-radius:6px; padding:15px 20px; font-size:15px; 
                background:#ffe5e5; border-left:5px solid #d9534f; color:#a94442;">
                                <strong style="font-size:16px;">⚠️ Please Note:</strong><br>

                                @foreach ($errors->all() as $error)
                                    <span style="display:block; margin-top:5px;">{{ $error }}</span>
                                @endforeach
                            </div>
                        @endif

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
                                                <option value="{{ $course->id }}">
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Interview Date</label>
                                        <select id="test_date" class="form-control" required>
                                            <option value="">Select a date</option>

                                            @foreach ($days as $day)
                                                <option value="{{ $day->id }}">
                                                    {{ \Carbon\Carbon::parse($day->test_date)->format('d M Y') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12" id="slot_container" style="display: none;">
                                    <div class="form-group">
                                        <label>Select Time Slot</label>
                                        <select name="slot" id="slot" class="form-control" required>
                                            <option value="">Select a date first</option>
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
@section('additional-javascript')
    <script>
        // Cache to store pre-fetched slots
        let slotsCache = {};
        let isLoadingSlots = false;

        // Pre-fetch all slots when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const dayIds = [
                @foreach ($days as $day)
                    {{ $day->id }}{{ !$loop->last ? ',' : '' }}
                @endforeach
            ];

            // Fetch slots for all days in parallel
            if (dayIds.length > 0) {
                isLoadingSlots = true;
                const fetchPromises = dayIds.map(dayId => 
                    fetch("{{ url('/test/get-slots') }}/" + dayId)
                        .then(response => response.json())
                        .then(res => {
                            slotsCache[dayId] = res.slots;
                        })
                        .catch(error => {
                            console.error('Error fetching slots for day ' + dayId + ':', error);
                            slotsCache[dayId] = [];
                        })
                );

                Promise.all(fetchPromises).then(() => {
                    isLoadingSlots = false;
                });
            }
        });

        // Handle date selection change
        document.getElementById('test_date').addEventListener('change', function() {
            let dayId = this.value;
            let slotDropdown = document.getElementById('slot');
            let slotContainer = document.getElementById('slot_container');

            // Always hide first
            slotContainer.style.display = "none";
            slotDropdown.innerHTML = '<option>Loading...</option>';

            if (!dayId) {
                slotDropdown.innerHTML = '<option>Select a date first</option>';
                return;
            }

            // Check if slots are cached
            if (slotsCache[dayId] !== undefined) {
                // Use cached slots immediately
                displaySlots(dayId, slotsCache[dayId], slotDropdown, slotContainer);
            } else if (isLoadingSlots) {
                // If still loading, wait a bit and check again
                setTimeout(function() {
                    if (slotsCache[dayId] !== undefined) {
                        displaySlots(dayId, slotsCache[dayId], slotDropdown, slotContainer);
                    } else {
                        // Fallback: fetch if not in cache
                        fetchSlots(dayId, slotDropdown, slotContainer);
                    }
                }, 100);
            } else {
                // Fallback: fetch if not in cache
                fetchSlots(dayId, slotDropdown, slotContainer);
            }
        });

        // Function to display slots
        function displaySlots(dayId, slots, slotDropdown, slotContainer) {
            slotContainer.style.display = "block";
            slotDropdown.innerHTML = '';

            if (slots.length === 0) {
                slotDropdown.innerHTML = '<option value="">No slots available</option>';
                return;
            }

            slotDropdown.innerHTML = `<option value="">Select Time Slot</option>`;

            slots.forEach(slot => {
                slotDropdown.innerHTML += `
                    <option value="${dayId}|${slot.time}">
                        ${slot.time} (${slot.available} seats left)
                    </option>
                `;
            });
        }

        // Fallback function to fetch slots if not cached
        function fetchSlots(dayId, slotDropdown, slotContainer) {
            fetch("{{ url('/test/get-slots') }}/" + dayId)
                .then(response => response.json())
                .then(res => {
                    // Cache the result
                    slotsCache[dayId] = res.slots;
                    displaySlots(dayId, res.slots, slotDropdown, slotContainer);
                })
                .catch(error => {
                    console.error('Error fetching slots:', error);
                    slotContainer.style.display = "block";
                    slotDropdown.innerHTML = '<option value="">Error loading slots</option>';
                });
        }
    </script>
@endsection
