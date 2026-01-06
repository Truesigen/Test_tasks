<?php

namespace App\Jobs;

use App\Mail\TaskStatusUpdatedMail;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class TaskStatusUpdatedJob implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public readonly Task $task) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->task->load(['performer', 'creator']);
        $users = [$this->task->performer, $this->task->creator];
        foreach ($users as $user) {

            Mail::to($user)->send(new TaskStatusUpdatedMail($this->task, $user));
        }
    }
}
