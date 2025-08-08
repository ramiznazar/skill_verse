<!DOCTYPE html>
<html>
<head>
    <title>Fee Submission</title>
</head>
<body>
    <h2>Hi <?php echo e($admission->student_name ?? 'Student'); ?>,</h2>
    <p>Your fee has been successfully submitted.</p>
    <p><strong>Amount Paid:</strong> Rs. <?php echo e(number_format($amount)); ?></p>
    <p>Thank you for choosing Skillverse.</p>
</body>
</html>
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/fee-submission/mail.blade.php ENDPATH**/ ?>