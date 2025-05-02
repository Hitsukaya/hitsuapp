<?php

namespace Modules\Blog\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Blog\Entities\BlogPost;

class BlogPublished
{
    use Dispatchable, SerializesModels;

    public function __construct(public BlogPost $service)
    {
        //
    }
}
