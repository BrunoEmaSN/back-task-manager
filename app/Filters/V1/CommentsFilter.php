<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class CommentsFilter extends ApiFilter
{
  protected $safeParms = [
    'comment' => ['like'],
    'user_id' => ['eq'],
    'task_id' => ['eq']
  ];
}
