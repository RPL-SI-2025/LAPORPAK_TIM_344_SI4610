<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>LACAK LAPORANMU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="text-xl font-bold">LaporPak!</div>
                <div class="flex space-x-4">
                    <a href="#" class="flex items-center space-x-1">
                        <i class="fas fa-bell"></i>
                        <span>Notifikasi</span>
                    </a>
                    <a href="#">Beranda</a>
                    <a href="#">FAQ</a>
                    <a href="#">Statistik</a>
                    <a href="#">Profil</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto mt-8 px-4">
        <h1 class="text-3xl font-bold text-center mb-4">LACAK LAPORANMU</h1>
        <p class="text-center mb-8">Sudah bikin laporan belum? Kalau sudah, Masukkan Nomor Laporanmu dibawah ini!</p>

        <!-- Nomor Laporan Display -->
        <div class="bg-white rounded-lg shadow p-4 mb-8 flex justify-between items-center">
            <span class="text-lg">{{ $report->nomor_laporan }}</span>
            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">Get Started</button>
        </div>

        <!-- Timeline -->
        <div class="relative">
            <!-- Timeline Line -->
            <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-px bg-gray-300"></div>

            <!-- Timeline Items -->
            <div class="grid grid-cols-5 gap-4 relative">
                <!-- Tulis Laporan -->
                <div class="text-center">
                    <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-yellow-500 flex items-center justify-center text-white">
                        <i class="fas fa-pencil-alt"></i>
                    </div>
                    <h3 class="font-semibold">Tulis Laporan</h3>
                    <p class="text-sm text-gray-600">Laporkan keluhan atau aspirasi anda dengan jelas dan lengkap</p>
                </div>

                <!-- Proses Verifikasi -->
                <div class="text-center">
                    <div class="w-12 h-12 mx-auto mb-2 rounded-full {{ $report->status == 'Diproses' ? 'bg-yellow-500' : 'bg-gray-300' }} flex items-center justify-center text-white">
                        <i class="fas fa-check"></i>
                    </div>
                    <h3 class="font-semibold">Proses Verifikasi</h3>
                    <p class="text-sm text-gray-600">Dalam 3 hari, laporan Anda akan diverifikasi dan diteruskan kepada instansi berwenang</p>
                </div>

                <!-- Proses Tindak lanjut -->
                <div class="text-center">
                    <div class="w-12 h-12 mx-auto mb-2 rounded-full {{ $report->status == 'Ditindaklanjuti' ? 'bg-yellow-500' : 'bg-gray-300' }} flex items-center justify-center text-white">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h3 class="font-semibold">Proses Tindak lanjut</h3>
                    <p class="text-sm text-gray-600">Laporanmu berhasil diajukan Silahkan tunggu progres pembangunan</p>
                </div>

                <!-- Beri Tanggapan -->
                <div class="text-center">
                    <div class="w-12 h-12 mx-auto mb-2 rounded-full {{ $report->status == 'Ditanggapi' ? 'bg-yellow-500' : 'bg-gray-300' }} flex items-center justify-center text-white">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="font-semibold">Beri Tanggapan</h3>
                    <p class="text-sm text-gray-600">Anda dapat menanggapi kembali balasan yang diberikan dalam waktu 10 hari</p>
                </div>

                <!-- Selesai -->
                <div class="text-center">
                    <div class="w-12 h-12 mx-auto mb-2 rounded-full {{ $report->status == 'Selesai' ? 'bg-yellow-500' : 'bg-gray-300' }} flex items-center justify-center text-white">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <h3 class="font-semibold">Selesai</h3>
                    <p class="text-sm text-gray-600">Laporan Anda akan terus ditindaklanjuti hingga terselesaikan</p>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-8">
            <a href="{{ route('track.report') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded inline-block">
                Kembali
            </a>
        </div>
    </div>
</body>
</html>
