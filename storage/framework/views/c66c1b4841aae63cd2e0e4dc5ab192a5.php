

<?php $__env->startSection('content'); ?>
<div id="main-content">
  <div class="block-header">
    <div class="row clearfix">
      <div class="col-md-6 col-sm-12">
        <h2>Teacher Attendance History - <?php echo e($teacher->name); ?></h2>
        <small class="text-muted">
          Course: <?php echo e($teacher->course->title ?? '-'); ?>

          <?php if($teacher->joining_date): ?>
            | Joined: <?php echo e(\Carbon\Carbon::parse($teacher->joining_date)->format('d M Y')); ?>

          <?php endif; ?>
        </small>
      </div>
      <div class="col-md-6 col-sm-12 text-right">
        <a href="<?php echo e(route('teacher.attendance.index')); ?>" class="btn btn-sm btn-primary">⬅ Back</a>
      </div>
    </div>
  </div>

  <div class="container-fluid">

    <div class="card mb-4">
      <div class="body">
        <form method="GET" action="<?php echo e(route('teacher.attendance.history', $teacher->id)); ?>" class="row">
          <div class="col-md-6 mb-2">
            <label class="font-weight-bold">Select Month</label>
            <select name="month" class="form-control" onchange="this.form.submit()">
              <?php $__currentLoopData = range(1,12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($m); ?>" <?php echo e($month == $m ? 'selected' : ''); ?>>
                  <?php echo e(\Carbon\Carbon::create()->month($m)->format('F')); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="col-md-6 mb-2">
            <label class="font-weight-bold">Select Year</label>
            <select name="year" class="form-control" onchange="this.form.submit()">
              <?php $__currentLoopData = range(now()->year-3, now()->year+1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($y); ?>" <?php echo e($year == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </form>
      </div>
    </div>

    <?php if(isset($joinedTooLate) && $joinedTooLate): ?>
      <div class="alert alert-warning text-center">
        ⚠️ Attendance data is not available before the teacher's joining date —
        <strong><?php echo e(\Carbon\Carbon::parse($teacher->joining_date)->format('d M Y')); ?></strong>.
      </div>
    <?php else: ?>
      <?php
        $totalDays   = $daysInMonth;
        $presentDays = $attendances->whereIn('status', ['present','late'])->count();
        $absentDays  = $attendances->where('status','absent')->count();
        $leaveDays   = $attendances->where('status','leave')->count();
      ?>

      <div class="row mb-4">
        <div class="col-md-3"><div class="card shadow-sm text-center"><div class="body"><h6 class="text-muted">Total Days</h6><h3><?php echo e($totalDays); ?></h3></div></div></div>
        <div class="col-md-3"><div class="card shadow-sm text-center"><div class="body"><h6 class="text-muted">Presents</h6><h3 class="text-success"><?php echo e($presentDays); ?></h3></div></div></div>
        <div class="col-md-3"><div class="card shadow-sm text-center"><div class="body"><h6 class="text-muted">Absents</h6><h3 class="text-danger"><?php echo e($absentDays); ?></h3></div></div></div>
        <div class="col-md-3"><div class="card shadow-sm text-center"><div class="body"><h6 class="text-muted">Leaves</h6><h3 class="text-warning"><?php echo e($leaveDays); ?></h3></div></div></div>
      </div>

      <div class="card">
        <div class="body table-responsive">
          <table class="table table-hover mb-0">
            <thead class="thead-dark">
              <tr>
                <th>Day</th>
                <th>Date</th>
                <th>Status</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody>
            <?php for($d = 1; $d <= $daysInMonth; $d++): ?>
              <?php
                $record  = $attendances->get($d);
                $dateStr = \Carbon\Carbon::createFromDate($year,$month,$d)->toDateString();
              ?>
              <tr>
                <td><?php echo e($d); ?></td>
                <td><?php echo e($dateStr); ?></td>
                <td>
                  <?php if($record): ?>
                    <span class="badge badge-<?php echo e($record->status === 'present' ? 'success' : ($record->status === 'absent' ? 'danger' : ($record->status === 'leave' ? 'warning' : 'info'))); ?>">
                      <?php echo e(ucfirst($record->status)); ?>

                    </span>
                  <?php else: ?>
                    <span class="badge badge-light">Not Marked</span>
                  <?php endif; ?>
                </td>
                <td><?php echo e($record->remarks ?? '-'); ?></td>
              </tr>
            <?php endfor; ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php endif; ?>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/attendance/teacher/history.blade.php ENDPATH**/ ?>