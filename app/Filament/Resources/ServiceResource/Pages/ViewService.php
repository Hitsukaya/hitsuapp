<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use App\Filament\Resources\ServiceResource\Widgets\ServiceStatusStatsWidget;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Log;
use Modules\Services\Entities\Service;
use Modules\Services\Enums\ServiceStatus;

class ViewService extends ViewRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview')
                ->label('Preview')
                ->requiresConfirmation()
                ->icon('heroicon-o-eye')
                ->url(function (Service $record) {
                    return route('services.show', $record->slug);
                }, true)
                ->disabled(function (Service $record) {
                    return $record->status->value !== ServiceStatus::PUBLISHED->value;
                }),
        ];
    }


    public function getTitle(): string|Htmlable
    {
        $record = $this->getRecord();

        return $record->title;
    }

}
