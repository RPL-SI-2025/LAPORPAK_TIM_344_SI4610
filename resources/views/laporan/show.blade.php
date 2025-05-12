@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Laporan</h1>
        
        <!-- Jika laporan tidak ditemukan -->
        @if($laporan)
            <div class="card">
                <div class="card-header">
                    <h3>{{ $laporan->judul }}</h3>
                </div>
                <div class="card-body">
                    <p><strong>Deskripsi:</strong> {{ $laporan->deskripsi }}</p>
                    <p><strong>Tanggal Laporan:</strong> {{ $laporan->created_at->format('d M Y') }}</p>
                    <p><strong>Status:</strong> {{ $laporan->status }}</p>
                    <p><strong>Lokasi:</strong> {{ $laporan->lokasi }}</p>
                    
                    <!-- Tampilkan komentar jika ada -->
                    <h4>Komentar</h4>
                    @foreach($laporan->komentar as $komentar)
                        <div class="card my-2">
                            <div class="card-body">
                                <p><strong>{{ $komentar->user->name }}:</strong></p>
                                <p>{{ $komentar->komentar }}</p>
                                <p><small>{{ $komentar->created_at->format('d M Y H:i') }}</small></p>
                            </div>
                        </div>
                    @endforeach

                    <!-- Form untuk menambah komentar -->
                    <form action="{{ route('laporan.komentar', $laporan->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="komentar">Tambahkan Komentar</label>
                            <textarea name="komentar" id="komentar" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Kirim Komentar</button>
                    </form>
                </div>
            </div>
        @else
            <p>Laporan tidak ditemukan.</p>
        @endif
    </div>
@endsection
