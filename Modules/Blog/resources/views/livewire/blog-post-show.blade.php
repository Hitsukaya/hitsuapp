    @section('meta_title', $post->meta_title ?? $post->title)
    @section('meta_description', $post->meta_description ?? Str::limit(strip_tags($post->body_small), 160))
<section class="py-6">
<div class="max-w-5xl mx-auto px-6 py-10 bg-white dark:bg-neutral-800 rounded-3xl shadow-2xl transition-all duration-300">
    @if ($post->cover_image)
        <div class="overflow-hidden rounded-2xl mb-6">
            <img src="{{ Storage::url($post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover transition duration-300 hover:scale-105 rounded-xl shadow-lg">
        </div>
    @endif

    <h1 class="text-4xl font-extrabold text-center text-gray-900 dark:text-gray-100 mb-3 tracking-tight">
        {{ $post->title }}
    </h1>

    <h2 class="text-3xl font-extrabold text-center text-gray-900 dark:text-gray-100 mb-3 tracking-tight">
        {{ $post->sub_title }}
    </h2>

    <p class="text-sm text-gray-600 dark:text-gray-400 mb-8 flex flex-wrap justify-center items-center gap-3 text-center">
        <!-- Categorii -->
        @if($post->categories->isNotEmpty())
            @foreach($post->categories as $category)
                <span class="font-semibold dark:text-white">
                    #
                    <a href="{{ route('blog.category', ['category' => $category]) }}" class="dark:text-blue-500">
                        {{ $category->name }}
                    </a>
                </span>
            @endforeach
        @else
            <span class="font-semibold dark:text-white">Category:</span> No category
        @endif

        <!-- Tags -->
        @foreach ($post->tags as $tag)

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 dark:fill-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
            </svg>

            <a href="{{ route('blog.tag', ['slug' => $tag->slug]) }}" class="dark:text-blue-500">
                {{ $tag->name }}
            </a>

        @endforeach

        <!-- Data și user pe aceeași linie -->
        <div class="flex items-center gap-2 justify-center text-center">
            <span class="font-semibold dark:text-white px-2 inline-flex items-center gap-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y') }}
            </span>

            <!-- Profilul utilizatorului pe aceeași linie -->
            <div class="flex items-center space-x-2 justify-center">
                <img class="h-8 w-8 overflow-hidden rounded-full border-4 border-white bg-zinc-300 object-cover text-[0] ring-1 ring-slate-300" src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}">
                <span title="{{ $post->user->name }}" class="max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap font-semibold text-black dark:text-white">
                    {{ $post->user->name }}
                </span>
            </div>
        </div>
    </p>
    <div class="tiptap-content">
        {!! $post->body_full !!}
    </div>
</div>
</section>
