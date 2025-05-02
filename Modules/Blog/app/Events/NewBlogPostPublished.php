<?php

namespace Modules\Blog\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Blog\Entities\BlogPost;

class NewBlogPostPublished
{
    use Dispatchable, SerializesModels;

    public BlogPost $post;

    public function __construct(BlogPost $post)
    {
        $this->post = $post;
    }
}
