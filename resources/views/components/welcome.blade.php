<div class="select-none p-6 lg:p-8 bg-white dark:bg-neutral-900 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-4">
        {{-- Left Column: User Profile --}}
        <div class="lg:col-span-1">
            <div class="p-6 bg-white dark:bg-neutral-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm">
                <div class="flex flex-col items-center text-center">
                    {{-- Avatar --}}
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-24 h-24 rounded-full object-cover border-2 border-indigo-500 dark:border-indigo-400">

                    {{-- Name & Email --}}
                    <h2 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">
                        {{ Auth::user()->name }}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ Auth::user()->email }}
                    </p>

                    {{-- Location --}}
                    @if(Auth::user()->location)
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            📍 {{ Auth::user()->location }}
                        </p>
                    @endif

                    {{-- Member Since --}}
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Joined {{ Auth::user()->created_at->format('F j, Y') }}
                    </p>

                    {{-- Edit Button --}}
                    <a href="{{ route('profile.show') }}"
                       class="mt-4 inline-flex items-center px-4 py-2 bg-red-600 text-white hover:text-white text-sm font-medium rounded-md hover:bg-red-700 transition">
                        <x-heroicon-o-pencil class="w-4 h-4 mr-1" /> Edit Profile
                    </a>
                </div>

                {{-- Bio --}}
                @if(Auth::user()->bio)
                <div class="mt-6 text-left">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-white">About</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                        {{ Auth::user()->bio }}
                    </p>
                </div>
                @endif
            </div>
        </div>

        {{-- Right Column: Stats --}}
        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Last Login --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <x-heroicon-o-clock class="w-5 h-5 text-red-600 dark:text-red-500"/>
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Last login</span>
                </div>
                <p class="mt-2 text-xl font-semibold text-gray-900 dark:text-white">
                    {{ \Carbon\Carbon::parse(Auth::user()->last_login_at)->diffForHumans() }}
                </p>
            </div>

            {{-- Total Logins --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <x-heroicon-o-finger-print class="w-5 h-5 text-red-600 dark:text-red-500"/>
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Total logins</span>
                </div>
                <p class="mt-2 text-xl font-semibold text-gray-900 dark:text-white">
                    {{ Auth::user()->login_count ?? '—' }}
                </p>
            </div>

            {{-- Exta Functionality --}}
            @if(auth()->user()->role === 'ADMIN' || auth()->user()->role === 'EDITOR')
                <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <x-heroicon-o-cog class="w-5 h-5 text-red-600 dark:text-red-500"/>
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Extra Functionality</span>
                    </div>
                    <p class="mt-2 text-xl py-2 font-semibold text-gray-900 dark:text-white">
                        <x-cache-clear />
                    </p>
                </div>
            @endif

            {{-- Newsletter Preferences --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <x-heroicon-o-cog class="w-5 h-5 text-red-600 dark:text-red-500"/>
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Newsletter Preferences</span>
                </div>
                <p class="mt-2 text-xl font-semibold text-gray-900 dark:text-white">

                    @livewire('newsletter.newsletter-preferences')

                </p>
            </div>

            {{-- Two Factor Authentication --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <x-heroicon-o-user-circle class="w-5 h-5 text-indigo-600 dark:text-indigo-400"/>
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Two Factor Authentication</span>
                </div>
                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>
                @endif
            </div>

            {{-- Browser Sessions --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <x-heroicon-o-user-circle class="w-5 h-5 text-indigo-600 dark:text-indigo-400"/>
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Browser Sessions</span>
                </div>
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>
            </div>
        </div>
    </div>
</div>

