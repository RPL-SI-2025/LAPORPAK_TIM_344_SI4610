@extends('layouts.app')

@section('content')
<style>
    .custom-feedback-card {
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.09);
        font-family: 'Poppins', 'Roboto', sans-serif;
    }
    .custom-feedback-header {
        background: linear-gradient(90deg, #ff8c42 0%, #ff3c3c 100%);
        color: #fff;
        border-radius: 18px 18px 0 0;
        font-weight: 600;
        font-size: 1.2rem;
        letter-spacing: 0.5px;
    }
    .custom-btn-submit {
        background: linear-gradient(90deg, #ff8c42 0%, #ff3c3c 100%);
        color: #fff;
        border: none;
        font-weight: 500;
        border-radius: 8px;
        transition: background 0.2s;
    }
    .custom-btn-submit:hover {
        background: linear-gradient(90deg, #ff3c3c 0%, #ff8c42 100%);
        color: #fff;
    }
    .star-icon {
    font-size: 2rem;
    color: #e0e0e0;
    margin-right: 3px;
    cursor: pointer;
    transition: color 0.2s;
    user-select: none;
}
.star-icon.star {
    color: #ffb400;
}
.star-icon.star-outline {
    color: #e0e0e0;
}
</style>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card custom-feedback-card">
                <div class="card-header custom-feedback-header">
                    <i class="fa fa-comment-dots me-2"></i> Beri Feedback untuk Laporan <span style="font-weight:700;">#{{ $laporan->nomor_laporan }}</span>
                </div>
                <div class="card-body p-4">
    @if($laporan->feedbackAdmin && $laporan->feedbackAdmin->feedback_file)
        <div class="mb-4">
            <label class="form-label fw-semibold mb-2">Bukti Perbaikan dari Admin:</label>
            <div class="bg-light p-3 rounded shadow-sm">
                @php
                    $file = $laporan->feedbackAdmin->feedback_file;
                    $isImage = preg_match('/\.(jpg|jpeg|png)$/i', $file);
                @endphp
                @if($isImage)
                    <img src="{{ asset('storage/' . $file) }}" alt="Bukti Perbaikan" class="img-fluid rounded mb-2" style="max-width:300px; max-height:220px;">
                    <div><a href="{{ asset('storage/' . $file) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Gambar Besar</a></div>
                @else
                    <a href="{{ asset('storage/' . $file) }}" target="_blank" class="btn btn-sm btn-outline-primary">Download Bukti (PDF)</a>
                @endif
            </div>
        </div>
    @endif
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('laporan.feedbackUser', $laporan->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <div id="star-rating" class="mb-2">
    @for($i=1;$i<=5;$i++)
        <span class="star-icon star-outline" data-value="{{ $i }}">&#9733;</span>
    @endfor
</div>
                            <select class="form-select d-none" id="rating" name="rating" required>
                                <option value="">-- Pilih Rating --</option>
                                @for($i=1;$i<=5;$i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="3" required placeholder="Tulis pesan atau saran Anda di sini..."></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn custom-btn-submit">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Star rating interaktif tanpa FontAwesome, hanya pakai span
    document.addEventListener('DOMContentLoaded', function() {
        try {
            const stars = document.querySelectorAll('#star-rating .star-icon');
            const ratingSelect = document.getElementById('rating');
            let selected = 0;
            function updateStars() {
                stars.forEach((s, i) => {
                    if (i < selected) {
                        s.classList.add('star');
                        s.classList.remove('star-outline');
                    } else {
                        s.classList.remove('star');
                        s.classList.add('star-outline');
                    }
                });
            }
            stars.forEach(function(star, idx) {
                star.addEventListener('mouseover', function(e) {
                    stars.forEach((s, i) => {
                        if (i <= idx) {
                            s.classList.add('star');
                            s.classList.remove('star-outline');
                        } else {
                            s.classList.remove('star');
                            s.classList.add('star-outline');
                        }
                    });
                });
                star.addEventListener('mouseout', function(e) {
                    updateStars();
                });
                star.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    selected = idx + 1;
                    ratingSelect.value = selected;
                    updateStars();
                    console.log('Star clicked:', selected);
                });
            });
            // Inisialisasi awal
            updateStars();
        } catch (err) {
            console.error('Star rating error:', err);
        }
    });
</script>
@endsection
