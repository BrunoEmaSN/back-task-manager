<?php

use App\Http\Controllers\Api\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\ResetPasswordController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\FileController;
use App\Http\Controllers\Api\V1\ReportController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::post('login', [LoginController::class, 'authenticate'])->middleware('guest');
    Route::post('forgot_password', [ForgotPasswordController::class, 'forgot_password'])->middleware('guest');
    Route::post('reset_password', [ResetPasswordController::class, 'reset_password'])->middleware('guest');

    Route::apiResource('users', UserController::class)->middleware('auth:sanctum');
    Route::apiResource('tasks', TaskController::class)->middleware('auth:sanctum');
    Route::apiResource('comments', CommentController::class)->middleware('auth:sanctum');

    Route::get('load', [FileController::class, 'load'])->middleware('auth:sanctum');
    Route::post('upload', [FileController::class, 'upload'])->middleware('auth:sanctum');
    Route::post('download', [FileController::class, 'download'])->middleware('auth:sanctum');
    Route::delete('destroy', [FileController::class, 'destroy'])->middleware('auth:sanctum');

    Route::post('resports', [ReportController::class, 'tasks'])->middleware('auth:sanctum');
});
