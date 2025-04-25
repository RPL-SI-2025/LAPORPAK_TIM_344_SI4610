@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">LACAK LAPORANMU</h1>
            <p class="text-gray-600">Sudah bikin laporan belum? Kalau sudah, Masukkan Nomor Laporanmu dibawah ini!</p>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6 max-w-3xl mx-auto">
            <div class="text-center mb-8">
                <div class="text-xl font-semibold text-gray-900">{{ $report->nomor_laporan }}</div>
            </div>

            @if(isset($pesan_diterima))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg text-center">
                    {{ $pesan_diterima }}
                </div>
            @endif
            @if(isset($alasan_penolakan))
                <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg text-center">
                    {{ $alasan_penolakan }}
                </div>
            @endif

            {{-- DEBUG: status --}}
            <p style="color:red; font-weight:bold;">Status laporan: {{ $report->status }}</p>
            <div class="flex justify-between items-center mb-12">
                <div class="flex-1 text-center">
                    <div class="w-16 h-16 mx-auto {{ in_array($report->status, ['Diajukan', 'Diproses', 'Ditindaklanjuti', 'Selesai']) ? 'bg-orange-100' : 'bg-gray-100' }} rounded-full flex items-center justify-center mb-2">
                        <svg class="w-8 h-8 {{ in_array($report->status, ['Diajukan', 'Diproses', 'Ditindaklanjuti', 'Selesai']) ? 'text-orange-500' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium">Tulis Laporan</h3>
                    <p class="text-xs text-gray-500 mt-1">Laporkan keluhan atau aspirasi anda dengan jelas dan lengkap</p>
                </div>

                <div class="flex-1 text-center">
                    <div class="w-16 h-16 mx-auto {{ strtolower($report->status) == 'ditolak' ? 'bg-red-100' : (in_array($report->status, ['Diproses', 'Ditindaklanjuti', 'Selesai']) ? 'bg-orange-100' : 'bg-gray-100') }} rounded-full flex items-center justify-center mb-2">
                        <svg class="w-8 h-8 {{ strtolower($report->status) == 'ditolak' ? 'text-red-500' : (in_array($report->status, ['Diproses', 'Ditindaklanjuti', 'Selesai']) ? 'text-orange-500' : 'text-gray-400') }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium">Proses Verifikasi</h3>
                    <p class="text-xs text-gray-500 mt-1">Dalam 3 hari, laporan Anda akan diverifikasi dan diteruskan kepada instansi berwenang</p>
                </div>

                <div class="flex-1 text-center">
                    <div class="w-16 h-16 mx-auto {{ in_array($report->status, ['Ditindaklanjuti', 'Diterima', 'Ditolak', 'Selesai']) ? 'bg-orange-100' : 'bg-gray-100' }} rounded-full flex items-center justify-center mb-2">
                        <svg class="w-8 h-8 {{ in_array($report->status, ['Ditindaklanjuti', 'Diterima', 'Ditolak', 'Selesai']) ? 'text-orange-500' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium">Proses Tindak lanjut</h3>
                    <p class="text-xs text-gray-500 mt-1">Laporanmu berhasil diajukan Silahkan tunggu progres pembangunan</p>
                </div>

                {{-- Bulatan hasil: Diterima/Ditolak --}}
                @if($report->status == 'Diterima' || $report->status == 'Ditolak')
                <div class="flex-1 text-center">
                    <div class="w-16 h-16 mx-auto {{ $report->status == 'Diterima' ? 'bg-green-100' : 'bg-red-100' }} rounded-full flex items-center justify-center mb-2">
                        @if($report->status == 'Diterima')
                            <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        @else
                            <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm2.707-9.707a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 001.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </div>
                    <h3 class="text-sm font-medium font-bold {{ $report->status == 'Diterima' ? 'text-green-700' : 'text-red-700' }}">
                        {{ $report->status == 'Diterima' ? 'Laporan Anda Disetujui' : 'Laporan Anda Ditolak' }}
                    </h3>
                    @if($report->status == 'Ditolak')
                        <p class="text-xs text-red-700 mt-1">Maaf Laporan Anda Kurang Valid</p>
                    @endif
                </div>
                @endif

                <div class="flex-1 text-center">
                    <div class="w-16 h-16 mx-auto {{ in_array($report->status, ['Selesai']) ? 'bg-orange-100' : 'bg-gray-100' }} rounded-full flex items-center justify-center mb-2">
                        <svg class="w-8 h-8 {{ in_array($report->status, ['Selesai']) ? 'text-orange-500' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium">Beri Tanggapan</h3>
                    <p class="text-xs text-gray-500 mt-1">Anda dapat menanggapi kembali balasan yang diberikan dalam waktu 10 hari</p>
                </div>

                <div class="flex-1 text-center">
                    <div class="w-16 h-16 mx-auto {{ $report->status == 'Selesai' ? 'bg-orange-100' : 'bg-gray-100' }} rounded-full flex items-center justify-center mb-2">
                        <svg class="w-8 h-8 {{ $report->status == 'Selesai' ? 'text-orange-500' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium">Selesai</h3>
                    <p class="text-xs text-gray-500 mt-1">Laporan Anda akan terus ditindaklanjuti hingga terselesaikan</p>
                </div>
            </div>


            @if($report->status === 'completed')
            <div class="mt-4 p-4 bg-green-50 rounded-lg">
                <h4 class="text-lg font-medium text-green-900 mb-2">Hasil Penanganan</h4>
                <p class="text-green-600">{{ $report->resolution ?? 'Tidak ada keterangan tambahan' }}</p>
            </div>
            @endif

            <div class="mt-8 text-center">
                <a href="{{ route('lacak-laporan') }}" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
