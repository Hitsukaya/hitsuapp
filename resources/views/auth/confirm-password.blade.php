<x-layouts.app>
    <x-authentication-card>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <div class="flex flex-col items-stretch justify-center">
            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="px-10 py-0 sm:py-8 sm:shadow-sm dark:border-gray-200/10 sm:border sm:rounded-lg border-gray-200/60">
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div>
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input.showpassword id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
                        </div>

                        <div class="flex justify-end mt-4">
                            <x-button class="ms-4">
                                {{ __('Confirm') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </x-authentication-card>
</x-layouts.app>
