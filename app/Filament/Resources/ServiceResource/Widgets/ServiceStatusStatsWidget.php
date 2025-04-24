<?php

namespace App\Filament\Resources\ServiceResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Modules\Services\Entities\Service;
use Modules\Services\Enums\ServiceStatus;

class ServiceStatusStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Published Services', Service::published()->count()),
            Stat::make('Scheduled Services', Service::scheduled()->count()),
            Stat::make('Pending Services', Service::pending()->count()),
        ];
    }
}
