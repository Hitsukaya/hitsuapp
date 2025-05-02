<?php

namespace Modules\Newsletter\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Newsletter\Jobs\SendNewsletterEmail;
use Modules\Newsletter\Entities\Subscription;
use Illuminate\Routing\Controller;

class NewsletterController extends Controller
{
    public function sendNewsletter(Request $request)
    {
        $content = [
            'title' => 'Latest News!',
            'body' => 'This is a test message for the newsletter.'
        ];

        $subscribers = Subscription::all();

        foreach ($subscribers as $subscriber) {
            SendNewsletterEmail::dispatch($subscriber->email, $content);
        }

        return redirect()->back()->with('message', 'Newsletter-ul a fost trimis!');
    }
}
