<section>
    <div class="bg-gray-100 dark:bg-neutral-900 font-sans text-center">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col justify-center items-center my-16">
                <h1 class="text-5xl font-extrabold mb-4 dark:text-white">Tag: <span class="text-red-600">{{ $tag->name }}</span></h1>
                <p class="text-lg mb-6 dark:text-white">Explore our blog in this category and find the best solutions for your needs.</p>
                <a href="{{ route('home') }}" class="inline-block bg-transparent border-2 border-black text-red-500  hover:bg-white dark:border-white dark:text-red-500 py-2 px-6 rounded-full dark:hover:bg-white hover:text-gray-800 transition duration-300">Back to Home</a>

            </div>
        </div>
    </div>

@if($tag->posts->isEmpty())
    <p class="text-gray-600">No posts available for this tag.</p>
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
    }" x-init="init" @mouseenter="stopAutoplay" @mouseleave="startAutoplay" class="relative overflow-hidden w-full bg-gray-100 dark:bg-neutral-900 py-8">
        <div x-ref="cards" class="flex gap-6 overflow-x-auto px-6 scroll-smooth snap-x snap-mandatory">
            @foreach($tag->posts as $post)  <!-- Modificat pentru a folosi tag->posts -->
                <div class="relative min-w-[250px] max-w-[250px] bg-white dark:bg-neutral-800 rounded-2xl shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out snap-center flex-shrink-0">
                    @if ($post->cover_image)
                        <a href="{{ route('blog.show', $post->slug) }}">
                            <img src="{{ Storage::url($post->cover_image) }}" alt="{{ $post->title }}" class="rounded-t-2xl w-full h-[150px] object-cover" />
                        </a>
                    @endif

                    <div class="p-4">
                        <a href="{{ route('blog.show', $post->slug) }}">
                            <h3 class="text-lg font-bold dark:text-red-600">{{ $post->title }}</h3>
                        </a>

                        <p class="text-sm text-gray-600 dark:text-gray-400 flex justify-between items-center">
                            <span class="text-black dark:text-white">
                                {{ $post->user->name }}
                            </span>
                            <span class="text-black dark:text-white px-2 gap-2">
                                {{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y') }}
                            </span>
                        </p>

                        <p class="text-sm text-gray-600 dark:text-white mb-2">{{ Str::limit($post->body_small, 100) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="text-blue-600 text-sm hover:underline">{{ $post->button_text ?? 'More' }}</a>
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
