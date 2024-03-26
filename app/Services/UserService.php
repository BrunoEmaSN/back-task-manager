<?php

namespace App\Services;

use App\Filters\V1\UsersFilter;
use App\Http\Requests\V1\User\GetUsersRequest;
use App\Http\Requests\V1\User\StoreUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Jobs\SendMail;
use App\Models\User;

class UserService
{
  public function __construct(protected ResetPasswordService $reset_password_service)
  {
  }
  public function find_all(GetUsersRequest $request)
  {
    $filter = new UsersFilter();
    $filter_items = $filter->transform($request);

    $users = User::where($filter_items);

    $include_tasks = $request->query('include_tasks');

    if ($include_tasks) {
      $users = $users->with('tasks');
    }

    return UserResource::collection($users->paginate()->appends($request->query()));
  }

  public function create(StoreUserRequest $request)
  {
    $user = new UserResource(User::create($request->all()));
    $token = $this->reset_password_service->create_token($request);
    $data = [
      'token' => $token,
      'email' => $request->email,
      'subject' => 'Reset password'
    ];

    $email_template = "email-template.forgot-password";

    SendMail::dispatch($data, $email_template)->onQueue('mails');

    return $user;
  }
}
