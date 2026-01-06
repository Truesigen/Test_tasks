<?php

namespace App\Repositories;

use App\DTOs\TaskDTO;
use App\Models\Task;

class TaskRepository
{
    public function create(TaskDTO $dto): Task
    {
        $task = new Task;

        $this->fill($dto, $task);
        $task->created_by = $dto->created_by;

        $task->save();

        return $task;
    }

    public function update(TaskDTO $dto, Task $task): Task
    {
        $this->fill($dto, $task);

        $task->save();

        return $task;
    }

    public function updateStatus(Task $task, string $status): Task
    {
        $task->status = $status;

        $task->save();

        return $task;
    }

    public function fill(TaskDTO $dto, Task $task): Task
    {
        $task->title = $dto->title;
        $task->description = $dto->description;
        $task->status = $dto->status;
        $task->priority = $dto->priority;
        $task->project_id = $dto->project_id;
        $task->assigned_to = $dto->assigned_to;
        $task->due_date = $dto->due_date;

        return $task;
    }
}
