<?php

namespace App\Services;

use App\Jobs\SendMail;
use Illuminate\Http\Request;

class ForgotPasswordService
{
  public function __construct(protected ResetPasswordService $reset_password_service)
  {
  }
  public function forgot_password(Request $request)
  {
    $token = $this->reset_password_service->create_token($request);
    $data = [
      'token' => $token,
      'email' => $request->email,
      'subject' => 'Forgot your password'
    ];

    $email_template = "email-template.forgot-password";

    SendMail::dispatch($data, $email_template)->onQueue('mails');

    return response()->json(['status' => "ok"], 200);
  }
}
