<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Enums\BlogStatus;
use Modules\Blog\Events\BlogPublished;
use Modules\Blog\Jobs\BlogScheduleJob;

class ScheduleBlogPublication
{
    public function handle(BlogPublished $event): void
    {
        $service = $event->service;

        if (
            $service->status === BlogStatus::SCHEDULED &&
            $service->scheduled_for
        ) {
            BlogScheduleJob::dispatch($service)->delay($service->scheduled_for);
        }
    }
}
