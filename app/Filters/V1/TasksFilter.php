<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class TasksFilter extends ApiFilter
{
  protected $safeParms = [
    'title' => ['eq'],
    'user_id' => ['eq'],
    'status' => ['eq'],
    'start_date' => ['eq', 'lt', 'gt'],
    'end_date' => ['eq', 'lt', 'gt']
  ];
}
