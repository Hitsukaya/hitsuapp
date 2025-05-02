<?php

namespace Modules\Blog\Http\Livewire;

use Livewire\Component;
use Modules\Blog\Entities\BlogTag;

class BlogTagPosts extends Component
{
    public BlogTag $tag;

    public function mount($slug)
    {
        $this->tag = BlogTag::where('slug', $slug)->firstOrFail();
        $this->tag->load('posts');
    }

    public function render()
    {
        return view('blog::livewire.tag-posts', [
            'posts' => $this->tag->posts
        ]);
    }
}
