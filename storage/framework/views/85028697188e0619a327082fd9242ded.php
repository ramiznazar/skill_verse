

<?php $__env->startSection('content'); ?>
<div id="main-content">

    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6">
                <h2>Edit Interview Day</h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="<?php echo e(route('test.days')); ?>" class="btn btn-primary btn-sm">All Days</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="card">
            <div class="header">
                <h2>Update Interview Day</h2>
            </div>

            <div class="body">

                <form action="<?php echo e(route('test.days.update', $day->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    
                    <div class="row">
                        <div class="col-md-6">
                            <label>Date</label>
                            <input type="date" class="form-control" value="<?php echo e($day->test_date); ?>" disabled>
                        </div>

                        <div class="col-md-6">
                            <label>Booking Status</label>
                            <select name="is_open" class="form-control">
                                <option value="1" <?php echo e($day->is_open ? 'selected' : ''); ?>>Open</option>
                                <option value="0" <?php echo e(!$day->is_open ? 'selected' : ''); ?>>Closed</option>
                            </select>
                        </div>
                    </div>

                    <hr>

                    <h5>Interview Slots</h5>
                    <p class="text-muted">These slots were auto-generated based on settings.</p>

                    <table class="table table-bordered" id="slotsTable">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Capacity</th>
                                <th>Booked</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $day->slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <input type="time" name="slots[<?php echo e($index); ?>][time]"
                                            class="form-control" value="<?php echo e($slot['time']); ?>" required>
                                    </td>

                                    <td>
                                        <input type="number" name="slots[<?php echo e($index); ?>][capacity]"
                                            class="form-control" value="<?php echo e($slot['capacity']); ?>" min="1" required>
                                    </td>

                                    <td>
                                        <input type="number" class="form-control" value="<?php echo e($slot['booked']); ?>" disabled>
                                        <input type="hidden" name="slots[<?php echo e($index); ?>][booked]"
                                               value="<?php echo e($slot['booked']); ?>">
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm removeSlot">X</button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <button type="button" id="addSlotBtn" class="btn btn-info btn-sm mt-2">+ Add Slot</button>

                    <hr>

                    <div class="form-group">
                        <label>Admin Note (optional)</label>
                        <textarea name="note" class="form-control" rows="3"><?php echo e($day->note); ?></textarea>
                    </div>

                    <button class="btn btn-primary mt-3">Update Day</button>

                </form>

            </div>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-javascript'); ?>
<script>
document.getElementById('addSlotBtn').addEventListener('click', function () {

    let table = document.querySelector('#slotsTable tbody');
    let index = table.rows.length;

    let row = `
        <tr>
            <td>
                <input type="time" name="slots[${index}][time]" class="form-control" required>
            </td>
            <td>
                <input type="number" name="slots[${index}][capacity]" class="form-control" min="1" required>
            </td>
            <td>
                <input type="number" class="form-control" value="0" disabled>
                <input type="hidden" name="slots[${index}][booked]" value="0">
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm removeSlot">X</button>
            </td>
        </tr>
    `;

    table.insertAdjacentHTML('beforeend', row);
});

// Remove slot
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('removeSlot')) {
        event.target.closest('tr').remove();
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/test/days/edit.blade.php ENDPATH**/ ?>