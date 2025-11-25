

<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6"><h2>Create Interview Day</h2></div>
            <div class="col-md-6 text-right">
                <a href="<?php echo e(route('test.days')); ?>" class="btn btn-primary btn-sm">All Days</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="card">
            <div class="header">
                <h2>Add Interview Day</h2>
            </div>

            <div class="body">
                
                <form action="<?php echo e(route('test.days.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Interview Date</label>
                            <input type="date" name="test_date" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Booking Status</label>
                            <select name="is_open" class="form-control">
                                <option value="1">Open</option>
                                <option value="0">Closed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label>Admin Note (optional)</label>
                        <textarea name="note" class="form-control" rows="3"></textarea>
                    </div>

                    <hr>

                    <p class="text-muted">
                        Slots will be automatically generated based on Interview Settings:
                        <br>
                        <strong>Start Time → End Time → Slot Duration → Capacity</strong>
                    </p>

                    <button class="btn btn-primary mt-3">Save Interview Day</button>

                </form>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/test/days/create.blade.php ENDPATH**/ ?>