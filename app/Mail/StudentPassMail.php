<?php

namespace App\Mail;

use App\Models\TestBooking;
use App\Models\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentPassMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $batch;

    /**
     * Create a new message instance.
     */
    public function __construct(TestBooking $booking, Batch $batch)
    {
        $this->booking = $booking;
        $this->batch = $batch;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Congratulations! Your Interview Result',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.pages.dashboard.mail.student-pass', 
            with: [
                'booking' => $this->booking,
                'batch' => $this->batch,
            ]
        );
    }

    /**
     * Attachments if needed.
     */
    public function attachments(): array
    {
        return [];
    }
}
