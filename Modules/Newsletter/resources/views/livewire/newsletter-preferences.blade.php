<div class="p-4 dark:bg-neutral-900 rounded-xl max-w-xl">
    {{-- <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Newsletter Preferences</h2> --}}

    <!-- Subscription History -->
    <div class="dark:bg-neutral-900">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">Subscription History</h3>
        @if($subscriptionDate)
            <p class="text-gray-700 dark:text-white">You subscribed on {{ $subscriptionDate->format('F j, Y \a\t H:i') }}</p>
        @else
            <p class="text-gray-700 dark:text-white">You have not subscribed yet.</p>
        @endif
    </div>

    <p class="text-gray-700 dark:text-white py-4">
        @if($subscribed)
            <x-heroicon-o-check-circle class="w-5 h-5 inline mr-2 text-green-500" />
            You are currently subscribed to our newsletter. You will receive updates, news, and exclusive content.
        @else
            <x-heroicon-o-x-circle class="w-5 h-5 inline mr-2 text-red-500" />
            You are not subscribed to our newsletter. Subscribe to stay informed!
        @endif
    </p>

    @if ($subscribed && $subscriptionDate)
    <p class="text-base text-gray-700 dark:text-white mt-2 py-2">
        Subscribed on {{ $subscriptionDate->format('F j, Y \a\t H:i') }}
    </p>
    @endif

    <button wire:click="toggleSubscription"
    class="px-4 py-2 rounded-md font-semibold transition
    {{ $subscribed ? 'bg-red-600 text-white hover:bg-red-700' : 'bg-green-600 text-white hover:bg-green-700' }} flex items-center justify-center gap-2">

    @if ($subscribed)
        <x-heroicon-o-x-circle class="w-5 h-5 text-white" />
        Unsubscribe
    @else
        <x-heroicon-o-check-circle class="w-5 h-5 text-white" />
        Subscribe
    @endif
</button>

</div>
