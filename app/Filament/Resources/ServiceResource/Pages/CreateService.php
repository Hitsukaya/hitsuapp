<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Services\Events\ServicePublished;
use Modules\Services\Jobs\ServiceScheduleJob;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

    protected function afterCreate(): void
    {
        if ($this->record->isScheduled()) {
            ServiceScheduleJob::dispatch($this->record)
                ->delay(Carbon::parse($this->record->scheduled_for));
        }

        if ($this->record->isStatusPublished()) {
            $this->record->update([
                'published_at' => now(),
            ]);

            event(new ServicePublished($this->record));
        }
    }
}
