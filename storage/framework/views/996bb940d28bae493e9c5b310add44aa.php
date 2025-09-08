

<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Edit Partner</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="<?php echo e(route('admin.partners.index')); ?>" class="btn btn-sm btn-secondary">Back to List</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.partners.update', $partner->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="card">
                <div class="header">
                    <h2>Partner Details</h2>
                </div>
                <div class="body row">
                    <div class="form-group col-md-4">
                        <label for="name"><strong>Name</strong></label>
                        <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $partner->name)); ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email"><strong>Email</strong></label>
                        <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $partner->email)); ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="phone"><strong>Phone</strong></label>
                        <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone', $partner->phone)); ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="investment"><strong>Investment Amount</strong></label>
                        <input type="number" name="investment" class="form-control" step="0.01" value="<?php echo e(old('investment', $partner->investment)); ?>" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="percentage"><strong>Profit Percentage (%)</strong></label>
                        <input type="number" name="percentage" class="form-control" step="0.01" value="<?php echo e(old('percentage', $partner->percentage)); ?>" required>
                    </div>
                </div>

                <div class="footer px-4 pb-4">
                    <button type="submit" class="btn btn-primary">Update Partner</button>
                    <a href="<?php echo e(route('admin.partners.index')); ?>" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/partners/update.blade.php ENDPATH**/ ?>