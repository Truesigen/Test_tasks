<?php

namespace App\Listeners;

use App\Events\TaskStatusUpdatedEvent;
use App\Jobs\TaskStatusUpdatedJob;

class SendTaskStatusUpdatedMail
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(TaskStatusUpdatedEvent $event): void
    {
        TaskStatusUpdatedJob::dispatch($event->task);
    }
}
