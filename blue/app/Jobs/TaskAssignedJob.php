<?php

namespace App\Jobs;

use App\Mail\TaskAssignedMail;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class TaskAssignedJob implements ShouldQueue
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
        $this->task->load('performer');
        Mail::to($this->task->performer)->send(new TaskAssignedMail($this->task, $this->task->performer));
    }
}
