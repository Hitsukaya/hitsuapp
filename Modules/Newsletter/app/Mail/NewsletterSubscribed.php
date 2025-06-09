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

        $email = $content['email'] ?? null;
        $token = $content['token'] ?? null;

        $this->unsubscribeUrl = route('newsletter.unsubscribe', [
            'email' => $email,
            'token' => $token,
        ]);
    }

    public function build()
    {
        return $this->view('newsletter::emails.newsletter')
                    ->with([
                        'content' => $this->content,
                        'unsubscribeUrl' => $this->unsubscribeUrl,
                    ]);
    }
}

