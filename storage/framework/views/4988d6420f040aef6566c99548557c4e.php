

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Teacher Attendance</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <?php if($selectedCourseId && $date): ?>
                        <form method="POST" action="<?php echo e(route('teacher.attendance.bulkPresent')); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="course_id" value="<?php echo e($selectedCourseId); ?>">
                            <input type="hidden" name="date" value="<?php echo e($date); ?>">
                            <?php if($selectedShift): ?>
                                <input type="hidden" name="shift" value="<?php echo e($selectedShift); ?>">
                            <?php endif; ?>
                            <button type="submit" class="btn btn-sm btn-success"><i class="icon-check"></i> Mark All
                                Present</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?php echo e(session('success')); ?>

                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        <?php endif; ?>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Teachers</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">
                            
                            <form method="GET" action="<?php echo e(route('teacher.attendance.index')); ?>" id="filterForm"
                                class="mb-3">
                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-md-12 mb-2">
                                        <input type="text" name="search" class="form-control"
                                            value="<?php echo e($search); ?>" placeholder="Search teacher...">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <select name="course_id" class="form-control">
                                            <option value="">Filter by Course</option>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($course->id); ?>"
                                                    <?php echo e((string) $selectedCourseId === (string) $course->id ? 'selected' : ''); ?>>
                                                    <?php echo e($course->title); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <select name="shift" class="form-control">
                                            <option value="">Filter by Shift</option>
                                            <option value="morning" <?php echo e($selectedShift === 'morning' ? 'selected' : ''); ?>>
                                                Morning</option>
                                            <option value="evening" <?php echo e($selectedShift === 'evening' ? 'selected' : ''); ?>>
                                                Evening</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <input type="date" name="date" class="form-control"
                                            value="<?php echo e($date); ?>">
                                    </div>
                                </div>
                            </form>

                            
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="card border-0 shadow-sm text-center">
                                        <div class="body">
                                            <h6 class="text-muted">Total</h6>
                                            <h3><?php echo e($totalTeachers); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-0 shadow-sm text-center">
                                        <div class="body">
                                            <h6 class="text-muted">Present</h6>
                                            <h3 class="text-success"><?php echo e($totalPresents); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-0 shadow-sm text-center">
                                        <div class="body">
                                            <h6 class="text-muted">Absent</h6>
                                            <h3 class="text-danger"><?php echo e($totalAbsents); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-0 shadow-sm text-center">
                                        <div class="body">
                                            <h6 class="text-muted">Leave</h6>
                                            <h3 class="text-warning"><?php echo e($totalLeaves); ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Shift(s)</th>
                                            <th>Status (<?php echo e($date); ?>)</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php $attendance = $attendances[$t->id] ?? null; ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($t->name); ?></td>
                                                <td><?php echo e($t->course->title ?? '-'); ?></td>
                                                <td>
                                                    <?php $__empty_2 = true; $__currentLoopData = $t->batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                                        <span class="badge badge-light d-inline-block mb-1">
                                                            <?php echo e($b->title); ?> (<?php echo e(ucfirst($b->shift ?? '-')); ?>)
                                                        </span><br>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if(!$attendance): ?>
                                                        <span class="badge badge-secondary">Not Marked</span>
                                                    <?php else: ?>
                                                        <span
                                                            class="badge badge-<?php echo e($attendance->status === 'present' ? 'success' : ($attendance->status === 'absent' ? 'danger' : ($attendance->status === 'leave' ? 'warning' : 'info'))); ?>">
                                                            <?php echo e(ucfirst($attendance->status)); ?>

                                                        </span>
                                                        
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-nowrap">
                                                    <form method="POST"
                                                        action="<?php echo e(route('teacher.attendance.markPresent')); ?>"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="teacher_id"
                                                            value="<?php echo e($t->id); ?>">
                                                        <input type="hidden" name="date"
                                                            value="<?php echo e($date); ?>">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-success">Present</button>
                                                    </form>
                                                    <form method="POST"
                                                        action="<?php echo e(route('teacher.attendance.markAbsent')); ?>"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="teacher_id"
                                                            value="<?php echo e($t->id); ?>">
                                                        <input type="hidden" name="date"
                                                            value="<?php echo e($date); ?>">
                                                        <button type="submit" class="btn btn-sm btn-dark">Absent</button>
                                                    </form>

                                                    
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-toggle="modal" data-target="#leaveModal"
                                                        data-teacher="<?php echo e($t->id); ?>">
                                                        Leave
                                                    </button>

                                                    <button type="submit" class="btn btn-sm btn-warning js-mark-late"
                                                        data-teacher="<?php echo e($t->id); ?>"
                                                        data-date="<?php echo e($date); ?>">
                                                        Late
                                                    </button>

                                                    <a href="<?php echo e(route('teacher.attendance.history', $t->id)); ?>"
                                                        class="btn btn-sm btn-info">
                                                        History
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No teachers found for
                                                    this filter.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            
                            <div class="modal fade" id="leaveModal" tabindex="-1" role="dialog"
                                aria-labelledby="leaveModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="<?php echo e(route('teacher.attendance.markLeave')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-header bg-warning text-dark">
                                                <h5 class="modal-title" id="leaveModalLabel">Mark Leave (Teacher)</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="teacher_id" id="leaveTeacherId">
                                                <input type="hidden" name="date" value="<?php echo e($date); ?>">
                                                <div class="form-group">
                                                    <label>Remarks (Optional)</label>
                                                    <textarea name="remarks" id="leaveRemarks" class="form-control" rows="3"
                                                        placeholder="Enter reason for leave..."></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-warning">Save Leave</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-javascript'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit filters
            const form = document.getElementById('filterForm');
            if (form) {
                const selects = form.querySelectorAll('select');
                const inputs = form.querySelectorAll('input[type=text], input[type=date]');
                selects.forEach(sel => sel.addEventListener('change', () => form.submit()));
                inputs.forEach(inp => inp.addEventListener('change', () => form.submit()));
            }

            // Leave modal → populate teacher id
            $('#leaveModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const teacherId = button.data('teacher');
                $('#leaveTeacherId').val(teacherId);
                $('#leaveRemarks').val('');
            });

            // ✅ Set CSRF for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            });

            // ✅ Reusable AJAX attendance updater
            function markAttendance(teacherId, date, route, remarks = '') {
                if (!teacherId || !date) return;

                $.ajax({
                    url: route,
                    method: 'POST',
                    data: {
                        teacher_id: teacherId,
                        date: date,
                        remarks: remarks
                    },
                    beforeSend: function() {
                        $('button[data-teacher="' + teacherId + '"]').prop('disabled', true);
                    },
                    success: function(response) {
                        const row = $('button[data-teacher="' + teacherId + '"]').closest('tr');
                        const statusCell = row.find('td:nth-child(5) span');

                        let badgeClass = 'badge-secondary';
                        switch (response.status) {
                            case 'present':
                                badgeClass = 'badge-success';
                                break;
                            case 'absent':
                                badgeClass = 'badge-dark';
                                break;
                            case 'late':
                                badgeClass = 'badge-info';
                                break;
                            case 'leave':
                                badgeClass = 'badge-warning';
                                break;
                        }

                        statusCell
                            .removeClass()
                            .addClass('badge ' + badgeClass)
                            .text(response.status.charAt(0).toUpperCase() + response.status.slice(1));

                        // subtle visual feedback (no toast)
                        row.css('background-color', '#d4edda');
                        setTimeout(() => row.css('background-color', ''), 150);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText || xhr.statusText);
                    },
                    complete: function() {
                        $('button[data-teacher="' + teacherId + '"]').prop('disabled', false);
                    }
                });
            }

            // ✅ Present
            $('button.btn-success').on('click', function(e) {
                e.preventDefault();
                const row = $(this).closest('tr');
                const id = row.find('input[name=teacher_id]').val();
                const date = row.find('input[name=date]').val() || '<?php echo e($date); ?>';
                markAttendance(id, date, "<?php echo e(route('teacher.attendance.markPresent')); ?>");
            });

            // ✅ Absent
            $('button.btn-dark').on('click', function(e) {
                e.preventDefault();
                const row = $(this).closest('tr');
                const id = row.find('input[name=teacher_id]').val();
                const date = row.find('input[name=date]').val() || '<?php echo e($date); ?>';
                markAttendance(id, date, "<?php echo e(route('teacher.attendance.markAbsent')); ?>");
            });

            // ✅ Late — only target our .js-mark-late button (avoid modal conflict)
            $(document).on('click', 'button.js-mark-late', function(e) {
                e.preventDefault();
                const id = $(this).data('teacher') || $(this).closest('tr').find('input[name=teacher_id]')
                    .val();
                const date = $(this).data('date') || '<?php echo e($date); ?>';
                markAttendance(id, date, "<?php echo e(route('teacher.attendance.markLate')); ?>");
            });

            // ✅ Leave modal submit via AJAX
            $('#leaveModal form').on('submit', function(e) {
                e.preventDefault();
                const teacherId = $('#leaveTeacherId').val();
                const remarks = $('#leaveRemarks').val();
                const date = '<?php echo e($date); ?>';
                if (!teacherId) return;
                markAttendance(teacherId, date, "<?php echo e(route('teacher.attendance.markLeave')); ?>", remarks ||
                    '');
                $('#leaveModal').modal('hide');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/attendance/teacher/index.blade.php ENDPATH**/ ?>