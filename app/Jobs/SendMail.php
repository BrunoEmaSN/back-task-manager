<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
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
        $data = [
            'token' => $this->data['token'],
            'email' => $this->data['email'],
        ];
        Mail::send($this->email_template, $data, function ($message) {
            $message->to($this->data['email']);
            $message->subject($this->data['subject']);
        });
    }
}
