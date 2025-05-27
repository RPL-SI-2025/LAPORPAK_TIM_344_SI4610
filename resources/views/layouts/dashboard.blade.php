@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg fixed h-full">
        <div class="p-4">
            <h2 class="text-xl font-bold mb-4">Menu</h2>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('faq') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-question-circle mr-2"></i> FAQ
                    </a>
                </li>
                <li>
                    <a href="{{ route('track.show') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-search mr-2"></i> Lacak Laporan
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-4">
        @yield('dashboard-content')
    </div>
</div>
@endsection
