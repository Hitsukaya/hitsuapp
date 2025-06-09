<?php

namespace Modules\Newsletter\Listeners;

use Modules\Blog\Events\NewBlogPostPublished;
use Modules\Newsletter\Entities\Subscription;
use Modules\Newsletter\Mail\NewBlogPostNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendNewsletterOnNewBlogPost
{
    public function handle(NewBlogPostPublished $event)
    {
        $post = $event->post;

        $url = url('/blog/' . $post->slug);
        $content = [
            'title'       => '📢 ' . $post->title,
            'body'        => $post->body_small ?? 'Check out our latest blog post!',
            'url'         => url('/blog/' . $post->slug),
            'cover_image' => $post->cover_image ? Storage::url($post->cover_image) : null,
            'author'      => $post->user->name ?? 'Unknown',
            'published_at'=> $post->created_at ? $post->created_at->format('F j, Y') : null,
        ];

        foreach (Subscription::all() as $subscriber) {
            Mail::to($subscriber->email)->send(new NewBlogPostNotification($content));
        }
    }
}
