<?php

namespace App\Services;

use App\DTOs\TaskDTO;
use App\Jobs\TaskStatusUpdatedJob;
use App\Mail\TaskStatusUpdatedMail;
use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;

class TaskService
{
    public function __construct(public readonly TaskRepository $repository) {}

    public function store(TaskDTO $dto): Task
    {
        return $this->repository->create($dto);
    }

    public function update(TaskDTO $dto, Task $task, User $user)
    {

        if ($user->id == $task->assigned_to) {
            $task = $this->repository->updateStatus($task, $dto->status);
        }

        if ($task->created_by == $user->id || $user->is_admin) {
            $task = $this->repository->update($dto, $task);
        }

        return $task;
        // $recepients = $task->load(['performer', 'creator']);

        // // return new TaskStatusUpdatedMail($user, $task)->render();
        // TaskStatusUpdatedJob::dispatch([$recepients->performer, $recepients->creator], $task);
    }
}
