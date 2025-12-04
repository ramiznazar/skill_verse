<?php

namespace App\Jobs;

use App\Models\Batch;
use App\Models\TestBooking;
use App\Mail\StudentPassMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendPassEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $booking_id;
    public $batch_id;

    public function __construct($booking_id, $batch_id)
    {
        $this->booking_id = $booking_id;
        $this->batch_id   = $batch_id;
    }

    public function handle()
    {
        $booking = TestBooking::find($this->booking_id);
        $batch   = Batch::find($this->batch_id);

        if (!$booking || !$batch || !$booking->email) {
            Log::error("EMAIL FAILED: Missing booking, batch, or email.");
            return;
        }

        Mail::to($booking->email)->send(new StudentPassMail($booking, $batch));
    }
}
