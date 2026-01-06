<?php

namespace App\Listeners;

use App\Events\ProjectStatusUpdatedEvent;
use App\Jobs\ProjectStatusUpdatedJob;

class SendProjectStatusUpdatedMail
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(ProjectStatusUpdatedEvent $event): void
    {

        ProjectStatusUpdatedJob::dispatch($event->project);
    }
}
