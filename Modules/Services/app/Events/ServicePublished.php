<?php

namespace Modules\Services\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Services\Entities\Service;

class ServicePublished
{
    use Dispatchable, SerializesModels;

    public function __construct(public Service $service)
    {
        //
    }
}
