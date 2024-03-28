<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Services\ResetPasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResetPasswordController extends Controller
{
    public function __construct(protected ResetPasswordService $reset_password_service)
    {
    }
    public function reset_password(Request $request)
    {
        try {
            $result = $this->reset_password_service->reset_password($request);
            if ($result) {
                return view('auth.success-reset-password', ['success' => 'password reset success']);
            }

            return view('auth.reset-password', ['token' => $request->token, 'errors' => 'invalid']);
        } catch (\Throwable $th) {
            return view('auth.reset-password', ['token' => $request->token, 'errors' => $th->getMessage()]);
        }
    }
}
