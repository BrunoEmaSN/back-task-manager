<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class FilesFilter extends ApiFilter
{
  protected $safeParms = [
    'file' => ['like'],
    'user_id' => ['eq'],
    'task_id' => ['eq']
  ];
}
