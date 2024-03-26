<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendMail;
use App\Models\PasswordResetTokens;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function forgot_password(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'email']
            ]);
            $token = str_random(64);
            $created_at = new DateTime();
            $expires_at = new DateTime();
            date_add($expires_at, date_interval_create_from_date_string('20 minutes'));
            $password_reset_tokens = [
                'email' => $request->email,
                'token' => $token,
                'created_at' => $created_at,
                'expires_at' => $expires_at
            ];

            $reset_password = PasswordResetTokens::where([
                'email' => $request->email
            ])->first();

            if (!$reset_password) {
                PasswordResetTokens::create($password_reset_tokens);
            } else {
                $reset_password->where([
                    'email' => $request->email
                ])->update([
                    'token' => $token,
                    'expires_at' => $expires_at
                ]);
            }

            // Mail::send("email-template.forgot-password", ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
            //     $message->to($request->email);
            //     $message->subject("Forgot you password");
            // });

            $data = [
                'token' => $token,
                'email' => $request->email,
                'subject' => 'Forgot your password'
            ];

            $email_template = "email-template.forgot-password";

            SendMail::dispatch($data, $email_template)->onQueue('mails');

            return response()->json(['status' => "ok"], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
