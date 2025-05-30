@extends('layouts.adminlayout')

@section('title', 'Verifikasi Petugas')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Verifikasi Petugas</h2>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Status Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($petugas as $p)
                    <tr>
                        <td>{{ str_pad($p->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->kontak }}</td>
                        <td>
                            @if(isset($p->status_verifikasi))
                                <span class="badge {{ $p->status_verifikasi == 'terverifikasi' ? 'bg-success' : 'bg-warning' }}">
                                    {{ ucfirst($p->status_verifikasi) }}
                                </span>
                            @else
                                <span class="badge bg-secondary">Belum Diverifikasi</span>
                            @endif
                        </td>
                        <td>
                            <!-- Tombol aksi verifikasi, implementasi tergantung kebutuhan -->
                            <a href="#" class="btn btn-sm btn-success disabled">Verifikasi</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
