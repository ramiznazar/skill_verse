@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <!-- Header -->
        <div class="block-header">
            <div class="row clearfix">

                <div class="col-md-6 col-sm-12">
                    <h2>Test Bookings</h2>
                </div>

                <div class="col-md-6 col-sm-12 text-right">
                    <form action="{{ route('test.bookings.index') }}" method="GET" class="d-inline-block">
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </form>
                </div>

            </div>
        </div>

        <!-- Flash Messages -->
        @if (session('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('delete') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Bookings</h2>
                        </div>

                        <div class="body">

                            <form method="GET" action="{{ route('test.bookings.index') }}" id="filterForm" class="mb-3">

                                <div class="row">
                                    {{-- Course --}}
                                    <div class="col-md-4 mb-2">
                                        <select name="course_id" class="form-control">
                                            <option value="">Filter by Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Date --}}
                                    <div class="col-md-4 mb-2">
                                        <input type="date" name="date" class="form-control"
                                            value="{{ request('date') }}">
                                    </div>

                                    {{-- Time --}}
                                    <div class="col-md-4 mb-2">
                                        <input type="time" name="time" class="form-control"
                                            value="{{ request('time') }}">
                                    </div>

                                    {{-- Attendance --}}
                                    <div class="col-md-4 mb-2">
                                        <select name="attendance_status" class="form-control">
                                            <option value="">Attendance</option>
                                            <option value="attended"
                                                {{ request('attendance_status') == 'attended' ? 'selected' : '' }}>Attended
                                            </option>
                                            <option value="absent"
                                                {{ request('attendance_status') == 'absent' ? 'selected' : '' }}>Absent
                                            </option>
                                            <option value="not_marked"
                                                {{ request('attendance_status') == 'not_marked' ? 'selected' : '' }}>Not
                                                Marked
                                            </option>
                                        </select>
                                    </div>

                                    {{-- Booking Status --}}
                                    <div class="col-md-4 mb-2">
                                        <select name="status" class="form-control">
                                            <option value="">Booking Status</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="confirmed"
                                                {{ request('status') == 'confirmed' ? 'selected' : '' }}>
                                                Confirmed</option>
                                            <option value="rescheduled"
                                                {{ request('status') == 'rescheduled' ? 'selected' : '' }}>Rescheduled
                                            </option>
                                        </select>
                                    </div>

                                    {{-- Reset --}}
                                    <div class="col-md-4 text-right mb-2 ml-auto">
                                        <a href="{{ route('test.bookings.index') }}" class="btn btn-warning"
                                            style="width:200px;">
                                            Reset
                                        </a>
                                    </div>

                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Course</th>
                                            <th>Interview Date</th>
                                            <th>Interview Time</th>
                                            <th>Attendance</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($bookings as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $item->name }}</td>

                                                <td>{{ $item->phone }}</td>

                                                <td>
                                                    <span class="text-info">
                                                        {{ $item->course->title ?? 'N/A' }}
                                                    </span>
                                                </td>

                                                <!-- Interview Date -->
                                                <td>
                                                    @if ($item->testDay)
                                                        {{ \Carbon\Carbon::parse($item->testDay->test_date)->format('d M Y') }}
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>

                                                <!-- Interview Time -->
                                                <td>
                                                    @if ($item->testDay)
                                                        {{ \Carbon\Carbon::parse($item->testDay->test_start_time)->format('h:i A') }}
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>

                                                <!-- Attendance Badge -->
                                                <td class="attendance-badge">
                                                    <span
                                                        class="badge
                        @if ($item->attendance_status == 'attended') badge-success
                        @elseif($item->attendance_status == 'absent') badge-danger
                        @else badge-secondary @endif">
                                                        {{ $item->attendance_status ? ucfirst($item->attendance_status) : 'Not Marked' }}
                                                    </span>
                                                </td>

                                                <!-- Result Status -->
                                                <td class="result-badge">
                                                    <span
                                                        class="badge
        @if ($item->result_status == 'pass') badge-success
        @elseif($item->result_status == 'fail') badge-danger
        @else badge-secondary @endif">
                                                        {{ ucfirst($item->result_status) }}
                                                    </span>
                                                </td>

                                                <!-- Actions -->
                                                <td>
                                                    <!-- View -->
                                                    <a href="{{ route('test.bookings.show', $item->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="icon-eye"></i>
                                                    </a>

                                                    <!-- Delete -->
                                                    <form action="{{ route('test.bookings.delete', $item->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="icon-trash"></i>
                                                        </button>
                                                    </form>

                                                    <!-- Attended -->
                                                    <button class="btn btn-success btn-sm js-mark-attendance"
                                                        data-id="{{ $item->id }}" data-status="attended">
                                                        Attended
                                                    </button>

                                                    <!-- Absent -->
                                                    <button class="btn btn-dark btn-sm js-mark-attendance"
                                                        data-id="{{ $item->id }}" data-status="absent">
                                                        Absent
                                                    </button>

                                                    <!-- PASS -->
                                                    <button class="btn btn-primary btn-sm js-open-pass-modal"
                                                        data-id="{{ $item->id }}">
                                                        Pass
                                                    </button>

                                                    <!-- FAIL -->
                                                    <button class="btn btn-warning btn-sm js-mark-result"
                                                        data-id="{{ $item->id }}" data-result="fail">
                                                        Fail
                                                    </button>

                                                    @if ($item->result_status == 'pass' && $item->batch_id)
                                                        <a href="{{ route('admission.create', ['booking_id' => $item->id]) }}"
                                                            class="btn btn-info btn-sm">
                                                            Move to Admission
                                                        </a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- pass model --}}
    <!-- PASS MODAL -->
    <div class="modal fade" id="passModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Assign Batch</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="passBookingId">

                    <div id="batchListContainer">
                        <p>Loading available batches...</p>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('additional-javascript')
    <script>
        $(document).ready(function() {

            $('.js-mark-attendance').click(function() {
                let bookingId = $(this).data('id');
                let status = $(this).data('status');
                let button = $(this);

                $.ajax({
                    url: "{{ route('test.booking.attendance') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: bookingId,
                        status: status
                    },
                    beforeSend: function() {
                        button.prop('disabled', true);
                    },
                    success: function(response) {

                        let row = button.closest('tr');
                        let badgeCell = row.find('.attendance-badge');

                        let badgeClass = response.status === 'attended' ? 'badge-success' :
                            'badge-danger';

                        badgeCell.html(`
        <span class="badge ${badgeClass}">
            ${response.status.charAt(0).toUpperCase() + response.status.slice(1)}
        </span>
    `);

                        row.css('background-color', '#d4edda');
                        setTimeout(() => row.css('background-color', ''), 200);
                    },

                    error: function() {
                        alert('Update failed.');
                    },
                    complete: function() {
                        button.prop('disabled', false);
                    }
                });
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const form = document.getElementById('filterForm');
            if (!form) return;

            const selects = form.querySelectorAll('select');
            const inputs = form.querySelectorAll('input[type="date"], input[type="time"]');

            selects.forEach(sel => sel.addEventListener('change', () => form.submit()));
            inputs.forEach(inp => inp.addEventListener('change', () => form.submit()));
        });
    </script>
    {{-- test result --}}
    <script>
        $(document).ready(function() {

            $('.js-mark-result').click(function() {
                let id = $(this).data('id');
                let result = $(this).data('result');
                let button = $(this);

                $.ajax({
                    url: "{{ route('test.booking.result') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        result: result
                    },
                    beforeSend: function() {
                        button.prop('disabled', true);
                    },
                    success: function(response) {

                        let row = button.closest('tr');
                        let badgeCell = row.find('.result-badge');

                        let badgeClass =
                            response.status === 'pass' ?
                            'badge-success' :
                            'badge-danger';

                        badgeCell.html(`
                    <span class="badge ${badgeClass}">
                        ${response.status.charAt(0).toUpperCase() + response.status.slice(1)}
                    </span>
                `);

                        row.css('background-color', '#e7ffe7');
                        setTimeout(() => row.css('background-color', ''), 200);
                    },
                    complete: function() {
                        button.prop('disabled', false);
                    }
                });
            });

        });
    </script>
    {{-- load batches --}}
    <script>
        $(document).on('click', '.js-open-pass-modal', function() {
            let bookingId = $(this).data('id');
            $('#passBookingId').val(bookingId);

            $('#batchListContainer').html('<p>Loading...</p>');

            $('#passModal').modal('show');

            $.ajax({
                url: "{{ route('test.booking.loadBatches') }}",
                type: "GET",
                data: {
                    id: bookingId
                },
                success: function(response) {

                    let html = '';

                    response.batches.forEach(batch => {
                        let seatsLeft = batch.capacity - batch.assigned;

                        html += `
    <div class="card p-2 mb-2">
        <strong>${batch.title}</strong> (${batch.shift})
        <br>
        Timing: ${batch.timing}
        <br>
        Seats Left: <span class="text-danger">${seatsLeft}</span>
        <br><br>

        <button class="btn btn-success btn-sm js-confirm-pass" data-batch="${batch.id}">
            Assign to This Batch
        </button>
    </div>
    `;
                    });

                    $('#batchListContainer').html(html);
                }
            });
        });

        // CONFIRM PASS (Assign Batch)
        $(document).on('click', '.js-confirm-pass', function() {

            let bookingId = $('#passBookingId').val();
            let batchId = $(this).data('batch');

            $.ajax({
                url: "{{ route('test.booking.confirmPass') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    booking_id: bookingId,
                    batch_id: batchId
                },

                success: function(response) {

                    $('#passModal').modal('hide');

                    let row = $('button.js-open-pass-modal[data-id="' + bookingId + '"]').closest('tr');

                    // Replace PASS badge
                    row.find('.result-badge').html(`
                <span class="badge badge-success">Pass</span>
            `);

                    // Disable pass/fail buttons
                    row.find('.js-open-pass-modal').prop('disabled', true);
                    row.find('.js-mark-result[data-result="fail"]').prop('disabled', true);

                    // Add Move to Admission (if not added)
                    if (!row.find('.btn-move-admission').length) {
                        row.find('td:last').append(`
                    <a href="/admin/admission/create?booking_id=${bookingId}"
                       class="btn btn-info btn-sm btn-move-admission ml-1">
                       Move to Admission
                    </a>
                `);
                    }

                    alert("PASS assigned successfully.");
                },

                error: function(xhr) {
                    alert("Error: " + xhr.responseJSON.message);
                }
            });

        });
    </script>
@endsection
