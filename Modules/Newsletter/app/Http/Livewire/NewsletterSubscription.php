<?php

namespace Modules\Newsletter\Http\Livewire;


use Illuminate\Support\Str;
use Livewire\Component;
use Modules\Newsletter\Entities\Subscription;
use Modules\Newsletter\Jobs\SendNewsletterEmail;

class NewsletterSubscription extends Component
{
    public $email;
    public $name;

    protected $rules = [
        'email' => 'required|email|unique:subscriptions,email',
        'name' => 'nullable|string|max:255',
    ];

    public function subscribe()
    {
        $this->validate();

        $subscription = Subscription::create([
            'email' => $this->email,
            'name' => $this->name,
            'token' => Str::random(60),
        ]);

        $content = [
            'name' => $this->name,
            'email' => $this->email,
            'token' => $subscription->token,
        ];

        SendNewsletterEmail::dispatch($this->email, $content);

        session()->flash('message', 'Successfully subscribed to the newsletter!');
        $this->reset('email', 'name');
    }


    public function render()
    {
        return view('newsletter::livewire.newsletter-subscription');
    }
}



