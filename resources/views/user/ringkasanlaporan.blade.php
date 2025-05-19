@extends('layouts.app')

@section('content')
<style>
    .summary-card {
        border-radius: 16px;
        box-shadow: 0 2px 8px #0001;
        padding: 1.5rem 1.5rem 1rem 1.5rem;
        min-width: 270px;
        background: #fff;
        margin-bottom: 1rem;
    }
    .summary-icon {
        font-size: 1.6rem;
        margin-right: 10px;
        vertical-align: middle;
    }
    .laporan-col {
        background: #f8fafd;
        border: 2px solid #2196f3;
    }
    .kerusakan-col {
        background: #f6fcf8;
        border: 2px solid #4caf50;
    }
    .kondisi-col {
        background: #fff7f7;
        border: 2px solid #f44336;
    }
    .summary-title {
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        font-size: 1rem;
    }
    .summary-icon-box {
        width: 28px;
        display: inline-block;
        text-align: center;
    }
    .summary-alert {
        margin-top: 32px;
        text-align: center;
    }
    .summary-alert-icon {
        color: #f44336;
        font-size: 2.8em;
    }
    .btn-kembali {
        margin-top: 30px;
        margin-bottom: 10px;
    }
</style>
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="fw-bold mb-0">Ringkasan Laporan</h4>
        <button type="button" onclick="window.history.back()" class="btn btn-outline-primary btn-sm btn-kembali">
    <i class="bi bi-arrow-left"></i> Kembali
</button>
    </div>
    <div class="d-flex flex-wrap justify-content-center gap-4">
        <!-- Kolom 1: Laporan -->
        <div class="summary-card laporan-col flex-grow-1">
            <div class="summary-title text-primary">
                <span class="summary-icon-box"><i class="bi bi-clipboard-check summary-icon text-primary"></i></span> Laporan
                <span class="badge bg-primary ms-2">{{ $statusCounts->sum('total') }}</span>
            </div>
            @foreach($statusCounts as $status)
                <div class="summary-row">
                    <span>
                        @if(strtolower($status->status) == 'diajukan')
                            <i class="bi bi-file-earmark-plus text-secondary"></i>
                        @elseif(strtolower($status->status) == 'diterima')
                            <i class="bi bi-check-circle-fill text-primary"></i>
                        @elseif(strtolower($status->status) == 'ditolak')
                            <i class="bi bi-x-circle-fill text-danger"></i>
                        @elseif(strtolower($status->status) == 'ditindaklanjuti')
                            <i class="bi bi-arrow-repeat text-warning"></i>
                        @elseif(strtolower($status->status) == 'selesai')
                            <i class="bi bi-check2-all text-success"></i>
                        @else
                            <i class="bi bi-dot"></i>
                        @endif
                        {{ ucfirst($status->status) }}
                    </span>
                    <span class="fw-bold">{{ $status->total }}</span>
                </div>
            @endforeach
        </div>
        <!-- Kolom 2: Jenis Kerusakan -->
        <div class="summary-card kerusakan-col flex-grow-1">
            <div class="summary-title text-success">
                <span class="summary-icon-box"><i class="bi bi-tools summary-icon text-success"></i></span> Kerusakan
                <span class="badge bg-success ms-2">{{ $kategoriCounts->sum('total') }}</span>
            </div>
            @foreach($kategoriCounts as $kategori)
                <div class="summary-row">
                    <span>
                        @if(str_contains(strtolower($kategori->kategori), 'jalan'))
                            <i class="bi bi-signpost-2-fill text-secondary"></i>
                        @elseif(str_contains(strtolower($kategori->kategori), 'trotoar'))
                            <i class="bi bi-border-width text-primary"></i>
                        @elseif(str_contains(strtolower($kategori->kategori), 'perlengkapan'))
                            <i class="bi bi-tools text-warning"></i>
                        @elseif(str_contains(strtolower($kategori->kategori), 'darurat') || str_contains(strtolower($kategori->kategori), 'banjir'))
                            <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                        @else
                            <i class="bi bi-dot"></i>
                        @endif
                        {{ $kategori->kategori }}
                    </span>
                    <span class="fw-bold">{{ $kategori->total }}</span>
                </div>
            @endforeach
        </div>
        <!-- Kolom 3: Kondisi Lapangan -->
        <div class="summary-card kondisi-col flex-grow-1">
            <div class="summary-title text-danger">
                <span class="summary-icon-box"><i class="bi bi-exclamation-circle-fill summary-icon text-danger"></i></span> Kondisi Lapangan
                <span class="badge bg-danger ms-2">{{ $kondisiCounts->sum('total') }}</span>
            </div>
            @foreach($kondisiCounts as $kondisi)
                <div class="summary-row">
                    <span>
                        @if(str_contains(strtolower($kondisi->kondisi_lapangan), 'darurat'))
                            <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                        @elseif(str_contains(strtolower($kondisi->kondisi_lapangan), 'perlu diperbaiki'))
                            <i class="bi bi-tools text-warning"></i>
                        @else
                            <i class="bi bi-dot"></i>
                        @endif
                        {{ $kondisi->kondisi_lapangan }}
                    </span>
                    <span class="fw-bold">{{ $kondisi->total }}</span>
                </div>
            @endforeach
            <div class="summary-alert">
                <i class="bi bi-exclamation-triangle-fill summary-alert-icon"></i>
                <p class="mt-2" style="color: #f44336;">Kategori yang memiliki potensi viral di masyarakat</p>
            </div>
        </div>
    </div>
</div>
@endsection
