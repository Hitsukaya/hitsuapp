<?php

namespace Modules\Newsletter\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\Newsletter\Entities\Subscription;
use Modules\Newsletter\Mail\NewsletterSubscribed;

class SendNewsletterEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $subscriberEmail;
    public $content;

    public function __construct($email, $content)
    {
        $this->subscriberEmail = $email;
        $this->content = $content;
    }

    public function handle()
    {
        Mail::to($this->subscriberEmail)->send(new NewsletterSubscribed($this->content));
    }
}
