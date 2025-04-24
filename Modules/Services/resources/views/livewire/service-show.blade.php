<div class="max-w-5xl mx-auto px-6 py-10 bg-white dark:bg-neutral-950 rounded-3xl shadow-2xl transition-all duration-300">
    @if ($service->cover_image)
        <div class="overflow-hidden rounded-2xl mb-6">
            <img src="{{ Storage::url($service->cover_image) }}" alt="{{ $service->title }}"
                 class="w-full h-auto object-cover transition duration-300 hover:scale-105 rounded-xl shadow-lg">
        </div>
    @endif

    <h1 class="text-4xl font-extrabold text-center text-gray-900 dark:text-gray-100 mb-3 tracking-tight">
        {{ $service->title }}
    </h1>

    <p class="text-sm text-gray-600 dark:text-gray-400 mb-8 flex justify-center items-center gap-x-2">
        @if($service->categories->isNotEmpty())
            @foreach($service->categories as $category)
                <a href="{{ route('services.category', ['slug' => $category->slug]) }}" class="dark:text-blue-500">
                    <span class="font-semibold dark:text-white">Category:</span> {{ $category->name }}
                </a>
            @endforeach
        @else
            <span class="font-semibold dark:text-white">Category:</span> No category
        @endif
        <span class="font-semibold dark:text-white px-2 gap-2">Published on: {{ \Carbon\Carbon::parse($service->created_at)->format('F j, Y') }}</span>
    </p>

    <div class="tiptap-content">
        {!! $service->body_full !!}
    </div>
</div>
