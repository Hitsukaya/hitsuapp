<section class="bg-gray-100 dark:bg-neutral-900 p-4">
    <div class="grid mt-16 py-4">
        <div class="container mx-auto px-4 text-center">
            <p class="antialiased font-sans leading-relaxed text-inherit inline-flex text-xs rounded-lg border-[1.5px] border-blue-gray-50 bg-white text-black  py-1 lg:px-4 px-1 font-medium text-primary">
                Welcome to Our Blog
            </p>
            <h1 class="block antialiased tracking-normal font-sans font-semibold text-blue-gray-900 mx-auto my-6 w-full leading-snug text-2xl lg:max-w-4xl lg:!text-5xl text-black dark:text-white">
                Discover stories, ideas, and knowledge
                <span class="text-green-500 leading-snug">from people who are passionate about technology,</span> design,
                <span class="leading-snug text-green-500">and creative thinking</span>.

            </h1>
            <p class="block antialiased font-sans font-normal leading-relaxed text-inherit mx-auto w-full text-black dark:text-white lg:text-lg text-base">
                Whether you're here to learn, explore, or just get inspired — you're in the right place.
            </p>
        </div>

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
            }" x-init="init" @mouseenter="stopAutoplay" @mouseleave="startAutoplay" class="relative overflow-hidden w-full bg-gray-100 dark:bg-neutral-900 py-12">
                <div x-ref="cards" class="flex gap-6 overflow-x-auto px-6 scroll-smooth snap-x snap-mandatory">
                    @foreach($posts as $post)
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

                                <p class="text-sm text-gray-600 dark:text-gray-400 flex justify-center items-center gap-x-2">
                                    @if($post->categories->isNotEmpty())
                                        @foreach($post->categories as $category)
                                        <a href="{{ route('blog.category', ['category' => $category->slug]) }}" class="dark:text-blue-500">
                                                <span class="text-black dark:text-white">#</span> {{ $category->name }}
                                            </a>
                                        @endforeach
                                    @else
                                        <span class="text-black dark:text-white">#</span> No category
                                    @endif

                                    @foreach ($post->tags as $tag)

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 dark:fill-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                        </svg>

                                        <a href="{{ route('blog.tag', ['slug' => $tag->slug]) }}" class="dark:text-blue-500">
                                            {{ $tag->name }}
                                        </a>

                                    @endforeach

                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 flex justify-center items-center">
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
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white dark:bg-neutral-800 shadow rounded-full p-2 transition">
                    ‹
                </button>
                <button @click="scroll.scrollBy({ left: 300, behavior: 'smooth' })"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white dark:bg-neutral-800 shadow rounded-full p-2 transition">
                    ›
                </button>
            </div>




        </div>
    </div>
</section>

