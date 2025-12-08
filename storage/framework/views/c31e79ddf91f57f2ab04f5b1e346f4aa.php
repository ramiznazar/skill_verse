

<?php $__env->startSection('content'); ?>
    <div id="main-content">

        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6">
                    <h2>Interview Settings</h2>
                </div>
            </div>
        </div>

        <?php if(session('update')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo e(session('update')); ?>

                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">

                    <div class="card">
                        <div class="header">
                            <h2>Update Interview Settings</h2>
                        </div>

                        <div class="body">

                            <form action="<?php echo e(route('test.settings.update')); ?>" method="POST">
                                <?php echo csrf_field(); ?>

                                <div class="row">

                                    <!-- Default per day -->
                                    

                                    <!-- Max days ahead -->
                                    <div class="col-md-6">
                                        <label>Max Days Ahead Students Can Book</label>
                                        <input type="number" class="form-control" name="max_days_ahead"
                                            value="<?php echo e($settings->max_days_ahead); ?>" required>
                                    </div>

                                    <!-- Booking Status -->
                                    <div class="col-md-6">
                                        <label>Booking Status</label>
                                        <select name="is_booking_open" class="form-control">
                                            <option value="1" <?php echo e($settings->is_booking_open ? 'selected' : ''); ?>>Open
                                            </option>
                                            <option value="0" <?php echo e(!$settings->is_booking_open ? 'selected' : ''); ?>>
                                                Closed</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label>Booking Start Date</label>
                                        <input type="date" name="booking_start_date" class="form-control"
                                            value="<?php echo e($settings->booking_start_date); ?>" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Booking End Date</label>
                                        <input type="date" name="booking_end_date" class="form-control"
                                            value="<?php echo e($settings->booking_end_date); ?>" required>
                                    </div>
                                </div>

                                <hr>

                                <h5><strong>Daily Interview Timing</strong></h5>

                                <div class="row">

                                    <!-- Start Time -->
                                    <div class="col-md-3">
                                        <label>Daily Start Time</label>
                                        <input type="time" name="daily_start_time" class="form-control"
                                            value="<?php echo e($settings->daily_start_time); ?>" required>
                                    </div>

                                    <!-- End Time -->
                                    <div class="col-md-3">
                                        <label>Daily End Time</label>
                                        <input type="time" name="daily_end_time" class="form-control"
                                            value="<?php echo e($settings->daily_end_time); ?>" required>
                                    </div>

                                    <!-- Slot Duration -->
                                    <div class="col-md-3">
                                        <label>Slot Duration (Minutes)</label>
                                        <input type="number" class="form-control" name="slot_duration_minutes"
                                            value="<?php echo e($settings->slot_duration_minutes); ?>" required>
                                    </div>

                                    <!-- Slot Capacity -->
                                    <div class="col-md-3">
                                        <label>Students Per Slot</label>
                                        <input type="number" class="form-control" name="slot_capacity"
                                            value="<?php echo e($settings->slot_capacity); ?>" required>
                                    </div>
                                </div>

                                <div class="row mt-3">

                                    <!-- Note -->
                                    <div class="col-md-12">
                                        <label>Admin Note (Optional)</label>
                                        <textarea name="admin_note" class="form-control" rows="3"><?php echo e($settings->admin_note); ?></textarea>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/test/setting/setting.blade.php ENDPATH**/ ?>