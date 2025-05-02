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
        $this->content = $content;
        $this->unsubscribeUrl = route('newsletter.unsubscribe', ['email' => $content['email']]);
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

