<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>404 Not Found - {{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts


</head>
<body>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center">
            <h1 class="mb-4 text-5xl font-bold text-red-600">503</h1>
            <p class="mb-6 text-lg">We'll be back soon! This service is temporarily unavailable.</p>
            <button  class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                <a href="{{ route('home')}}">Back to Home</a>
            </button>
        </div>
    </div>

</body>
</html>
