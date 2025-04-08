<!DOCTYPE html>
<html>
<head>
    <title>Form Laporan</title>
</head>
<body>
    <h1>Formulir Laporan</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('lapor.store') }}" enctype="multipart/form-data">
        @csrf

        <label>Jenis Laporan:</label><br>
        <input type="text" name="jenis_laporan"><br><br>

        <label>Bukti Laporan (upload file):</label><br>
        <input type="file" name="bukti_laporan"><br><br>

        <label>Lokasi:</label><br>
        <input type="text" name="lokasi"><br><br>

        <button type="submit">Kirim</button>
    </form>
</body>
</html>
