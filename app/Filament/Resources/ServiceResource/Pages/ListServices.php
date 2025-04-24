<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'published' => Tab::make('Published')
                ->modifyQueryUsing(function ($query) {
                    $query->published();
                })->icon('heroicon-o-check-badge'),
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(function ($query) {
                    $query->pending();
                })
                ->icon('heroicon-o-clock'),
            'scheduled' => Tab::make('Scheduled')
                ->modifyQueryUsing(function ($query) {
                    $query->scheduled();
                })
                ->icon('heroicon-o-calendar-days'),
        ];
    }
}
