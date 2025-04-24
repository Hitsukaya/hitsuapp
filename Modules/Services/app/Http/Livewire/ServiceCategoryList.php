<?php

namespace Modules\Services\Http\Livewire;

use Livewire\Component;
use Modules\Services\Entities\ServiceCategory;
use Modules\Services\Enums\ServiceStatus;

class ServiceCategoryList extends Component
{
    public $category;
    public $services;

    protected $listeners = ['statusUpdated'];

    public function mount($slug)
    {
        $this->category = ServiceCategory::where('slug', $slug)->firstOrFail();

        $this->services = $this->category->services;

        $this->services = $this->category
                ->services()
                ->where('status', ServiceStatus::PUBLISHED->value)
                ->where('published_at', '<=', now())
                ->get();
    }

    public function statusUpdated($serviceId, $newStatus)
    {
        $service = $this->services->firstWhere('id', $serviceId);

        if ($service) {
            $service->status = $newStatus;
        }
    }

    public function render()
    {
        return view('services::livewire.service-category-list', [
            'category' => $this->category,
            'services' => $this->services,
        ]);
    }
}

