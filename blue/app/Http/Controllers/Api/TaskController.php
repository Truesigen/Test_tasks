<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(private readonly TaskService $service) {}

    public function index(FilterTaskRequest $request)
    {
        $tasks = Task::query()->with(['performer', 'creator', 'project'])->filter($request->validated())->sort($request->validated())->paginate(15)->withQueryString();

        return TaskResource::collection($tasks);
    }

    public function store(TaskRequest $request)
    {

        $task = $this->service->store($request->toDTO(), $request->user());

        return response()->json(['message' => 'success', 'task' => new TaskResource($task)], 201);
    }

    public function show(int $id)
    {

        return new TaskResource(Task::query()->with(['performer', 'creator', 'project'])->findOrFail($id));
    }

    public function update(TaskRequest $request, Task $task)
    {

        if ($request->user()->cannot('update', $task)) {
            return response()->json(['message' => 'forbidden'], 403);
        }

        $task = $this->service->update($request->toDTO(), $task, $request->user());

        return response()->json(['message' => 'success', 'task' => new TaskResource($task)]);
    }

    public function delete(Request $request, Task $task)
    {
        if ($request->user()->cannot('delete', $task)) {
            return response()->json(['message' => 'forbidden'], 403);
        }

        $task->delete();

        return response()->noContent();
    }
}
