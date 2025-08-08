<!DOCTYPE html>
<html>
<head>
    <title>Fee Submission</title>
</head>
<body>
    <h2>Hi {{ $admission->student_name ?? 'Student' }},</h2>
    <p>Your fee has been successfully submitted.</p>
    <p><strong>Amount Paid:</strong> Rs. {{ number_format($amount) }}</p>
    <p>Thank you for choosing Skillverse.</p>
</body>
</html>
