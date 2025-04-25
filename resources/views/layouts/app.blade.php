<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles & Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://unpkg.com/alpinejs" defer></script>
        <script>
            tailwind.config = {
                darkMode: 'class'
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-gray-900">
        <div class="min-h-screen">
            @if(!request()->routeIs('report.detail') && !request()->is('laporan/*'))
            <nav class="bg-gray-800 border-b border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ auth()->check() ? route('dashboard') : route('welcome') }}" class="text-xl font-bold text-white">
                                    {{ config('app.name', 'Laravel') }}
                                </a>
                            </div>
                        </div>
                        @if(request()->routeIs('report.track') || request()->is('lacak-laporan'))
                            @if(auth()->check())
                                <div class="flex items-center space-x-6">
                                    <a href="#" class="flex items-center text-gray-300 hover:text-white text-sm font-medium">
                                        <i class="fas fa-bell mr-1"></i> Notifikasi
                                    </a>
                                    <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white text-sm font-medium">Beranda</a>
                                    <a href="#" class="text-gray-300 hover:text-white text-sm font-medium">FAQ</a>
                                    <a href="#" class="text-gray-300 hover:text-white text-sm font-medium">Statistik</a>
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="flex items-center text-gray-300 hover:text-white text-sm font-medium focus:outline-none">
                                            <svg class="w-6 h-6 rounded-full bg-gray-700 text-white mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 12c2.7 0 8 1.34 8 4v2H4v-2c0-2.66 5.3-4 8-4zm0-2a4 4 0 100-8 4 4 0 000 8z" />
                                            </svg>
                                            {{ Auth::user()->name }}
                                            <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-gray-800 border border-gray-600 z-50">
                                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">Profil</a>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-white hover:bg-gray-700">Logout</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Navigation Links -->
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white text-sm font-medium">Log in</a>
                                    <a href="{{ route('register') }}" class="bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-700">Register</a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </nav>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
