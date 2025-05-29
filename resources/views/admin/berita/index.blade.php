@extends('layouts.adminlayout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Berita</h1>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Berita
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Isi</th>
                            <th>Tanggal Terbit</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beritas as $berita)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($berita->gambar)
                                    <img src="{{ Storage::url($berita->gambar) }}" alt="Gambar Berita" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $berita->judul }}</td>
                            <td>{{ $berita->kategori }}</td>
                            <td>{{ Str::limit(strip_tags($berita->isi), 50) }}</td>
                            <td>{{ $berita->tanggal_terbit->format('d M Y') }}</td>
                            <td>
                                @php
                                    $statusClass = [
                                        'draft' => 'bg-secondary',
                                        'published' => 'bg-success'
                                    ][$berita->status] ?? 'bg-secondary';
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ ucfirst($berita->status) }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada berita</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $beritas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
