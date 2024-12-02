<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans antialiased text-gray-900">
    <div class="flex flex-col items-center min-h-screen pt-6 bg-white sm:justify-center sm:pt-0">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="{{ route('home') }}" wire:navigate class="text-6xl font-bold text-center text-gray-900">
                <h1>Barta</h1>
            </a>
            @isset($title)
                <h1 class="mt-10 text-2xl font-bold leading-9 tracking-tight text-center text-gray-900">
                    {{ $title }}
                </h1>
            @endisset
        </div>

        <div class="w-full px-6 py-4 mt-6 overflow-hidden sm:max-w-md">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
