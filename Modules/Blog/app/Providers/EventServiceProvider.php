<?php

namespace Modules\Blog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [

        \Modules\Blog\Events\BlogPublished::class => [
            \Modules\Blog\Listeners\ScheduleBlogPublication::class,
        ],

        \Modules\Blog\Events\NewBlogPostPublished::class => [
            \Modules\Newsletter\Listeners\SendNewsletterOnNewBlogPost::class,
        ],

    ];

    public function boot(): void
    {
        parent::boot();
    }


    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     */
    protected function configureEmailVerification(): void {}
}
