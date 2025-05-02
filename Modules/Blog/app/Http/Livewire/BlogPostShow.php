<?php

namespace Modules\Blog\Http\Livewire;

use Livewire\Component;
use Modules\Blog\Entities\BlogPost;

class BlogPostShow extends Component
{
    public $post;

    public function mount($slug)
    {
        $this->post = BlogPost::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('blog::livewire.blog-post-show');
    }
}
