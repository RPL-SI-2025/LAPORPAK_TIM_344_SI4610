@extends('layouts.adminlayout')

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4" style="font-size:2rem; color:#232b44; font-family:'Poppins', 'Roboto', Arial, sans-serif;">
        Frequently Ask Question
    </h1>
    <div class="mb-3">
        <a href="{{ route('admin.faq.create') }}" class="btn" style="background:#FFB84C; color:#fff; font-weight:530; border-radius:12px; padding:8px 30px;">
            Buat FAQ
        </a>
    </div>
    <!-- Content -->
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th style="background:#F1F4F9; width:50px; color:#232b44; text-align:center; vertical-align:middle; font-weight:600; font-family:'Poppins', 'Roboto', Arial, sans-serif;">
                        No
                    </th>
                    <th style="background:#F1F4F9; color:#232b44; text-align:center; vertical-align:middle; font-weight:600; font-family:'Poppins', 'Roboto', Arial, sans-serif;">
                        FAQ
                    </th>
                    <th style="background:#F1F4F9; color:#232b44; text-align:center; vertical-align:middle; font-weight:600; font-family:'Poppins', 'Roboto', Arial, sans-serif;">
                        Answer
                    </th>
                    <th style="background:#F1F4F9; width:150px; color:#232b44; text-align:center; vertical-align:middle; font-weight:600; font-family:'Poppins', 'Roboto', Arial, sans-serif;">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach($faqs as $index => $faq)
            <tr>
                <td style="text-align:center; vertical-align:middle;">{{ $index + 1 }}</td>
                <td style="vertical-align:middle;">{{ $faq->question }}</td>
                <td style="vertical-align:middle;">{{ $faq->answer }}</td>
                <td style="vertical-align:middle;">
                <div style="display:flex; gap:8px;">
                    <a href="{{ route('admin.faq.edit', $faq->id) }}"
                        class="btn btn-info btn-sm"
                        style="background:#CFF4FC; color:#000; width:60px; height:28px; display:inline-flex; align-items:center; justify-content:center; font-weight:530; font-size:0.9rem; border-radius:8px; padding:0;">
                        Edit
                    </a>
                    <form action="{{ route('admin.faq.destroy', ['faq' => $faq->id]) }}" method="POST" class="d-inline" style="margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                style="background:#FFB6C1; color:#000; width:60px; height:28px; display:inline-flex; align-items:center; justify-content:center; font-weight:530; font-size:0.9rem; border-radius:8px; padding:0;">
                            Delete
                        </button>
                    </form>
                </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
    document.querySelectorAll('form button[type="submit"].btn-danger').forEach(function(btn){
        btn.addEventListener('click', function(e){
            if(!confirm('Apakah Anda yakin ingin menghapus FAQ?')) {
                e.preventDefault();
            }
        });
    });
    </script>
</div>
@endsection