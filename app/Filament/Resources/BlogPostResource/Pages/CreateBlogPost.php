<?php

namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Filament\Resources\BlogPostResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Events\BlogPublished;
use Modules\Blog\Jobs\BlogScheduleJob;

class CreateBlogPost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }

    protected function afterCreate(): void
    {
        if ($this->record->isScheduled()) {
            BlogScheduleJob::dispatch($this->record)
                ->delay(Carbon::parse($this->record->scheduled_for));
        }

        if ($this->record->isStatusPublished()) {
            $this->record->update([
                'published_at' => now(),
            ]);

            event(new BlogPublished($this->record));
        }
    }
}
