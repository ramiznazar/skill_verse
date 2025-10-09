<?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="main">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<?php echo $__env->make('admin.layouts.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('additional-javascript'); ?>
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/layouts/main.blade.php ENDPATH**/ ?>