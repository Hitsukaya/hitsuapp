<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Livewire\BlogPostList;
use Modules\Blog\Http\Livewire\BlogPostShow;
use Modules\Blog\Http\Livewire\BlogTagPosts;
use Modules\Blog\Http\Livewire\CategoryPosts;



Route::get('blog', BlogPostList::class)->name('blog.index');
Route::get('blog/{slug}', BlogPostShow::class)->name('blog.show');
Route::get('/category/{category:slug}', CategoryPosts::class)->name('blog.category');
Route::get('/tag/{slug}', BlogTagPosts::class)->name('blog.tag');


