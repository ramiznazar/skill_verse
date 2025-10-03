

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Student Attendance</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    
                    <?php if($selectedCourseId && $selectedShift && $date): ?>
                        <form method="POST" action="<?php echo e(route('student.attendance.bulkPresent')); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="course_id" value="<?php echo e($selectedCourseId); ?>">
                            <input type="hidden" name="shift" value="<?php echo e($selectedShift); ?>">
                            <input type="hidden" name="date" value="<?php echo e($date); ?>">
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="icon-check"></i> Mark All Present
                            </button>
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
                            <h2>Attendance Records</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">

                            
                            <form method="GET" action="<?php echo e(route('student.attendance.index')); ?>" id="filterForm"
                                class="mb-3">
                                <div class="row" style="margin-top: 15px;">

                                    <div class="col-md-12 mb-2">
                                        <input type="text" name="search" class="form-control"
                                            value="<?php echo e($search); ?>" placeholder="Search student...">
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
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-1 text-muted">Total</h6>
                                            <h3 class="fw-bold text-dark"><?php echo e($totalStudents); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-0 shadow-sm text-center">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-1 text-muted">Present</h6>
                                            <h3 class="fw-bold text-success"><?php echo e($totalPresents); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-0 shadow-sm text-center">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-1 text-muted">Absent</h6>
                                            <h3 class="fw-bold text-danger"><?php echo e($totalAbsents); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-0 shadow-sm text-center">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-1 text-muted">Leave</h6>
                                            <h3 class="fw-bold text-warning"><?php echo e($totalLeaves); ?></h3>
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
                                            <th>Batch</th>
                                            <th>Status (<?php echo e($date); ?>)</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $admissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php $attendance = $attendances[$student->id] ?? null; ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($student->name); ?></td>
                                                <td><?php echo e($student->course->title ?? '-'); ?></td>
                                                <td><?php echo e($student->batch->title ?? '-'); ?>

                                                    <small
                                                        class="text-muted">(<?php echo e(ucfirst($student->batch->shift ?? '-')); ?>)</small>
                                                </td>
                                                <td>
                                                    <?php if(!$attendance): ?>
                                                        <span class="badge badge-secondary">Not Marked</span>
                                                    <?php else: ?>
                                                        <span
                                                            class="badge badge-<?php echo e($attendance->status === 'present'
                                                                ? 'success'
                                                                : ($attendance->status === 'absent'
                                                                    ? 'danger'
                                                                    : ($attendance->status === 'leave'
                                                                        ? 'warning'
                                                                        : 'info'))); ?>">
                                                            <?php echo e(ucfirst($attendance->status)); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    
                                                    <form method="POST"
                                                        action="<?php echo e(route('student.attendance.markPresent')); ?>"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="admission_id"
                                                            value="<?php echo e($student->id); ?>">
                                                        <input type="hidden" name="date" value="<?php echo e($date); ?>">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-success">Present</button>
                                                    </form>
                                                    <form method="POST"
                                                        action="<?php echo e(route('student.attendance.markAbsent')); ?>"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="admission_id"
                                                            value="<?php echo e($student->id); ?>">
                                                        <input type="hidden" name="date"
                                                            value="<?php echo e($date); ?>">
                                                        <button type="submit" class="btn btn-sm btn-dark">Absent</button>
                                                    </form>
                                                    <form method="POST"
                                                        action="<?php echo e(route('student.attendance.markLeave')); ?>"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="admission_id"
                                                            value="<?php echo e($student->id); ?>">
                                                        <input type="hidden" name="date"
                                                            value="<?php echo e($date); ?>">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger">Leave</button>
                                                    </form>
                                                    <form method="POST"
                                                        action="<?php echo e(route('student.attendance.markLate')); ?>"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="admission_id"
                                                            value="<?php echo e($student->id); ?>">
                                                        <input type="hidden" name="date"
                                                            value="<?php echo e($date); ?>">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-warning">Late</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No students found for
                                                    this filter.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
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
            const form = document.getElementById('filterForm');
            const selects = form.querySelectorAll('select');
            const inputs = form.querySelectorAll('input[type=text], input[type=date]');

            selects.forEach(sel => sel.addEventListener('change', () => form.submit()));
            inputs.forEach(inp => inp.addEventListener('change', () => form.submit()));
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/attendance/student/index.blade.php ENDPATH**/ ?>