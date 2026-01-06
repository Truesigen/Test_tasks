<?php

namespace App\Jobs;

use App\Mail\ProjectStatusUpdatedMail;
use App\Models\Project;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProjectStatusUpdatedJob implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public readonly Project $project) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::query()->whereIn('id', $this->project->tasks()->whereNotNull('assigned_to')->distinct()->pluck('assigned_to'))->get();

        foreach ($users as $user) {
            Mail::to($user)->queue(new ProjectStatusUpdatedMail($this->project, $user));
        }
    }
}
