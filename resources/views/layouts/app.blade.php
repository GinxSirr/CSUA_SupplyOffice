<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - CSUA Supply Office System</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="min-h-screen" style="background-color: #ece9d8;">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="win-titlebar shadow-md">
                    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-4">
                {{ $slot }}
            </main>

            <!-- Status Bar -->
            <footer class="win-statusbar fixed bottom-0 w-full">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <span>CSUA Supply Office Management System</span>
                    <span>User: {{ Auth::user()->name }} ({{ ucfirst(str_replace('_', ' ', Auth::user()->user_type)) }})</span>
                </div>
            </footer>
        </div>
    </body>
</html>
