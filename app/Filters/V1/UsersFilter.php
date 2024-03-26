<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class UsersFilter extends ApiFilter
{
  protected $safeParms = [
    'name' => ['like'],
    'type' => ['eq'],
    'email' => ['like'],
  ];
}
