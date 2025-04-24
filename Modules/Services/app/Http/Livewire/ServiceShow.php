<?php

namespace Modules\Services\Http\Livewire;

use Livewire\Component;
use Modules\Services\Entities\Service;
use Modules\Services\Enums\ServiceStatus;

class ServiceShow extends Component
{
    public $slug;
    public $service;

    public function mount($slug)
    {
        $this->service = Service::with('categories')->where('slug', $slug)->firstOrFail();

        $this->service = Service::with('categories')
        ->where('slug', $slug)
        ->where('status', ServiceStatus::PUBLISHED->value)
        ->where('published_at', '<=', now())
        ->firstOrFail();

    }

    public function render()
    {
        return view('services::livewire.service-show', [
            'service' => $this->service,
        ]);
    }
}

