@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white flex flex-col justify-start items-center pt-20">
    <div class="w-full max-w-2xl flex flex-col items-center">
        <h1 class="text-5xl font-extrabold text-gray-900 text-center mb-4 tracking-tight">LACAK LAPORANMU</h1>
        <p class="text-center text-gray-700 mb-8">Sudah bikin laporan belum? Kalau sudah, Masukkan Nomor Laporanmu dibawah ini!</p>
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4 w-full">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-red-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif
        <form action="{{ route('report.search') }}" method="POST" class="w-full">
            @csrf
            <div class="flex flex-col sm:flex-row items-center gap-4 bg-gray-50 p-4 rounded-xl shadow-lg">
                <input type="text" name="nomor_laporan" id="nomor_laporan" required
                    class="flex-1 px-4 py-3 rounded-md border border-gray-200 bg-white text-gray-900 placeholder-gray-400 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-200 outline-none transition"
                    placeholder="Masukan Nomor Laporan">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-yellow-400 text-white font-semibold rounded-md shadow hover:bg-yellow-500 transition">
                    Get Started
                </button>
            </div>
        </form>
    </div>
</div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
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
                    <label for="nomor_laporan" class="block text-sm font-medium text-gray-700 mb-2">Nomor Laporan</label>
                    <input type="text" name="nomor_laporan" id="nomor_laporan" required
                           class="block w-full rounded-md bg-gray-700 border-gray-300 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                           placeholder="Contoh: LAP123456">
                    <p class="mt-2 text-sm text-gray-400">Masukkan nomor laporan yang telah diberikan saat membuat laporan.</p>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-100 font-medium">
                        Lacak Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
