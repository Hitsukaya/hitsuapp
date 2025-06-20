<?php

namespace Modules\Newsletter\Listeners;

use Modules\Blog\Events\NewBlogPostPublished;
use Modules\Newsletter\Entities\Subscription;
use Modules\Newsletter\Jobs\SendNewsletterEmail;
use Illuminate\Support\Facades\Storage;

class SendNewsletterOnNewBlogPost
{
    public function handle(NewBlogPostPublished $event)
    {
        $post = $event->post;

        $post->load('user', 'categories', 'tags');

        \Log::info('Cover image:', [$post->cover_image]);
        \Log::info('Author:', [$post->user ? $post->user->name : 'No user']);

        $content = [
            'title'       => '📢 ' . $post->title,
            'body'        => $post->body_small ?? 'Check out our latest blog post!',
            'url'         => url('/blog/' . $post->slug),
            'cover_image' => $post->cover_image ? Storage::url($post->cover_image) : null,
            'author'      => $post->user->name ?? 'Unknown',
            'published_at'=> $post->created_at ? $post->created_at->format('F j, Y') : null,
        ];

        Subscription::chunk(100, function ($subscribers) use ($content) {
            foreach ($subscribers as $subscriber) {
                SendNewsletterEmail::dispatch($subscriber->email, $content);
            }
        });
    }
}
