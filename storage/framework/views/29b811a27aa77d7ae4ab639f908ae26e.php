<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Skillverse | Fee Receipt</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            margin: 20px;
            color: #000;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            margin: 4px 0;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
        }
        hr {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Skillverse</h2>
        <p>Official Fee Receipt</p>
        <hr>
    </div>

    <div class="details">
        <p><strong>Receipt No:</strong> <?php echo e($fee->receipt_no); ?></p>
        <p><strong>Submission Date:</strong> <?php echo e(\Carbon\Carbon::parse($fee->submission_date)->format('d M Y')); ?></p>
        <p><strong>Student Name:</strong> <?php echo e($fee->admission->student->name ?? 'N/A'); ?></p>
        <p><strong>Course/Batch:</strong> <?php echo e($fee->admission->batch->title ?? 'N/A'); ?></p>
        <p><strong>Payment Type:</strong> <?php echo e(ucfirst($fee->payment_type)); ?></p>
        <p><strong>Payment Method:</strong> <?php echo e(ucfirst($fee->payment_method ?? 'N/A')); ?></p>
        <p><strong>Amount Paid:</strong> <?php echo e(number_format($fee->amount)); ?> PKR</p>
    </div>

    <hr>

    <div class="footer">
        <p>Thank you for your payment.</p>
        <p><small>This is a system-generated receipt. No signature is required.</small></p>
    </div>
</body>
</html>
<?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/pages/dashboard/fee-submission/receipt.blade.php ENDPATH**/ ?>