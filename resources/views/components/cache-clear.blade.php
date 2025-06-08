@if(auth()->user()->role === 'ADMIN' || auth()->user()->role === 'EDITOR')
    <div x-data="{
        message: '',
        clearCache() {
            fetch('{{ route('cache.clear') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                this.message = data.message;
            })
            .catch(() => {
                this.message = 'A apărut o eroare.';
            });
        }
    }">
        <button
            @click="clearCache()"
            class="px-4 py-2 bg-red-600 text-white rounded-md  hover:bg-red-700"
        >
            Clear Cache
        </button>

        <div
            x-show="message"
            x-text="message"
            class="mt-4 font-medium text-sm text-green-600"
        ></div>
    </div>
@endif

