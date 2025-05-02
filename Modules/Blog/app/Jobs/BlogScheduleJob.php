<?php

namespace Modules\Blog\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\Blog\Entities\BlogPost;
use Modules\Blog\Enums\BlogStatus;

class BlogScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private BlogPost $service)
    {
        //
    }

    public function handle(): void
    {
        Log::info('BlogScheduleJob Started');
        $this->service->update([
            'status' => BlogStatus::PUBLISHED,
            'published_at' => now(),
            'scheduled_for' => null,
        ]);
        Log::info('BlogScheduleJob Ended');
    }
}
