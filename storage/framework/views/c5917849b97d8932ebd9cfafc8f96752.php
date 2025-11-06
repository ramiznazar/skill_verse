<h2>Fee Submission Confirmation</h2>

<p>Dear <?php echo e($feeSubmission->admission->name); ?>,</p>
<p>Your fee has been successfully submitted.</p>

<ul>
    <li><strong>Course:</strong> <?php echo e($feeSubmission->admission->course->title); ?></li>
    <li><strong>Payment Type:</strong> <?php echo e(ucfirst(str_replace('_',' ', $feeSubmission->payment_type))); ?></li>
    <li><strong>Amount:</strong> ₨<?php echo e(number_format($feeSubmission->amount)); ?></li>
    <li><strong>Receipt No:</strong> <?php echo e($feeSubmission->receipt_no); ?></li>
    <li><strong>Date:</strong> <?php echo e(\Carbon\Carbon::parse($feeSubmission->submission_date)->format('d M Y')); ?></li>
</ul>

<p><a href="<?php echo e(route('fee-submission.download-receipt', $feeSubmission->id)); ?>">Download Receipt</a></p>

<p>Thanks,<br><?php echo e(config('app.name')); ?></p>
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/mail/fee-submission.blade.php ENDPATH**/ ?>