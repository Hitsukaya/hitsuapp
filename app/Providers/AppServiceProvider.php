<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('services.service-list', \Modules\Services\Http\Livewire\ServiceList::class);
        Livewire::component('blog.blog-post-list', \Modules\Blog\Http\Livewire\BlogPostList::class);
        Livewire::component('newsletter.newsletter-subscription', \Modules\Newsletter\Http\Livewire\NewsletterSubscription::class);
        Livewire::component('newsletter.newsletter-unsubscribe', \Modules\Newsletter\Http\Livewire\NewsletterUnsubscribe::class);
        Livewire::component('newsletter.newsletter-preferences', \Modules\Newsletter\Http\Livewire\NewsletterPreferences::class);

    }
}
