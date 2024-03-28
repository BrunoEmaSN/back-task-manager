<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class TasksFilter extends ApiFilter
{
  protected $safeParms = [
    'title' => ['like'],
    'user_id' => ['eq'],
    'status' => ['eq'],
    'start_date' => ['eq', 'lt', 'gt', 'gte'],
    'end_date' => ['eq', 'lt', 'gt', 'lte']
  ];
}
