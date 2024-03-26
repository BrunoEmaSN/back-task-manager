<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class SendReportPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $data, protected $email_template)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $now = new Date('Ymd');
        Mail::send($this->email_template, [
            'date' => $now,
        ], function ($message) use ($now) {
            $message->to($this->data->email);
            $message->subject($this->data->subject);
            $message->attachData($this->data->pdf->output(), $now . 'report.pdf');
        });
    }
}
