<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\TasksFilter;
use App\Http\Requests\V1\Task\StoreTaskRequest;
use App\Http\Requests\V1\TASK\UpdateTaskRequest;
use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Task\DeleteTaskRequest;
use App\Http\Requests\V1\Task\GetTasksRequest;
use App\Http\Resources\V1\TaskResource;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function __construct(protected TaskService $task_service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(GetTasksRequest $request)
    {
        try {
            return $this->task_service->find_all($request);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            return new TaskResource(Task::create($request->all()));
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        try {
            return new TaskResource($task);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            return $task->update($request->all());
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteTaskRequest $request)
    {
        try {
            $task = Task::where(['id' => $request->id])->first();
            return $task->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
