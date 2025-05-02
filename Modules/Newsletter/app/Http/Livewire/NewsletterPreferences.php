<?php

namespace Modules\Newsletter\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Modules\Newsletter\Entities\Subscription;

class NewsletterPreferences extends Component
{
    public $subscribed;
    public $subscriptionDate;

    public function mount()
    {
        $email = Auth::user()->email;

        $subscription = Subscription::where('email', $email)->first();

        $this->subscribed = $subscription ? !$subscription->unsubscribed : false;
        $this->subscriptionDate = $subscription?->created_at;
    }

    public function toggleSubscription()
    {
        $email = Auth::user()->email;

        $subscription = Subscription::firstOrCreate(
            ['email' => $email],
            ['name' => Auth::user()->name, 'token' => Str::random(60)]
        );

        $subscription->unsubscribed = !$subscription->unsubscribed;
        $subscription->save();

        $this->subscribed = !$subscription->unsubscribed;
        $this->subscriptionDate = $subscription->created_at;
    }

    public function render()
    {
        return view('newsletter::livewire.newsletter-preferences');
    }
}
