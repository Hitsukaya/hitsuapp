<div class="max-w-xl mx-auto p-6 bg-gray-100 dark:bg-neutral-900 rounded-2xl  border-gray-200">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
        ❌ Unsubscribe from HITSUKAYA
    </h2>

    @if ($message)
        <p class="text-green-600 font-medium mb-2">
            {{ $message }}
        </p>
    @else
        <p class="text-gray-700 dark:text-white mb-4">
            We’re sorry to see you go. By unsubscribing, you’ll stop receiving all future updates, offers, and news from HITSUKAYA. If you change your mind, you can always resubscribe later from your account.
        </p>

        <button
            wire:click="unsubscribe"
            wire:loading.attr="disabled"
            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 flex items-center gap-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span wire:loading.remove>Unsubscribe</span>
            <span wire:loading>Processing...</span>
        </button>
    @endif
</div>


