<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>LACAK LAPORANMU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Logo Only Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex items-center py-4">
                <div class="text-xl font-bold">LaporPak!</div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto mt-8 px-4">
        <h1 class="text-3xl font-bold text-center mb-4">LACAK LAPORANMU</h1>
        <p class="text-center mb-8">Sudah bikin laporan belum? Kalau sudah, Masukkan Nomor Laporanmu dibawah ini!</p>

        <!-- Nomor Laporan Display -->
        <div class="flex flex-col items-center mb-10">
            <div class="w-full max-w-xl bg-white rounded-lg shadow p-4 flex items-center justify-between">
                <input type="text" class="flex-1 bg-transparent outline-none text-gray-700" value="{{ $report->nomor_laporan }}" readonly />

            </div>
        </div>

        <!-- Timeline -->
        <div class="w-full max-w-5xl mx-auto">
            <div class="flex items-start justify-between relative gap-x-8">
                <!-- Garis Horizontal -->
                <div class="absolute top-6 left-0 right-0 h-1 bg-gray-200 z-0"></div>
                @php
                    $steps = [
                        [
                            'label' => 'Tulis Laporan',
                            'icon' => 'fas fa-pencil-alt',
                            'color' => 'bg-yellow-400',
                            'active' => true,
                            'desc' => 'Laporkan keluhan atau aspirasi anda dengan jelas dan lengkap',
                        ],
                        [
                            'label' => 'Proses Verifikasi',
                            'icon' => 'fas fa-clipboard-check',
                            'color' => in_array($report->status, ['Diproses','Diterima','Ditolak','Ditindaklanjuti','Ditanggapi','Selesai']) ? 'bg-yellow-400' : 'bg-gray-300',
                            'active' => in_array($report->status, ['Diproses','Diterima','Ditolak', 'Ditindaklanjuti','Ditanggapi','Selesai']),
                            'desc' => 'Dalam 3 hari, laporan Anda akan diverifikasi dan diteruskan kepada instansi berwenang',
                        ],
                        [
                            'label' => ($report->status == 'Ditolak') ? 'Laporan Anda Ditolak' : 'Laporan Anda Disetujui',
                            'icon' => ($report->status == 'Ditolak') ? 'fas fa-times' : 'fas fa-check-circle',
                            'color' => ($report->status == 'Ditolak') ? 'bg-red-400' : (in_array($report->status, ['Diterima','Ditindaklanjuti','Ditanggapi','Selesai']) ? 'bg-yellow-400' : 'bg-gray-300'),
                            'active' => in_array($report->status, ['Diterima','Ditindaklanjuti','Ditanggapi','Selesai','Ditolak']),
                            'desc' => ($report->status == 'Ditolak') ? ($alasan_penolakan ?? 'Maaf, laporan anda kurang valid') : 'Silahkan tunggu proses selanjutnya',
                        ],
                        [
                            'label' => 'Proses Tindak lanjut',
                            'icon' => 'fas fa-cogs',
                            'color' => (in_array($report->status, ['Ditindaklanjuti','Ditanggapi','Selesai'])) ? 'bg-yellow-400' : 'bg-gray-300',
                            'active' => in_array($report->status, ['Ditindaklanjuti','Ditanggapi','Selesai']),
                            'desc' => 'Laporanmu berhasil diajukan silahkan tunggu progres pembangunan',
                        ],
                        [
                            'label' => 'Beri Tanggapan',
                            'icon' => 'fas fa-comments',
                            'color' => (in_array($report->status, ['Ditanggapi','Selesai'])) ? 'bg-yellow-400' : 'bg-gray-300',
                            'active' => in_array($report->status, ['Ditanggapi','Selesai']),
                            'desc' => '<span class="font-semibold">Anda dapat menanggapi umpan balik</span>',
                        ],
                        [
                            'label' => 'Selesai',
                            'icon' => 'fas fa-check',
                            'color' => ($report->status == 'Selesai') ? 'bg-green-500' : 'bg-gray-300',
                            'active' => $report->status == 'Selesai',
                            'desc' => 'Laporan Anda akan terus ditindaklanjuti hingga terselesaikan',
                        ],
                    ];
                @endphp
                @foreach($steps as $i => $step)
                    <div class="flex flex-col items-center z-10 w-40">
                        <div class="w-16 h-16 flex items-center justify-center rounded-full {{ $step['color'] }} text-white text-2xl mb-2 border-4 border-white shadow">
                            <i class="{{ $step['icon'] }}"></i>
                        </div>
                        <div class="font-bold text-base mb-1">{{ $step['label'] }}</div>
                        <div class="text-xs text-gray-500 mb-4">{!! $step['desc'] !!}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-8">
            <a href="{{ route('lacak-laporan') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded inline-block">
                Kembali
            </a>
        </div>
    </div>
</body>
</html>
