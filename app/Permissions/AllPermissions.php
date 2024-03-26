<?php

namespace App\Permissions;

use App\Enums\PERMISSION;

class AllPermissions
{
  public $superadmin = [
    PERMISSION::CREATE_USER->value,
    PERMISSION::CREATE_TASK->value,
    PERMISSION::CREATE_COMMENT->value,
    PERMISSION::CREATE_FILE->value,

    PERMISSION::GET_USERS->value,
    PERMISSION::GET_TASKS->value,
    PERMISSION::GET_COMMENTS->value,
    PERMISSION::GET_FILES->value,

    PERMISSION::UPDATE_USER->value,
    PERMISSION::UPDATE_TASK->value,
    PERMISSION::UPDATE_COMMENT->value,

    PERMISSION::DELETE_USER->value,
    PERMISSION::DELETE_TASK->value,
    PERMISSION::DELETE_COMMENT->value,
    PERMISSION::DELETE_FILE->value,

    PERMISSION::SEND_REPORT->value,
  ];

  public $employee = [
    PERMISSION::CREATE_COMMENT->value,
    PERMISSION::CREATE_FILE->value,

    PERMISSION::GET_USERS->value,
    PERMISSION::GET_TASKS->value,
    PERMISSION::GET_COMMENTS->value,
    PERMISSION::GET_FILES->value,

    PERMISSION::UPDATE_COMMENT->value,

    PERMISSION::DELETE_COMMENT->value,
    PERMISSION::DELETE_FILE->value
  ];
}
