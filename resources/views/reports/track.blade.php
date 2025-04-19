@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">Lacak Laporan</h1>
                <p class="mt-2 text-gray-400">Masukkan nomor laporan untuk melacak status laporan Anda</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('welcome') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-gray-600 rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    Beranda
                </a>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-gray-600 rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg shadow-lg p-6">
            @if(session('error'))
                <div class="bg-red-900/50 text-red-200 p-4 rounded-md mb-4">
                    <div class="flex">
                        <svg class="h-5 w-5 text-red-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('report.search') }}" method="POST" class="max-w-lg mx-auto">
                @csrf
                <div class="mb-6">
                    <label for="nomor_laporan" class="block text-sm font-medium text-gray-300 mb-2">Nomor Laporan</label>
                    <input type="text" name="nomor_laporan" id="nomor_laporan" required
                           class="block w-full rounded-md bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                           placeholder="Contoh: LAP123456">
                    <p class="mt-2 text-sm text-gray-400">Masukkan nomor laporan yang telah diberikan saat membuat laporan.</p>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 font-medium">
                        Lacak Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
