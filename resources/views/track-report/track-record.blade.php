<!-- Form pelacakan laporan -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lacak Laporan</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded shadow w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Lacak Laporan</h1>

    @if(session('error'))
      <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        {{ session('error') }}
      </div>
    @endif

    <form action="{{ route('report.search') }}" method="POST">
      @csrf
      <label class="block mb-2 font-semibold" for="nomor_laporan">Nomor Laporan:</label>
      <input type="text" name="nomor_laporan" id="nomor_laporan" required
             class="w-full border rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-yellow-400">
      <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded">
        Cari
      </button>
    </form>
  </div>

</body>
</html>
