<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>500 ERROR - {{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts


</head>
<body>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center">
            <h1 class="mb-4 text-5xl font-bold text-red-600">500</h1>
            <p class="mb-6 text-lg">Sorry, something went wrong on our end.</p>
            <a href="{{ route('home') }}" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                Go Home
            </a>
        </div>
    </div>

</body>
</html>
