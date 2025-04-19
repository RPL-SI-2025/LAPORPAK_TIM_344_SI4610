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

                        <!-- Navigation Links -->
                        <div class="flex items-center space-x-4">
                            @auth
                            <div class="relative">
                                <div x-data="{ open: false }" @click.away="open = false" class="relative">
                                    <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-300 hover:text-white focus:outline-none transition duration-150 ease-in-out">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>

                                    <div x-show="open" 
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-gray-800 border border-gray-700"
                                         style="display: none;">
                                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">
                                            {{ __('Profile') }}
                                        </a>

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">
                                                {{ __('Log Out') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @else
                            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white text-sm font-medium">Log in</a>
                            <a href="{{ route('register') }}" class="bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-700">Register</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
