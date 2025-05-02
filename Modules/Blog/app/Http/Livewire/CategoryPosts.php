<?php

namespace Modules\Blog\Http\Livewire;

use Livewire\Component;
use Modules\Blog\Entities\BlogCategory;

class CategoryPosts extends Component
{
    public BlogCategory $category;

    public function mount(BlogCategory $category)
    {
        $this->category = $category->load([
            'posts' => fn ($query) => $query->with(['user', 'categories'])->published()
        ]);
    }

    public function render()
    {
        return view('blog::livewire.category-posts');
    }
}
