<x-layouts.main>

    @auth
    <x-ui.app.auth />
    @else
    <x-ui.app.header />
    @endauth

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow dark:bg-neutral-950">
                    <div class="px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

    <x-ui.app.footer />

</x-layouts.main>
