<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Interview Passed</title>
</head>
<body>

    <h2>Hello {{ $booking->name }},</h2>

    <p>We are pleased to inform you that you have <strong>passed</strong> the interview for:</p>

    <h3>{{ $booking->course->title }}</h3>

    <p>Your batch details:</p>

    <ul>
        <li><strong>Batch Name:</strong> {{ $batch->title }}</li>
        <li><strong>Shift:</strong> {{ ucfirst($batch->shift) }}</li>
        <li><strong>Timing:</strong> {{ $batch->timing }}</li>
        <li><strong>Class Start Date:</strong> {{ \Carbon\Carbon::parse($batch->start_date)->format('d M Y') }}</li>
    </ul>

    <p>You will receive further instructions soon.</p>

    <strong>Regards,<br>{{ config('app.name') }}</strong>

</body>
</html>
