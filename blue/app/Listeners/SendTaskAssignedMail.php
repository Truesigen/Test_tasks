<?php

namespace App\Listeners;

use App\Events\TaskAssignedEvent;
use App\Jobs\TaskAssignedJob;

class SendTaskAssignedMail
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(TaskAssignedEvent $event): void
    {
        TaskAssignedJob::dispatch($event->task);
    }
}
