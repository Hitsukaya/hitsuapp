<?php

use Illuminate\Support\Facades\Route;
use Modules\Newsletter\Entities\Subscription;
use Modules\Newsletter\Http\Controllers\NewsletterController;
use Modules\Newsletter\Http\Livewire\NewsletterSubscription;
use Modules\Newsletter\Http\Livewire\NewsletterUnsubscribe;

Route::get('/newsletter', NewsletterSubscription::class)->name('newsletter');
Route::get('/send-newsletter', [NewsletterController::class, 'sendNewsletter']);

// Route::get('newsletter/unsubscribe/{email}', function ($email) {
//     $subscriber = Subscription::where('email', $email)->first();

//     if ($subscriber) {
//         $subscriber->delete();
//         return response()->json(['message' => 'You have been unsubscribed successfully.']);
//     }

//     return response()->json(['message' => 'Subscriber not found.'], 404);
// })->name('newsletter.unsubscribe');

Route::get('/unsubscribe/{email}/{token}', [NewsletterUnsubscribe::class, 'unsubscribe'])->name('newsletter.unsubscribe');

