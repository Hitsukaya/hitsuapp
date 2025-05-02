<?php

namespace Modules\Newsletter\Http\Livewire;

use Livewire\Component;
use Modules\Newsletter\Entities\Subscription;

class NewsletterUnsubscribe extends Component
{
    public $message;

    public function mount()
    {
        $this->checkSubscriptionStatus();
    }

    public function checkSubscriptionStatus()
    {
        $subscription = Subscription::where('email', auth()->user()->email)->first();

        if ($subscription && $subscription->unsubscribed) {
            $this->message = 'You are already unsubscribed.';
        } else {
            $this->message = '';
        }
    }

    public function unsubscribe()
    {
        $subscription = Subscription::where('email', auth()->user()->email)->first();

        if ($subscription && !$subscription->unsubscribed) {
            $subscription->unsubscribed = true;
            $subscription->save();
            $this->message = 'You have successfully unsubscribed.';
        } else {
            $this->message = 'You are already unsubscribed or no subscription found.';
        }
    }

    public function render()
    {
        return view('newsletter::livewire.newsletter-unsubscribe');
    }
}


