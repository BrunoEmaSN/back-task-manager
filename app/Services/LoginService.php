<?php

namespace App\Services;

use App\Enums\ROL;
use App\Models\User;
use App\Permissions\AllPermissions;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginService
{
  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (!Auth::attempt($credentials)) {
      return response()->json([
        'message' => 'The given data was invalid.',
        'errors' => [
          'password' => [
            'Invalid credentials'
          ]
        ]
      ], 422);
    }

    $user = User::where(['email' => $request->email])->first();

    if ($user->rol == ROL::NOACCESS->value) {
      return response()->json([
        'status' => false,
        'message' => 'no access'
      ], 500);
    }

    $expires_at = new DateTime();
    date_add($expires_at, date_interval_create_from_date_string('4 hours'));
    $auth_token = null;
    $permissions = new AllPermissions();

    if ($user->rol == ROL::SUPERADMIN->value) {
      $auth_token = $user->createToken(
        'superadmin_token',
        $permissions->superadmin,
        $expires_at
      )->plainTextToken;
    }

    if ($user->rol == ROL::EMPLOYEE->value) {
      $auth_token = $user->createToken(
        'employee_token',
        $permissions->employee,
        $expires_at
      )->plainTextToken;
    }

    return response()->json([
      'access_token' => $auth_token,
      'rol' => $user->rol,
      'name' => $user->name,
      'email' => $user->email
    ]);
  }
}
