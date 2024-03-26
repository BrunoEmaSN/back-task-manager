<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
  protected $safeParms = [];

  protected $operatorMap = [
    'eq' => '=',
    'lt' => '<',
    'lte' => '<=',
    'gt' => '>',
    'gte' => '>=',
    'like' => 'like'
  ];

  public function transform(Request $request)
  {
    $eloQuery = [];
    foreach ($this->safeParms as $column => $operators) {
      $query = $request->query($column);

      if (!isset($query)) {
        continue;
      }

      foreach ($operators as $operator) {
        if (isset($query[$operator])) {
          $eloQuery[] = [
            $column,
            $this->operatorMap[$operator],
            $query[$operator]
          ];
        }
      }
    }

    return $eloQuery;
  }
}
