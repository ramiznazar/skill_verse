<h2>Fee Submission Confirmation</h2>

<p>Dear {{ $feeSubmission->admission->name }},</p>
<p>Your fee has been successfully submitted.</p>

<ul>
    <li><strong>Course:</strong> {{ $feeSubmission->admission->course->title }}</li>
    <li><strong>Payment Type:</strong> {{ ucfirst(str_replace('_',' ', $feeSubmission->payment_type)) }}</li>
    <li><strong>Amount:</strong> ₨{{ number_format($feeSubmission->amount) }}</li>
    <li><strong>Receipt No:</strong> {{ $feeSubmission->receipt_no }}</li>
    <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($feeSubmission->submission_date)->format('d M Y') }}</li>
</ul>

<p><a href="{{ route('fee-submission.download-receipt', $feeSubmission->id) }}">Download Receipt</a></p>

<p>Thanks,<br>{{ config('app.name') }}</p>
