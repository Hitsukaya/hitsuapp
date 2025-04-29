<section class="lg:hidden flex w-full items-start justify-center bg-gray-100 dark:bg-neutral-900">
    <div class="m-auto flex max-w-screen-xl grow flex-col items-center justify-start gap-6 py-20 md:gap-12 px-3 sm:px-8 lg:px-16 xl:px-32">
        <x-svg-hitsukaya-logo-app-icon />
      <div class="flex flex-1 flex-col items-center gap-6 text-center">
        <span class="inline-flex rounded-[64px] border text-center font-semibold transition-all duration-300 ease-in-out h-7 px-3 py-1 text-sm border-blue-300 bg-blue-50 text-red-600 uppercase">Discover the creative universe behind HITSUKAYA</span>
        <div class="flex max-w-lg flex-col gap-6">
          <h3 class="text-4xl font-semibold text-red-600 md:text-6xl">Build Your New Idea with Hitsukaya</h3>
          <p class="text-lg font-normal leading-7 text-black dark:text-white">Web and mobile apps are what allow businesses to stay on top of their game, whether they’re based on user services, business services, or data services. Hitsukaya, we know how important websites & apps are, so we develop engaging and efficient web apps.</p>
        </div>
      </div>
      <div class="flex gap-4">

        @auth
            <a href="{{ route('dashboard') }}" class="group inline-flex items-center justify-center whitespace-nowrap rounded-lg py-2 align-middle text-sm font-semibold leading-none transition-all duration-300 ease-in-out disabled:cursor-not-allowed bg-red-600 stroke-white px-6 text-white hover:bg-red-800 h-[42px] min-w-[42px] gap-2 disabled:bg-slate-100 disabled:stroke-slate-400 disabled:text-slate-400 disabled:hover:bg-slate-100">
                <div> {{ __('Dashboard') }} </div>
            </a>
        @else
            <a href="{{ route('login') }}" class="group inline-flex items-center justify-center whitespace-nowrap rounded-lg py-2 align-middle text-sm font-semibold leading-none transition-all duration-300 ease-in-out disabled:cursor-not-allowed bg-red-600 stroke-white px-6 text-white hover:bg-red-800 h-[42px] min-w-[42px] gap-2 disabled:bg-slate-100 disabled:stroke-slate-400 disabled:text-slate-400 disabled:hover:bg-slate-100">
                <div>Login Account</div>
            </a>
        @endauth

        <button type="button" aria-disabled="false"
          class="group inline-flex items-center justify-center whitespace-nowrap rounded-lg py-2 align-middle text-sm font-semibold leading-none transition-all duration-300 ease-in-out disabled:cursor-not-allowed stroke-blue-700 px-2 text-blue-700 h-[42px] min-w-[42px] gap-2 disabled:stroke-slate-400 disabled:text-slate-400 hover:stroke-blue-950 hover:text-blue-950">
          <div>See More</div>
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1D4ED8" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg" class="size-6 stroke-inherit">
            <path d="M11 16L15 12L11 8" stroke-linecap="round" stroke-linejoin="round"></path>
            <circle cx="12" cy="12" r="9"></circle>
          </svg>
        </button>
      </div>
    </div>
  </section>

  <div class="hidden lg:block">
    <x-home.hero />
  </div>


