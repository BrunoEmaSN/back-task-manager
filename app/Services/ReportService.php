<?php

namespace App\Services;

use App\Filters\V1\TasksFilter;
use App\Http\Requests\V1\Report\SendTaskReportRequest;
use App\Http\Resources\V1\ReportTaskResource;
use App\Models\Task;

class ReportService
{
  public function find_all_tasks(SendTaskReportRequest $request)
  {
    $filter = new TasksFilter();
    $filter_items = $filter->transform($request);

    $tasks = Task::where($filter_items);

    $include_user = $request->query('include_user');

    if ($include_user) {
      $tasks = $tasks->with('user');
    }

    return ReportTaskResource::collection($tasks->paginate()->appends($request->query()));
  }
}
