<x-layouts.app>

<!-- Hero -->
<section class="bg-gradient-to-b from-red-900 via-red-800 to-red-950 text-white py-28 px-6 text-center">
  <div class="max-w-4xl mx-auto">
    <h1 class="text-5xl font-extrabold mb-4">Hitsukaya Certified</h1>
    <p class="text-lg mb-8 max-w-xl mx-auto">A badge of honor for original, independent, and timeless work.</p>

    <!-- Pulsing Circle SVG with Alpine -->
    <div x-data="{ pulse: true }" x-init="setInterval(() => pulse = !pulse, 2000)" class="mx-auto mb-12">
      <svg :class="pulse ? 'opacity-100 scale-110' : 'opacity-60 scale-90'"
           class="w-24 h-24 mx-auto transition-all duration-1000" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="40" stroke="#f87171" stroke-width="5" />
        <circle cx="50" cy="50" r="30" stroke="#fb923c" stroke-width="3" />
      </svg>
    </div>

    <a href="#apply" class="inline-block bg-red-700 hover:bg-red-800 rounded-lg px-8 py-3 font-semibold transition">Apply Now</a>
  </div>
</section>

<!-- Info Cards -->
<section class="bg-red-50 py-20 px-6">
  <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 text-red-900">
    <div class="bg-white rounded-lg p-6 shadow hover:shadow-lg transition cursor-default flex flex-col items-center">
      <svg class="w-12 h-12 mb-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 20l9-5-9-5-9 5 9 5z" />
        <path d="M12 12v8" />
      </svg>
      <h3 class="font-semibold text-xl mb-2">Creativity</h3>
      <p class="text-sm text-red-700 text-center">We honor projects that bring innovative ideas to life.</p>
    </div>
    <div class="bg-white rounded-lg p-6 shadow hover:shadow-lg transition cursor-default flex flex-col items-center">
      <svg class="w-12 h-12 mb-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10" />
        <line x1="12" y1="8" x2="12" y2="12" />
        <line x1="12" y1="16" x2="12" y2="16" />
      </svg>
      <h3 class="font-semibold text-xl mb-2">Impact</h3>
      <p class="text-sm text-red-700 text-center">Projects that inspire and influence culture positively.</p>
    </div>
    <div class="bg-white rounded-lg p-6 shadow hover:shadow-lg transition cursor-default flex flex-col items-center">
      <svg class="w-12 h-12 mb-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="16" rx="2" ry="2" />
      </svg>
      <h3 class="font-semibold text-xl mb-2">Durability</h3>
      <p class="text-sm text-red-700 text-center">Built to last, with long-term value at its core.</p>
    </div>
    <div class="bg-white rounded-lg p-6 shadow hover:shadow-lg transition cursor-default flex flex-col items-center">
      <svg class="w-12 h-12 mb-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 6L9 17l-5-5" />
      </svg>
      <h3 class="font-semibold text-xl mb-2">Originality</h3>
      <p class="text-sm text-red-700 text-center">True uniqueness that stands apart from the crowd.</p>
    </div>
  </div>
</section>

<!-- Application Steps Timeline -->
<section class="bg-red-100 py-20 px-6">
  <div class="max-w-4xl mx-auto text-red-900">
    <h2 class="text-3xl font-bold mb-10 text-center">How to Apply</h2>
    <ol class="relative border-l border-red-400 ml-6 space-y-10">
      <li class="mb-10 ml-6">
        <span class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-red-700 rounded-full ring-4 ring-white text-white font-bold">1</span>
        <h3 class="mb-1 text-lg font-semibold">Submit your original project</h3>
        <p class="text-sm text-red-700">Provide detailed info and showcase your work’s uniqueness.</p>
      </li>
      <li class="mb-10 ml-6">
        <span class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-red-700 rounded-full ring-4 ring-white text-white font-bold">2</span>
        <h3 class="mb-1 text-lg font-semibold">Review by experts</h3>
        <p class="text-sm text-red-700">Our panel assesses based on clarity, impact, and durability.</p>
      </li>
      <li class="mb-10 ml-6">
        <span class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-red-700 rounded-full ring-4 ring-white text-white font-bold">3</span>
        <h3 class="mb-1 text-lg font-semibold">Receive certification</h3>
        <p class="text-sm text-red-700">Get your badge and share your achievement with the world.</p>
      </li>
    </ol>
  </div>
</section>

<!-- Testimonials Slider -->
<section x-data="{ current: 0, testimonials: [
  {name:'Aiko S.', role:'Artist', text:'Hitsukaya certification gave my work the recognition it deserved.'},
  {name:'Kenji T.', role:'Designer', text:'The process was clear and the badge truly stands out.'},
  {name:'Maya L.', role:'Developer', text:'I appreciate how fair and transparent the certification is.'}
]}" class="bg-red-900 py-20 px-6 text-white">
  <div class="max-w-3xl mx-auto text-center">
    <template x-for="(t, i) in testimonials" :key="i">
      <blockquote x-show="current === i" x-transition class="space-y-4">
        <p class="italic text-lg">"<span x-text="t.text"></span>"</p>
        <footer class="font-semibold text-yellow-400">
          <span x-text="t.name"></span>, <span class="text-red-300" x-text="t.role"></span>
        </footer>
      </blockquote>
    </template>

    <div class="mt-8 flex justify-center space-x-4">
      <button @click="current = (current - 1 + testimonials.length) % testimonials.length"
              class="rounded-full bg-yellow-400 text-red-900 px-3 py-1 hover:bg-yellow-300 transition">Prev</button>
      <button @click="current = (current + 1) % testimonials.length"
              class="rounded-full bg-yellow-400 text-red-900 px-3 py-1 hover:bg-yellow-300 transition">Next</button>
    </div>
  </div>
</section>

<!-- Subscribe -->
<section class="bg-red-800 py-16 px-6">
  <div class="max-w-lg mx-auto text-center text-yellow-300">
    <h2 class="text-2xl font-bold mb-4">Stay Updated</h2>
    <p class="mb-6">Subscribe to our newsletter for latest news and certification openings.</p>
    <form class="flex flex-col sm:flex-row gap-4">
      <input type="email" placeholder="Your email" required
             class="flex-1 rounded-md px-4 py-3 text-red-900 font-semibold" />
      <button type="submit" class="bg-yellow-400 hover:bg-yellow-300 rounded-md px-6 py-3 font-bold text-red-900 transition">
        Subscribe
      </button>
    </form>
  </div>
</section>

<!-- Footer -->
<footer class="bg-red-900 text-red-300 text-center py-6 text-sm">
  &copy; 2025 Hitsukaya Certified. All rights reserved.
</footer>



</x-layouts.app>
