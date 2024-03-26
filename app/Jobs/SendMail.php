<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
        Mail::send($this->email_template, [
            'token' => $this->data->token,
            'email' => $this->data->email,
            'content' => $this->data->content
        ], function ($message) {
            $message->to($this->data->email);
            $message->subject($this->data->subject);
        });
    }
}
