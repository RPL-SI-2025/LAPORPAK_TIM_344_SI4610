@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">Dashboard Masyarakat</h1>
                <p class="mt-2 text-gray-400">Selamat datang, {{ Auth::user()->name }}!</p>
            </div>
            <a href="{{ route('welcome') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-gray-600 rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>

        <h2 class="text-2xl font-bold text-white mb-6">Kategori Laporan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card Lacak Laporan -->
            <a href="{{ route('lacak-laporan') }}" class="block bg-white rounded-lg shadow-lg overflow-hidden transform transition-transform duration-300 hover:scale-105">
                <div class="p-6">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 9a2 2 0 114 0 2 2 0 01-4 0z" />
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a4 4 0 00-3.446 6.032l-2.261 2.26a1 1 0 101.414 1.415l2.261-2.261A4 4 0 1011 5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Lacak Laporanmu</h3>
                    <p class="text-gray-600 mb-4">Sudah Melapor? Lacak menggunakan nomor laporan.</p>
                    <div class="flex items-center text-red-500">
                        <span class="mr-2">Lacak Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Card Laporan Masuk & Selesai -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5z" />
                            <path d="M8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7z" />
                            <path d="M14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Laporan Masuk & Selesai</h3>
                    <p class="text-gray-600 mb-4">Data Laporan Masuk Tahun 2025</p>
                    <div class="flex items-center text-purple-500">
                        <span class="mr-2">Lihat Data</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Aktivitas Laporan -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 100 2h4a1 1 0 100-2H8zm5-4a1 1 0 100 2H8a1 1 0 100-2h5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Aktivitas Laporan</h3>
                    <p class="text-gray-600 mb-4">Lihat Aktivitas Laporanmu</p>
                    <div class="flex items-center text-blue-500">
                        <span class="mr-2">Lihat Aktivitas</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
