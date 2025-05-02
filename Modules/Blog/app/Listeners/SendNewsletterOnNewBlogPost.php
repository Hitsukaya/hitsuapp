<?php

namespace Modules\Newsletter\Listeners;

use Modules\Blog\Events\NewBlogPostPublished;
use Modules\Newsletter\Entities\Subscription;
use Modules\Newsletter\Jobs\SendNewsletterEmail;

class SendNewsletterOnNewBlogPost
{
    public function handle(NewBlogPostPublished $event)
    {
        $post = $event->post;

        $url = url('/blog/' . $post->slug);
        $content = [
            'title' => '📰 ' . $post->title,
            'body'  => $post->body_small ?? 'Check out our latest blog post!',
            'url'   => $url,
        ];

        foreach (Subscription::all() as $subscriber) {
            SendNewsletterEmail::dispatch($subscriber->email, $content);
        }
    }
}
