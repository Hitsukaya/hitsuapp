<section class="bg-gray-100 dark:bg-neutral-900 p-4">
    <div class="grid mt-16 py-4">
        <div class="container mx-auto px-4 text-center">
            <p class="antialiased font-sans leading-relaxed text-inherit inline-flex text-xs rounded-lg border-[1.5px] border-blue-gray-50 bg-white text-black  py-1 lg:px-4 px-2 font-medium text-primary">
                Stay Ahead of the Curve
            </p>
            <h1 class="block antialiased tracking-normal font-sans font-semibold text-blue-gray-900 mx-auto my-6 w-full leading-snug text-2xl lg:max-w-4xl lg:!text-5xl text-black dark:text-white">
                Build Smarter with Hitsukaya
            </h1>
            <p class="block antialiased font-sans font-normal leading-relaxed text-inherit mx-auto w-full text-black dark:text-white lg:text-lg text-base">
                Stay updated with our latest work, tips, and tools.<br>
                One email. Real value. No noise.
            </p>
        </div>

<div class="bg-gray-100 dark:bg-neutral-900">
    <div class="rounded bg-gray-100 dark:bg-neutral-900 py-10 px-4 sm:py-16 sm:px-4 lg:flex lg:items-center lg:p-20">
      <div class="lg:w-0 lg:flex-1">
        <h2 class="text-3xl font-bold tracking-tight text-black dark:text-white">Join our newsletter</h2>
        <p class="mt-4 max-w-3xl text-lg text-gray-800 dark:text-white">
            Be part of a growing community of creators, founders, and developers.
            Get updates on our latest projects, tech insights, design tips, and exclusive tools to help you build smarter.
        </p>
      </div>
      <div class="mt-12 sm:w-full sm:max-w-md lg:mt-0 lg:ml-8 lg:flex-1">
        <form wire:submit.prevent="subscribe" class="sm:flex space-y-2">

          <label for="name" class="sr-only">Name</label>
          @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

          <label for="email-address" class="sr-only">Email address</label>
          @error('email') <span class="text-red-500">{{ $message }}</span> @enderror

          <input type="text" wire:model="name" class="w-full rounded-md sm:mr-3 border-black dark:border-white px-5 py-3 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-700" placeholder="Your name">

          <input type="email" wire:model="email" class="w-full rounded-md border-black dark:border-white px-5 py-3 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-700" placeholder="Your email">

          <button type="submit" class="mt-3 flex w-full items-center justify-center rounded-md border border-transparent bg-red-600 px-5 py-3 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-700 sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0">Subscribe</button>

        </form>
        <p class="mt-3 text-sm text-gray-800 dark:text-white">
          We care about the protection of your data. Read our
          <a href="" class="font-medium text-black dark:text-red-600 underline">Privacy Policy.</a>
        </p>
      </div>
    </div>
  </div>


</div>
</div>
</section>

