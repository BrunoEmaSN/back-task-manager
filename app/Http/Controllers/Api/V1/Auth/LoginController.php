<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(protected LoginService $login_service)
    {
    }
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        try {
            return $this->login_service->authenticate($request);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
