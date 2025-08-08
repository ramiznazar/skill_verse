

<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Collector History<h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="<?php echo e(route('fee-collector.index')); ?>" class="btn btn-sm btn-primary">Back to Table</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Filtered Submissions</h2>
                        </div>

                        <div class="body">
                            <form method="GET" class="form-inline mb-3">
                                <div class="form-group mr-2">
                                    <label for="month">Month:</label>
                                    <select name="month" id="month" class="form-control ml-2">
                                        <option value="">All</option>
                                        <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($m); ?>" <?php echo e(request('month') == $m ? 'selected' : ''); ?>>
                                                <?php echo e(\Carbon\Carbon::create()->month($m)->format('F')); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group mr-2">
                                    <label for="year">Year:</label>
                                    <select name="year" id="year" class="form-control ml-2">
                                        <option value="">All</option>
                                        <?php for($y = now()->year; $y >= 2020; $y--): ?>
                                            <option value="<?php echo e($y); ?>" <?php echo e(request('year') == $y ? 'selected' : ''); ?>>
                                                <?php echo e($y); ?>

                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Name</th>
                                            <th>Course</th>
                                            <th>Fee (PKR)</th>
                                            <th>Payment Type</th>
                                            <th>Payment Method</th>
                                            <th>Submission Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($index + 1); ?></td>
                                                <td><?php echo e($submission->admission->name ?? 'N/A'); ?></td>
                                                <td><?php echo e($submission->admission->course->title ?? 'N/A'); ?></td>
                                                <td><?php echo e(number_format($submission->amount)); ?></td>
                                                <td><?php echo e(ucfirst($submission->payment_method)); ?></td>
                                                <td><?php echo e($submission->payment_type); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::parse($submission->submission_date)->format('d M Y')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No records found.</td>
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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/fee-collector/history.blade.php ENDPATH**/ ?>