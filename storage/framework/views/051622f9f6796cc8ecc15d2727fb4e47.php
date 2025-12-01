

<?php $__env->startSection('content'); ?>
    <div id="main-content">

        <!-- Header -->
        <div class="block-header">
            <div class="row clearfix">

                <div class="col-md-6 col-sm-12">
                    <h2>Test Bookings</h2>
                </div>

                <div class="col-md-6 col-sm-12 text-right">
                    <form action="<?php echo e(route('test.bookings.index')); ?>" method="GET" class="d-inline-block">
                        <input type="date" name="date" class="form-control" value="<?php echo e(request('date')); ?>">
                    </form>
                </div>

            </div>
        </div>

        <!-- Flash Messages -->
        <?php if(session('delete')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('delete')); ?>

                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Bookings</h2>
                        </div>

                        <div class="body">

                            <form method="GET" action="<?php echo e(route('test.bookings.index')); ?>" id="filterForm" class="mb-3">

                                <div class="row">
                                    
                                    <div class="col-md-4 mb-2">
                                        <select name="course_id" class="form-control">
                                            <option value="">Filter by Course</option>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($course->id); ?>"
                                                    <?php echo e(request('course_id') == $course->id ? 'selected' : ''); ?>>
                                                    <?php echo e($course->title); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    
                                    <div class="col-md-4 mb-2">
                                        <input type="date" name="date" class="form-control"
                                            value="<?php echo e(request('date')); ?>">
                                    </div>

                                    
                                    <div class="col-md-4 mb-2">
                                        <input type="time" name="time" class="form-control"
                                            value="<?php echo e(request('time')); ?>">
                                    </div>

                                    
                                    <div class="col-md-4 mb-2">
                                        <select name="attendance_status" class="form-control">
                                            <option value="">Attendance</option>
                                            <option value="attended"
                                                <?php echo e(request('attendance_status') == 'attended' ? 'selected' : ''); ?>>Attended
                                            </option>
                                            <option value="absent"
                                                <?php echo e(request('attendance_status') == 'absent' ? 'selected' : ''); ?>>Absent
                                            </option>
                                            <option value="not_marked"
                                                <?php echo e(request('attendance_status') == 'not_marked' ? 'selected' : ''); ?>>Not
                                                Marked
                                            </option>
                                        </select>
                                    </div>

                                    
                                    <div class="col-md-4 mb-2">
                                        <select name="status" class="form-control">
                                            <option value="">Booking Status</option>
                                            <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>
                                                Pending</option>
                                            <option value="confirmed"
                                                <?php echo e(request('status') == 'confirmed' ? 'selected' : ''); ?>>
                                                Confirmed</option>
                                            <option value="rescheduled"
                                                <?php echo e(request('status') == 'rescheduled' ? 'selected' : ''); ?>>Rescheduled
                                            </option>
                                        </select>
                                    </div>

                                    
                                    <div class="col-md-4 text-right mb-2 ml-auto">
                                        <a href="<?php echo e(route('test.bookings.index')); ?>" class="btn btn-warning"
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
                                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>

                                                <td><?php echo e($item->name); ?></td>

                                                <td><?php echo e($item->phone); ?></td>

                                                <td>
                                                    <span class="text-info">
                                                        <?php echo e($item->course->title ?? 'N/A'); ?>

                                                    </span>
                                                </td>

                                                <!-- Interview Date -->
                                                <td>
                                                    <?php if($item->testDay): ?>
                                                        <?php echo e(\Carbon\Carbon::parse($item->testDay->test_date)->format('d M Y')); ?>

                                                    <?php else: ?>
                                                        <span class="text-muted">N/A</span>
                                                    <?php endif; ?>
                                                </td>

                                                <!-- Interview Time -->
                                                <td>
                                                    <?php if($item->testDay): ?>
                                                        <?php echo e(\Carbon\Carbon::parse($item->testDay->test_start_time)->format('h:i A')); ?>

                                                    <?php else: ?>
                                                        <span class="text-muted">N/A</span>
                                                    <?php endif; ?>
                                                </td>

                                                <!-- Attendance Badge -->
                                                <td class="attendance-badge">
                                                    <span
                                                        class="badge
                        <?php if($item->attendance_status == 'attended'): ?> badge-success
                        <?php elseif($item->attendance_status == 'absent'): ?> badge-danger
                        <?php else: ?> badge-secondary <?php endif; ?>">
                                                        <?php echo e($item->attendance_status ? ucfirst($item->attendance_status) : 'Not Marked'); ?>

                                                    </span>
                                                </td>

                                                <!-- Result Status -->
                                                <td class="result-badge">
                                                    <span
                                                        class="badge
        <?php if($item->result_status == 'pass'): ?> badge-success
        <?php elseif($item->result_status == 'fail'): ?> badge-danger
        <?php else: ?> badge-secondary <?php endif; ?>">
                                                        <?php echo e(ucfirst($item->result_status)); ?>

                                                    </span>
                                                </td>

                                                <!-- Actions -->
                                                <td>
                                                    <!-- View -->
                                                    <a href="<?php echo e(route('test.bookings.show', $item->id)); ?>"
                                                        class="btn btn-sm btn-info">
                                                        <i class="icon-eye"></i>
                                                    </a>

                                                    <!-- Delete -->
                                                    <form action="<?php echo e(route('test.bookings.delete', $item->id)); ?>"
                                                        method="POST" style="display:inline-block;">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="icon-trash"></i>
                                                        </button>
                                                    </form>

                                                    <!-- Attended -->
                                                    <button class="btn btn-success btn-sm js-mark-attendance"
                                                        data-id="<?php echo e($item->id); ?>" data-status="attended">
                                                        Attended
                                                    </button>

                                                    <!-- Absent -->
                                                    <button class="btn btn-dark btn-sm js-mark-attendance"
                                                        data-id="<?php echo e($item->id); ?>" data-status="absent">
                                                        Absent
                                                    </button>

                                                    <!-- PASS -->
                                                    <button class="btn btn-primary btn-sm js-open-pass-modal"
                                                        data-id="<?php echo e($item->id); ?>">
                                                        Pass
                                                    </button>

                                                    <!-- FAIL -->
                                                    <button class="btn btn-warning btn-sm js-mark-result"
                                                        data-id="<?php echo e($item->id); ?>" data-result="fail">
                                                        Fail
                                                    </button>

                                                    <?php if($item->result_status == 'pass' && $item->batch_id): ?>
                                                        <a href="<?php echo e(route('admission.create', ['booking_id' => $item->id])); ?>"
                                                            class="btn btn-info btn-sm">
                                                            Move to Admission
                                                        </a>
                                                    <?php endif; ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('additional-javascript'); ?>
    <script>
        $(document).ready(function() {

            $('.js-mark-attendance').click(function() {
                let bookingId = $(this).data('id');
                let status = $(this).data('status');
                let button = $(this);

                $.ajax({
                    url: "<?php echo e(route('test.booking.attendance')); ?>",
                    type: "POST",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
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
    
    <script>
        $(document).ready(function() {

            $('.js-mark-result').click(function() {
                let id = $(this).data('id');
                let result = $(this).data('result');
                let button = $(this);

                $.ajax({
                    url: "<?php echo e(route('test.booking.result')); ?>",
                    type: "POST",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
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
    
    <script>
        $(document).on('click', '.js-open-pass-modal', function() {
            let bookingId = $(this).data('id');
            $('#passBookingId').val(bookingId);

            $('#batchListContainer').html('<p>Loading...</p>');

            $('#passModal').modal('show');

            $.ajax({
                url: "<?php echo e(route('test.booking.loadBatches')); ?>",
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
                url: "<?php echo e(route('test.booking.confirmPass')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    booking_id: bookingId,
                    batch_id: batchId
                },

                success: function(response) {

                    // Close the modal
                    $('#passModal').modal('hide');

                    // Find booking row from table
                    let row = $('button.js-open-pass-modal[data-id="' + bookingId + '"]').closest('tr');

                    // Update PASS badge instantly
                    row.find('.result-badge').html(`
                <span class="badge badge-success">Pass</span>
            `);

                    // Disable Pass & Fail buttons
                    row.find('.js-open-pass-modal').prop('disabled', true);
                    row.find('.js-mark-result[data-result="fail"]').prop('disabled', true);

                    // If email failed (backend returned "email_failed")
                    if (response.email_status === "failed") {
                        alert("Student marked PASS, but email was NOT sent.");
                    } else {
                        alert("Student marked PASS and assigned to batch successfully.");
                    }
                },

                error: function(xhr) {
                    console.log(xhr.responseText); // see real error in console
                    alert("Server returned an error: " + xhr.status);
                }

            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/test/booking/index.blade.php ENDPATH**/ ?>