<section>
    <div class="bg-gray-100 dark:bg-neutral-950 font-sans text-center">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col justify-center items-center my-16">
                <h1 class="text-5xl font-extrabold mb-4 dark:text-white">Category: <span class="text-red-600">{{ $category->name }}</span></h1>
                <p class="text-lg mb-6 dark:text-white">Explore our services in this category and find the best solutions for your needs.</p>
                <a href="{{ route('home') }}" class="inline-block bg-transparent border-2 border-black text-red-500  hover:bg-white dark:border-white dark:text-red-500 py-2 px-6 rounded-full dark:hover:bg-white hover:text-gray-800 transition duration-300">Back to Home</a>

            </div>
        </div>
    </div>


@if($services->isEmpty())
<p class="text-gray-600">No services available for this category.</p>
@else
<div x-data="{
    scroll: $refs.cards,
    interval: null,
    startAutoplay() {
        this.interval = setInterval(() => {
            this.scroll.scrollBy({ left: 300, behavior: 'smooth' });
        }, 3000);
    },
    stopAutoplay() {
        clearInterval(this.interval);
    },
    init() {
        this.startAutoplay();
    }
}" x-init="init" @mouseenter="stopAutoplay" @mouseleave="startAutoplay" class="relative overflow-hidden w-full bg-gray-100 dark:bg-neutral-950 py-8">
    <div x-ref="cards" class="flex gap-6 overflow-x-auto px-6 scroll-smooth snap-x snap-mandatory">

        @foreach($services as $service)
            <div class="relative min-w-[250px] max-w-[250px] bg-white rounded-2xl shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out snap-center flex-shrink-0">

                @if ($service->cover_image)
                    <a href="{{ route('services.show', $service->slug) }}">
                        <img src="{{ Storage::url($service->cover_image) }}" alt="{{ $service->title }}" class="rounded-t-2xl w-full h-[150px] object-cover" />
                    </a>
                @endif

                <div class="p-4">
                    <a href="{{ route('services.show', $service->slug) }}">
                        <h3 class="text-lg font-bold">{{ $service->title }}</h3>
                    </a>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        @if($service->categories->isNotEmpty())
                            @foreach($service->categories as $category)
                                <a href="{{ route('services.category', ['slug' => $category->slug]) }}" class="dark:text-blue-500">
                                    <span class="text-black">Category:</span> {{ $category->name }}
                                </a>
                            @endforeach
                        @else
                            <span class="text-black">Category:</span> No category
                        @endif
                        <span class="text-black px-2 gap-2"> {{ \Carbon\Carbon::parse($service->created_at)->format('F j, Y') }}</span>
                    </p>
                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($service->body_small, 100) }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="text-blue-600 text-sm hover:underline">{{ $service->button_text ?? 'More' }}</a>
                </div>
            </div>
        @endforeach
    </div>

    <button @click="scroll.scrollBy({ left: -300, behavior: 'smooth' })"
        class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white shadow rounded-full p-2 transition">
        ‹
    </button>
    <button @click="scroll.scrollBy({ left: 300, behavior: 'smooth' })"
        class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white shadow rounded-full p-2 transition">
        ›
    </button>
</div>
@endif
</section>
