@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ringkasan Laporan</h2>
    <div class="row" style="gap: 20px;">
        <!-- Kolom 1: Laporan -->
        <div class="col" style="background: #f8fafd; border-radius: 10px; padding: 20px; min-width: 260px;">
            <h5 style="color: #2196f3;">&#9679; Laporan</h5>
            @foreach($statusCounts as $status)
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span>{{ $status->status }}</span>
                    <span>{{ $status->total }}</span>
                </div>
            @endforeach
        </div>
        <!-- Kolom 2: Jenis Kerusakan -->
        <div class="col" style="background: #f6fcf8; border-radius: 10px; padding: 20px; min-width: 260px;">
            <h5 style="color: #4caf50;">&#9679; Kerusakan</h5>
            @foreach($kategoriCounts as $kategori)
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span>{{ $kategori->kategori }}</span>
                    <span>{{ $kategori->total }}</span>
                </div>
            @endforeach
        </div>
        <!-- Kolom 3: Kondisi Lapangan -->
        <div class="col" style="background: #fff7f7; border-radius: 10px; padding: 20px; min-width: 260px;">
            <h5 style="color: #f44336;">&#9679; Kondisi Lapangan</h5>
            @foreach($kondisiCounts as $kondisi)
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span>{{ $kondisi->kondisi_lapangan }}</span>
                    <span>{{ $kondisi->total }}</span>
                </div>
            @endforeach
            <div style="margin-top: 20px; text-align: center;">
                <span style="color: #f44336; font-size: 2em;">&#9888;</span>
                <p style="color: #f44336;">Kategori yang memiliki potensi viral di masyarakat</p>
            </div>
        </div>
    </div>
</div>
@endsection
