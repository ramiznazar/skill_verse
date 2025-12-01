<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Interview Passed</title>
</head>
<body>

    <h2>Hello <?php echo e($booking->name); ?>,</h2>

    <p>We are pleased to inform you that you have <strong>passed</strong> the interview for:</p>

    <h3><?php echo e($booking->course->title); ?></h3>

    <p>Your batch details:</p>

    <ul>
        <li><strong>Batch Name:</strong> <?php echo e($batch->title); ?></li>
        <li><strong>Shift:</strong> <?php echo e(ucfirst($batch->shift)); ?></li>
        <li><strong>Timing:</strong> <?php echo e($batch->timing); ?></li>
        <li><strong>Class Start Date:</strong> <?php echo e(\Carbon\Carbon::parse($batch->start_date)->format('d M Y')); ?></li>
    </ul>

    <p>You will receive further instructions soon.</p>

    <strong>Regards,<br><?php echo e(config('app.name')); ?></strong>

</body>
</html>
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/mail/student-pass.blade.php ENDPATH**/ ?>