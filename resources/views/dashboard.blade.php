<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <!-- Dropdown Profil Kanan Atas Dashboard -->
        <div class="absolute top-6 right-8 z-50" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center text-gray-700 dark:text-gray-100 text-sm font-medium focus:outline-none">
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
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <div class="mt-6">
                        <a href="{{ route('lacak-laporan') }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                            Lacak Laporan Tanpa Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
