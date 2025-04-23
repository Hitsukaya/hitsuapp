<?php

namespace Modules\Services\Http\Livewire;

use Livewire\Component;
use Modules\Services\Entities\Service;

class ServiceList extends Component
{
    public function render()
    {
        $services = Service::with('category')->latest()->get();

        return view('services::livewire.service-list', [
            'services' => $services,
        ]);
    }
}
