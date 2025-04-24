<?php

namespace Modules\Services\Listeners;

use Modules\Services\Events\ServicePublished;
use Modules\Services\Jobs\ServiceScheduleJob;
use Modules\Services\Enums\ServiceStatus;

class ScheduleServicePublication
{
    public function handle(ServicePublished $event): void
    {
        $service = $event->service;

        if (
            $service->status === ServiceStatus::SCHEDULED &&
            $service->scheduled_for
        ) {
            ServiceScheduleJob::dispatch($service)->delay($service->scheduled_for);
        }
    }
}
