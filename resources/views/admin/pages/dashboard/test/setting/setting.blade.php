@extends('admin.layouts.main')

@section('content')
<div id="main-content">

    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6">
                <h2>Interview Settings</h2>
            </div>
        </div>
    </div>

    @if(session('update'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('update') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">

                <div class="card">
                    <div class="header">
                        <h2>Update Interview Settings</h2>
                    </div>

                    <div class="body">

                        <form action="{{ route('test.settings.update') }}" method="POST">
                            @csrf

                            <div class="row">

                                <!-- Default per day -->
                                {{-- <div class="col-md-4">
                                    <label>Default Students Per Day</label>
                                    <input type="number" class="form-control"
                                           name="default_daily_limit"
                                           value="{{ $settings->default_daily_limit }}" required>
                                </div> --}}

                                <!-- Max days ahead -->
                                <div class="col-md-4">
                                    <label>Max Days Ahead Students Can Book</label>
                                    <input type="number" class="form-control"
                                           name="max_days_ahead"
                                           value="{{ $settings->max_days_ahead }}" required>
                                </div>

                                <!-- Booking Status -->
                                <div class="col-md-4">
                                    <label>Booking Status</label>
                                    <select name="is_booking_open" class="form-control">
                                        <option value="1" {{ $settings->is_booking_open ? 'selected' : '' }}>Open</option>
                                        <option value="0" {{ !$settings->is_booking_open ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </div>

                            </div>

                            <hr>

                            <h5><strong>Daily Interview Timing</strong></h5>

                            <div class="row">

                                <!-- Start Time -->
                                <div class="col-md-4">
                                    <label>Daily Start Time</label>
                                    <input type="time"
                                           name="daily_start_time"
                                           class="form-control"
                                           value="{{ $settings->daily_start_time }}" required>
                                </div>

                                <!-- End Time -->
                                <div class="col-md-4">
                                    <label>Daily End Time</label>
                                    <input type="time"
                                           name="daily_end_time"
                                           class="form-control"
                                           value="{{ $settings->daily_end_time }}" required>
                                </div>

                                <!-- Slot Duration -->
                                <div class="col-md-4">
                                    <label>Slot Duration (Minutes)</label>
                                    <input type="number" class="form-control"
                                           name="slot_duration_minutes"
                                           value="{{ $settings->slot_duration_minutes }}" required>
                                </div>

                            </div>

                            <div class="row mt-3">

                                <!-- Slot Capacity -->
                                <div class="col-md-4">
                                    <label>Students Per Slot</label>
                                    <input type="number" class="form-control"
                                           name="slot_capacity"
                                           value="{{ $settings->slot_capacity }}" required>
                                </div>

                                <!-- Note -->
                                <div class="col-md-8">
                                    <label>Admin Note (Optional)</label>
                                    <textarea name="admin_note" class="form-control" rows="3">{{ $settings->admin_note }}</textarea>
                                </div>

                            </div>

                            <button class="btn btn-primary mt-3">Save Settings</button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
