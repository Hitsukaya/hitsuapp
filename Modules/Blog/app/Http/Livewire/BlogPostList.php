<?php

namespace Modules\Blog\Http\Livewire;

use Livewire\Component;
use Modules\Blog\Entities\BlogPost;

class BlogPostList extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = BlogPost::published()->get();
    }

    public function render()
    {
        return view('blog::livewire.blog-post-list');
    }
}
