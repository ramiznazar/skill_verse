@extends('admin.layouts.main')

@section('content')
<div id="main-content">

    <div class="block-header">
        <h2 class="mb-0">Test Booking Details</h2>
        <small class="text-muted">Full student information & test status</small>
    </div>

    <div class="container-fluid">

        <div class="card">
            <div class="header bg-light">
                <h2 class="mb-0">
                    <i class="icon-user"></i> Student Information
                </h2>
            </div>

            <div class="body">

                <table class="table table-striped table-hover table-bordered">

                    <tr>
                        <th width="25%">Name</th>
                        <td>{{ $booking->name }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $booking->email }}</td>
                    </tr>

                    <tr>
                        <th>Phone</th>
                        <td>{{ $booking->phone }}</td>
                    </tr>

                    <tr>
                        <th>Course</th>
                        <td>
                            <span class="badge badge-info">
                                {{ $booking->course->title ?? 'N/A' }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Test Date</th>
                        <td>
                            {{ \Carbon\Carbon::parse($booking->test_date)->format('d M, Y') }}
                        </td>
                    </tr>

                    <tr>
                        <th>Test Time</th>
                        <td>
                            <i class="fa fa-clock-o"></i> {{ $booking->test_time ?? '10:00 AM' }}
                        </td>
                    </tr>

                    <tr>
                        <th>Booking Status</th>
                        <td>
                            <span class="badge 
                                @if($booking->status == 'pending') badge-warning
                                @elseif($booking->status == 'confirmed') badge-success
                                @else badge-secondary @endif
                            ">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Attendance</th>
                        <td>
                            <span class="badge 
                                @if($booking->attendance_status == 'attended') badge-success
                                @elseif($booking->attendance_status == 'absent') badge-danger
                                @else badge-secondary @endif
                            ">
                                {{ $booking->attendance_status ? ucfirst($booking->attendance_status) : 'Not Marked' }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Test Result</th>
                        <td>
                            <span class="badge 
                                @if($booking->result_status == 'pass') badge-success
                                @elseif($booking->result_status == 'fail') badge-danger
                                @else badge-secondary @endif
                            ">
                                {{ ucfirst($booking->result_status ?? 'pending') }}
                            </span>

                            @if($booking->score)
                                <span class="ml-2 text-muted">
                                    (Score: {{ $booking->score }}/100)
                                </span>
                            @endif
                        </td>
                    </tr>

                    @if($booking->discount_code)
                    <tr>
                        <th>Discount Code</th>
                        <td>
                            <span class="badge badge-primary">
                                {{ $booking->discount_code }}
                            </span>
                        </td>
                    </tr>
                    @endif

                    @if($booking->attempted_at)
                    <tr>
                        <th>Attempted At</th>
                        <td>{{ \Carbon\Carbon::parse($booking->attempted_at)->format('d M Y - h:i A') }}</td>
                    </tr>
                    @endif

                </table>

                <a href="{{ route('test.bookings.index') }}" class="btn btn-primary mt-3">
                    <i class="fa fa-arrow-left"></i> Back to Bookings
                </a>

            </div>
        </div>

    </div>

</div>
@endsection
