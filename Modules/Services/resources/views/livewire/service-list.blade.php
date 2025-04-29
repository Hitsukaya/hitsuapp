<section class="bg-gray-100 dark:bg-neutral-900 p-4">
    <div class="grid mt-16 py-4">
        <div class="container mx-auto px-4 text-center">
            <p class="antialiased font-sans leading-relaxed text-inherit inline-flex text-xs rounded-lg border-[1.5px] border-blue-gray-50 bg-white text-black  py-1 lg:px-4 px-1 font-medium text-primary">
                Innovative Services for the Modern World
            </p>
            <h1 class="block antialiased tracking-normal font-sans font-semibold text-blue-gray-900 mx-auto my-6 w-full leading-snug !text-2xl lg:max-w-3xl lg:!text-5xl tex-black dark:text-white">
                From strategy to execution, we provide
                <span class="text-green-500 leading-snug">personalized services</span> to
                <span class="leading-snug text-green-500">match your goals</span>.
            </h1>
            <p class="block antialiased font-sans font-normal leading-relaxed text-inherit mx-auto w-full text-black dark:text-white lg:text-lg text-base">
                Embrace your unique brilliance. Stand out with vibrant solutions that make a difference.
            </p>

            {{-- <div class="mt-8 grid w-full place-items-start md:justify-center">
                <div class="mb-2 flex w-full flex-col gap-4 md:flex-row">

                </div>
            </div> --}}
        </div>

        <div
        x-data="{
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
        }"
        x-init="init"
        @mouseenter="stopAutoplay"
        @mouseleave="startAutoplay"
        class="relative overflow-hidden w-full bg-gray-100 dark:bg-neutral-900 py-12"
    >
        <div
            x-ref="cards"
            class="flex gap-6 overflow-x-auto px-6 scroll-smooth snap-x snap-mandatory scrollbar-hide"
        >
            @foreach ($services as $service)
                <div
                    class="relative min-w-[250px] max-w-[250px] bg-white dark:bg-neutral-800 rounded-2xl shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out snap-center flex-shrink-0"
                >
                    @if ($service->cover_image)
                        <a href="{{ route('services.show', $service->slug) }}">
                            <img
                                src="{{ Storage::url($service->cover_image) }}"
                                alt="{{ $service->title }}"
                                loading="lazy"
                                onerror="this.src='/images/fallback.jpg'"
                                class="rounded-t-2xl w-full h-[150px] object-cover"
                            />
                        </a>
                    @endif

                    <div class="p-4">
                        <a href="{{ route('services.show', $service->slug) }}">
                            <h3 class="text-lg font-bold line-clamp-2 text-gray-900 dark:text-white">{{ $service->title }}</h3>
                        </a>

                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 mb-2">
                            @if($service->categories->isNotEmpty())
                                @foreach($service->categories as $category)
                                    <a
                                        href="{{ route('services.category', ['slug' => $category->slug]) }}"
                                        class="text-blue-600 dark:text-blue-400 hover:underline"
                                    >
                                        <span class="font-medium text-black dark:text-white">Category:</span> {{ $category->name }}
                                    </a>
                                @endforeach
                            @else
                                <span class="text-black dark:text-white font-medium">Category:</span> No category
                            @endif
                            <span class="block mt-1 text-xs text-gray-500 dark:text-gray-400"> {{ \Carbon\Carbon::parse($service->created_at)->format('F j, Y') }}</span>
                        </p>

                        <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-3">
                            {{ Str::limit($service->body_small, 100) }}
                        </p>

                        <a
                            href="{{ route('services.show', $service->slug) }}"
                            class="mt-2 inline-block text-blue-600 dark:text-blue-400 text-sm hover:underline"
                        >
                            {{ $service->button_text ?? 'More' }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Scroll left --}}
        <button
            @click="scroll.scrollBy({ left: -300, behavior: 'smooth' })"
            aria-label="Scroll left"
            role="button"
            class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white dark:bg-neutral-800 dark:hover:bg-neutral-700 shadow rounded-full p-2 transition"
        >
            ‹
        </button>

        {{-- Scroll right --}}
        <button
            @click="scroll.scrollBy({ left: 300, behavior: 'smooth' })"
            aria-label="Scroll right"
            role="button"
            class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white dark:bg-neutral-800 dark:hover:bg-neutral-700 shadow rounded-full p-2 transition"
        >
            ›
        </button>
    </div>


</div>
</section>
