<?php

namespace App\Repositories;

use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class StatisticRepository
{
    public function getStatistic(): array
    {
        return [
            'total' => ['tasks' => Task::count(), 'projects' => Project::count()],
            'tasks' => [
                'pending' => Task::query()->where('status', TaskStatus::PENDING)->count(),
                'in_progress' => Task::query()->where('status', TaskStatus::IN_PROGRESS)->count(),
                'completed' => Task::query()->where('status', TaskStatus::COMPLETED)->count(),
            ],
            'expiredTasks' => Task::query()->where('due_date', '<', now())->count(),
            'top5' => User::query()->withCount('tasks')->orderByDesc('tasks_count')->limit(5)->get(),
        ];
    }
}
