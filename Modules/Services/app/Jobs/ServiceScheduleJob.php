<?php

namespace Modules\Services\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\Services\Entities\Service;
use Modules\Services\Enums\ServiceStatus;

class ServiceScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private Service $service)
    {
        //
    }

    public function handle(): void
    {
        Log::info('ServiceScheduleJob Started');
        $this->service->update([
            'status' => ServiceStatus::PUBLISHED,
            'published_at' => now(),
            'scheduled_for' => null,
        ]);
        Log::info('ServiceScheduleJob Ended');
    }
}
