@extends('layouts.adminlayout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detail Berita</h1>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h2>{{ $berita->judul }}</h2>
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $berita->kategori }}</span>
                        <span class="badge {{ $berita->status == 'publish' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($berita->status) }}
                        </span>
                        <span class="text-muted ms-2">
                            <i class="bi bi-calendar"></i> {{ $berita->tanggal_terbit->format('d M Y') }}
                        </span>
                    </div>
                    
                    @if($berita->gambar)
                        <div class="mb-4">
                            <img src="/storage/{{ $berita->gambar }}" alt="Gambar Berita" class="img-fluid rounded" style="max-height: 400px;">
                        </div>
                    @endif

                    <div class="berita-content">
                        {!! $berita->isi !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Informasi</h5>
                        </div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                <small class="text-muted d-block">Dibuat pada</small>
                                {{ $berita->created_at->format('d M Y H:i') }}
                            </div>
                            <div class="list-group-item">
                                <small class="text-muted d-block">Terakhir diupdate</small>
                                {{ $berita->updated_at->format('d M Y H:i') }}
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-warning w-100 mb-2">
                                <i class="bi bi-pencil"></i> Edit Berita
                            </a>
                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    <i class="bi bi-trash"></i> Hapus Berita
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
