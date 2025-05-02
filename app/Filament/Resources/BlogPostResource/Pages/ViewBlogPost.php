<?php

namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Filament\Resources\BlogPostResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Modules\Blog\Entities\BlogPost;
use Modules\Blog\Enums\BlogStatus;
use Illuminate\Contracts\Support\Htmlable;

class ViewBlogPost extends ViewRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview')
                ->label('Preview')
                ->requiresConfirmation()
                ->icon('heroicon-o-eye')
                ->url(function (BlogPost $record) {
                    return route('blog.show', $record->slug);
                }, true)
                ->disabled(function (BlogPost $record) {
                    return $record->status->value !== BlogStatus::PUBLISHED->value;
                }),
        ];
    }


    public function getTitle(): string|Htmlable
    {
        $record = $this->getRecord();

        return $record->title;
    }
}
