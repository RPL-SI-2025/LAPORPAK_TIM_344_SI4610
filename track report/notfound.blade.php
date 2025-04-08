<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tidak Ditemukan</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white rounded shadow p-8 text-center max-w-lg">
    <h1 class="text-2xl font-bold text-red-500 mb-4">Laporan Tidak Ditemukan 😥</h1>
    <p>Nomor laporan <strong>{{ $nomor_laporan }}</strong> tidak tersedia.</p>

    <a href="{{ route('track.report') }}"
       class="inline-block mt-6 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
      Coba Lagi
    </a>
  </div>

</body>
</html>
