<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>429 Too Many Requests- {{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts


</head>
<body>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="max-w-lg px-6 py-8 text-center bg-white rounded-lg shadow-lg">
            <h1 class="mb-6 text-6xl font-extrabold text-red-600">429</h1>
            <h2 class="mb-4 text-2xl font-bold text-gray-800">Too Many Requests</h2>
            <p class="text-gray-600 mb-6">
                You've made too many requests in a short period. Please wait a moment and try again.
                {{ $message ?? 'You’ve made too many requests. Please try again later.' }}
            </p>

            <a href="{{ url()->current() }}" class="px-4 py-2 text-white transition bg-blue-500 rounded-md hover:bg-blue-600">
                Refresh Page
            </a>
        </div>
    </div>

</body>
</html>
