<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Admission;

class FeeSubmissionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $admission;
    public $amount;

    /**
     * Create a new message instance.
     */
    public function __construct(Admission $admission, $amount)
    {
        $this->admission = $admission;
        $this->amount = $amount;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Fee Submission Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.pages.dashboard.fee-submission.mail',
            with: [
                'admission' => $this->admission,
                'amount' => $this->amount,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
