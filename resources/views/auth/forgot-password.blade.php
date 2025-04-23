<x-layouts.app>
    <x-authentication-card>

        <div class="mb-4 text-sm text-center text-gray-600 dark:text-white">
            {!! __('Forgot your password? <br>  No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') !!}
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />


        <div class="flex flex-col items-stretch justify-center">
            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="px-10 py-0 sm:py-8 sm:shadow-sm dark:border-gray-200/10 sm:border sm:rounded-lg border-gray-200/60">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="block">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button>
                                {{ __('Email Password Reset Link') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>


    </x-authentication-card>
</x-layouts.app>
