<?php

use App\Enums\ROL;
use App\Permissions\AllPermissions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setup', function () {
    $credentials = [
        'email' => 'admin@admin.com',
        'password' => 'password'
    ];

    if (!Auth::attempt($credentials)) {
        $user = new \App\Models\User();

        $user->name = 'Admin';
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->birth_date = new DateTime();
        $user->address = "Sky";
        $user->rol = ROL::SUPERADMIN->value;

        $user->save();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user instanceof \App\Models\User) {
                $permissions = new AllPermissions();
                $superadmin_token = $user->createToken('superadmin-token', $permissions->superadmin);

                $employee_token = $user->createToken('employee-token', $permissions->employee);

                return [
                    'superadmin' => $superadmin_token->plainTextToken,
                    'employe' => $employee_token->plainTextToken,
                ];
            }
        }
    }
});
