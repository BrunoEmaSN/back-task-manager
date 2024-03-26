<?php

namespace App\Services;

use App\Models\PasswordResetTokens;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordService
{
  public function create_token(Request $request)
  {
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

    return $token;
  }

  public function reset_password(Request $request)
  {
    $request->validate([
      'token' => ['required'],
      'password' => ['required'],
    ]);

    $reset_password = PasswordResetTokens::where('token', $request->token)->first();

    if (!$reset_password) {
      return response()->json([
        'status' => false,
        'message' => 'Invalid!'
      ], 500);
    }

    $now = new DateTime();
    $expires_at = new DateTime($reset_password->expires_at);

    if ($expires_at < $now) {
      return response()->json([
        'status' => false,
        'message' => 'Expirated'
      ], 500);
    }

    $user = User::where('email', $reset_password->email)->first();

    if (!$user->email_verified_at) {
      $user->update(['password' => Hash::make($request->password), 'email_verified_at' => $now]);
    } else {
      $user->update(['password' => Hash::make($request->password)]);
    }

    $status = $reset_password->where('token', $request->token)->delete();

    return response()->json(['status' => $status]);
  }
}
