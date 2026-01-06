<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function update(User $user, Task $task): bool
    {

        if ($task->created_by == $user->id || $user->is_admin || $task->assigned_to == $user->id) {
            return true;
        }

        return false;
    }

    public function delete(User $user, Task $task): bool
    {
        if ($task->created_by == $user->id || $user->is_admin) {
            return true;
        }

        return false;
    }
}
