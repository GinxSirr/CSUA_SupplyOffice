<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <!-- Logo/Header -->
            <div class="mb-6 text-center">
                <div class="flex items-center justify-center mb-4">
                    <div class="w-24 h-24 bg-gradient-to-b from-blue-400 to-blue-600 rounded-lg flex items-center justify-center text-white text-5xl" style="box-shadow: 0 4px 10px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.3);">
                        📦
                    </div>
                </div>
                <h1 class="text-white text-3xl font-bold mb-2" style="text-shadow: 0 2px 4px rgba(0,0,0,0.5);">CSUA Supply Office</h1>
                <p class="text-white text-sm" style="text-shadow: 0 1px 2px rgba(0,0,0,0.3);">Cagayan State University at Aparri</p>
            </div>

            <!-- Main Content Window -->
            <div class="win-window w-full sm:max-w-md">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="mt-6 text-center text-white text-sm" style="text-shadow: 0 1px 2px rgba(0,0,0,0.3);">
                <p>&copy; {{ date('Y') }} CSUA Supply Office System</p>
            </div>
        </div>
    </body>
</html>
