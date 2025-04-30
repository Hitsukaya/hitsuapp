<div class="fixed left-0 bottom-0 z-40"
        x-data="{ cookies: localStorage.getItem('cookiesAccepted') !== 'true' }"
        x-init="$watch('cookies', value => {
        if (!value) {
            localStorage.setItem('cookiesAccepted', 'true');
            let expirationDate = new Date();
            expirationDate.setDate(expirationDate.getDate() + 5);
            localStorage.setItem('cookiesExpiration', expirationDate.toISOString());
        }
        });
        const storedExpiration = localStorage.getItem('cookiesExpiration');
        if (storedExpiration && new Date(storedExpiration) < new Date()) {
        localStorage.removeItem('cookiesAccepted');
        localStorage.removeItem('cookiesExpiration');
        cookies = true;
        }">

    <div x-show="cookies" class="fixed sm:left-4 bottom-20 rounded-lg bg-white dark:bg-neutral-900 shadow-2xl w-full sm:w-1/2 xl:w-1/4 max-w-[360px] overflow-hidden"
         style="display: none;"
         x-transition:enter="transition ease-in duration-200"
         x-transition:enter-start="opacity-0 transform -translate-x-40"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform -translate-x-40">


        <div class="px-2 select-none">
            <div class="relative overflow-hidden px-8 pt-8">
                <div class="absolute -top-1 -right-1">
                    <x-svg-hitsukaya-logo-app-icon />
                </div>
                <div class="text-xl flex flex-col pb-4 px-2 dark:text-white">
                    <small>Welcome to the Hitsukaya App!</small>
                </div>
                <div class="pb-4 px-2 dark:text-white">
                    We use cookies to enhance your experience. By continuing, you agree to our <a href="{{ route('cookies.show') }}" class="text-red-600 underline">Cookie Policy</a> and <a href="{{ route('terms.show') }}" class="text-red-600 underline">Terms & Conditions</a>.
                </div>
            </div>
        </div>

        <div class="w-full flex justify-center items-center">
            <button class="border-r border-red-500 dark:border-red-500 flex-1 px-4 py-3 text-gray-500 dark:text-white hover:text-white hover:bg-red-400 duration-150" @click="cookies = false">I do not agree!</button>
            <button class="flex-1 px-4 py-3 text-gray-500 dark:text-white hover:text-white hover:bg-green-400 duration-150" @click="cookies = false">Accept</button>
        </div>
    </div>
</div>
