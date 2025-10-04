<?php echo $__env->make('website.layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('website.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Start main-content -->
<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('website.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('website.layouts.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('additional-javascript'); ?>
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/website/layouts/main.blade.php ENDPATH**/ ?>