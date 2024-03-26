<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ROL;
use App\Filters\V1\UsersFilter;
use App\Http\Requests\V1\User\StoreUserRequest;
use App\Http\Requests\V1\User\UpdateUserRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\DeleteUserRequest;
use App\Http\Requests\V1\User\GetUsersRequest;
use App\Http\Resources\V1\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $user_service
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(GetUsersRequest $request)
    {
        try {
            return $this->user_service->find_all($request);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            return $this->user_service->create($request);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try {
            return new UserResource($user);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            return $user->update($request->all());
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteUserRequest $request)
    {
        try {
            $user = User::where(['id' => $request->id])->first();
            return $user->update(['rol' => ROL::NOACCESS->value]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
