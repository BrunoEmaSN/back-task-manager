<?php

namespace App\Services;

use App\Filters\V1\TasksFilter;
use App\Http\Requests\V1\Task\GetTasksRequest;
use App\Http\Resources\V1\TaskResource;
use App\Models\Task;

class TaskService
{
  public function find_all(GetTasksRequest $request)
  {
    $filter = new TasksFilter();
    $filter_items = $filter->transform($request);

    $tasks = Task::where($filter_items);

    $include_user = $request->query('include_user');

    if ($include_user) {
      $tasks = $tasks->with('user');
    }

    return TaskResource::collection($tasks->paginate()->appends($request->query()));
  }
}
