<?php

namespace Modules\Services\Http\Livewire;

use Livewire\Component;
use Modules\Services\Entities\Service;

class ServiceShow extends Component
{
    public $slug;
    public $service;

    public function mount($slug)
    {
        $this->service = Service::with('category')->where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('services::livewire.service-show', [
            'service' => $this->service,
        ]);
    }
}

