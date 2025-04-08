<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Laporan</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white rounded shadow p-8 max-w-lg w-full">
    <h1 class="text-xl font-bold mb-6 text-center">Detail Laporan</h1>

    <div class="mb-4">
      <strong>Nomor Laporan:</strong>
      <p>{{ $report->nomor_laporan }}</p>
    </div>
    <div class="mb-4">
      <strong>Judul:</strong>
      <p>{{ $report->judul }}</p>
    </div>
    <div class="mb-4">
      <strong>Deskripsi:</strong>
      <p>{{ $report->deskripsi ?? '-' }}</p>
    </div>
    <div class="mb-4">
      <strong>Status:</strong>
      <span class="px-3 py-1 rounded-full text-sm bg-yellow-200 text-yellow-800">
        {{ ucfirst($report->status) }}
      </span>
    </div>

    <a href="{{ route('track.report') }}"
       class="inline-block mt-4 bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600">
      Kembali
    </a>
  </div>

</body>
</html>
