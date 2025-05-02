<?php

namespace Modules\Services\Http\Livewire;

use Livewire\Component;
use Modules\Services\Entities\Service;
use Modules\Services\Enums\ServiceStatus;

class ServiceList extends Component
{
    public function render()
    {
        //$services = Service::with('categories')->latest()->get();

        $services = Service::with('categories')
            ->where('status', ServiceStatus::PUBLISHED->value)
            ->where('published_at', '<=', now())
            ->latest()
            ->get();

        return view('services::livewire.service-list', [
            'services' => $services,
        ]);
    }
}
