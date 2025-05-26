@extends('layouts.adminlayout')

@section('title', 'Umpan Balik')

@section('head')
<style>
    body {
        background-color: #f5f7fb;
    }
    .container-fluid {
        max-width: 100%;
        padding: 0 24px;
    }
    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0,0,0,0.03);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .section-title {
        color: #333;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 16px;
    }
    .table {
        margin-bottom: 0;
    }
    .table th {
        background-color: #f8f9fa;
        color: #333;
        font-weight: 600;
        border-top: none;
        padding: 12px 16px;
    }
    .table td {
        padding: 16px;
        vertical-align: middle;
        border-color: #f0f0f0;
    }
    .table tbody tr:hover {
        background-color: #f9f9f9;
    }
    .month-select {
        background-color: #fff;
        border: 1px solid #e4e4e4;
        border-radius: 4px;
        color: #333;
        font-size: 14px;
        padding: 6px 12px;
        width: 120px;
    }
    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #e74c3c;
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        padding: 0;
    }
    .action-btn i {
        font-size: 16px;
    }
    .upload-btn {
        background-color: transparent;
        border: none;
        color: #666;
        display: inline-flex;
        align-items: center;
        font-size: 14px;
        padding: 8px 0;
        cursor: pointer;
    }
    .upload-btn svg, .upload-btn i {
        margin-right: 8px;
        width: 16px;
        height: 16px;
    }
    .status-label {
        font-size: 14px;
    }
    .status-pending {
        color: #FF9800;
    }
    .status-completed {
        color: #4CAF50;
    }
    .pagination {
        justify-content: center;
        margin-top: 16px;
    }
    .empty-message {
        text-align: center;
        padding: 24px;
        color: #666;
    }
    .rounded-image {
        width: 60px;
        height: 60px;
        border-radius: 4px;
        object-fit: cover;
    }
    .description-text {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4">
        <h1 class="h3">Umpan Balik</h1>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Belum Diupload Section -->
    <div class="mb-5">
        <div class="section-header">
            <h2 class="section-title">Belum Diupload</h2>
            <select class="month-select">
                <option selected>October</option>
                <option>November</option>
                <option>December</option>
            </select>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Gambar Perbaikan</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingLaporans as $laporan)
                        <tr>
                            <td>
                                @if($laporan->bukti_laporan)
                                    <img src="{{ asset('storage/' . $laporan->bukti_laporan) }}" alt="{{ $laporan->kategori }}" class="rounded-image">
                                @else
                                    <div style="width:60px;height:60px;border-radius:4px;background:#f5f5f5;display:flex;align-items:center;justify-content:center">
                                        <i data-feather="image" style="color:#aaa"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $laporan->kategori }}</td>
                            <td>{{ $laporan->lokasi }}</td>
                            <td>
                                <span class="status-label status-pending">
                                    {{ $laporan->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.feedback.create', ['laporan_id' => $laporan->id]) }}" class="action-btn">
                                    <i data-feather="arrow-right"></i>
                                </a>
                            </td>
                        </tr>
                        <tr style="border-top: none;">
                            <td colspan="5" style="padding-top: 0; border-top: none;">
                                <a href="{{ route('admin.feedback.create', ['laporan_id' => $laporan->id]) }}" class="upload-btn">
                                    <i data-feather="upload"></i> Upload Foto
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-message">Tidak ada laporan yang memerlukan bukti feedback.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $pendingLaporans->appends(['completed_page' => request('completed_page')])->links() }}
            </div>
        </div>
    </div>

    <!-- Selesai Section -->
    <div>
        <div class="section-header">
            <h2 class="section-title">Selesai</h2>
            <select class="month-select">
                <option selected>October</option>
                <option>November</option>
                <option>December</option>
            </select>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Gambar Perbaikan</th>
                            <th>Kategori</th>
                            <th>Nilai</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($completedLaporans as $laporan)
                        <tr>
                            <td>
                                @if(pathinfo($laporan->feedback_file, PATHINFO_EXTENSION) == 'pdf')
                                    <a href="{{ asset('storage/' . $laporan->feedback_file) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i data-feather="file-text"></i> PDF
                                    </a>
                                @else
                                    <img src="{{ asset('storage/' . $laporan->feedback_file) }}" alt="Bukti Feedback" class="rounded-image">
                                @endif
                            </td>
                            <td>{{ $laporan->kategori }}</td>
                            <td>4/5</td>
                            <td>{{ $laporan->updated_at->format('d.m.Y - H:i') }}</td>
                            <td class="description-text">
                                {{ $laporan->deskripsi ?? 'Tidak ada deskripsi' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-message">Belum ada bukti feedback yang tersimpan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $completedLaporans->appends(['pending_page' => request('pending_page')])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tabs
        var triggerTabList = [].slice.call(document.querySelectorAll('#feedbackTabs button'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)
            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        });
    });
</script>
@endsection
