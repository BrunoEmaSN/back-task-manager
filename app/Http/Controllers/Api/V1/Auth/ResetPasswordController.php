<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Services\ResetPasswordService;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function __construct(protected ResetPasswordService $reset_password_service)
    {
    }
    public function reset_password(Request $request)
    {
        try {
            return $this->reset_password_service->reset_password($request);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
