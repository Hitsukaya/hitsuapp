<?php

namespace Modules\Newsletter\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscribed extends Mailable
{
    use SerializesModels;

    public $content;
    public $unsubscribeUrl;

    public function __construct($content)
    {
        // $this->content = $content;
        // $this->unsubscribeUrl = route('newsletter.unsubscribe', ['email' => $content['email']]);

        $name = $content['name']  ?? null;
        $email = $content['email'] ?? null;
        $token = $content['token'] ?? null;

        $this->unsubscribeUrl = route('newsletter.unsubscribe', [
            'email' => $email,
            'token' => $token,
        ]);
    }

    public function build()
    {
        return $this->markdown('newsletter::emails.newsletter')
            ->subject($this->content['title'] ?? 'Newsletter')
            ->replyTo($this->content['email'], $this->content['name'] ?? null)
            ->with([
                'content' => $this->content,
                'unsubscribeUrl' => $this->unsubscribeUrl,
            ]);
    }
}

