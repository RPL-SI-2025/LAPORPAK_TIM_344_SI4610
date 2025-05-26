@extends('layouts.app')

@section('content')
<style>
  body {
    background: #f8f9fb;
    font-family: 'Poppins', 'Poppins', sans-serif;
    color: #222;
    margin: 0;
    padding: 0;
  }
  .accordion-body, .accordion-collapse.show, .accordion-collapse.collapse.show {
    color: #222 !important;
    background: #fff !important;
    min-height: 40px !important;
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
  }
  .about-header {
    background: linear-gradient(90deg,#2d7ff9 0%, #fbb03b 100%);
    color: #fff;
    padding: 56px 0 40px 0;
    text-align: center;
    border-radius: 0 0 36px 36px;
    margin-bottom: 2.5rem;
  }
  .about-header h1 {
    font-weight: 700;
    font-size: 2.6rem;
    margin-bottom: 10px;
    letter-spacing: 1px;
  }
  .about-header p {
    font-size: 1.2rem;
    opacity: 0.93;
    margin-bottom: 0;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
  }
  .about-section {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 2px 12px rgba(44,62,80,0.05);
    padding: 40px 32px 32px 32px;
    max-width: 900px;
    margin: 0 auto 2.5rem auto;
  }
  .about-section h2 {
    color: #2d7ff9;
    font-weight: 700;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
  }
  .accordion-item {
    border: none;
    border-radius: 12px;
    margin-bottom: 1rem;
    background: #f8f9fa;
  }
  .accordion-button {
    background: #f8f9fa !important;
    color: #2d7ff9;
    font-weight: 600;
    padding: 1rem 1.5rem;
    border: none;
    border-radius: 12px;
    transition: all 0.3s ease;
  }
  .accordion-button:not(.collapsed) {
    background: #fff !important;
    color: #2d7ff9;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
  }
  .accordion-button:focus {
    border-color: #2d7ff9;
    box-shadow: 0 0 0 2px rgba(45,127,249,0.25);
  }
  .accordion-body {
    background: #fff;
    padding: 1.5rem 1.5rem 1rem 1.5rem;
    border-radius: 0 0 12px 12px;
  }
  .accordion-body p {
    color: #333;
    line-height: 1.6;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
  }
  .about-highlight {
    background: #fbb03b;
    color: #fff;
    display: inline-block;
    padding: 2px 12px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1.04em;
    margin-bottom: 10px;
  }
  .about-footer {
    background: #fff;
    padding: 24px 0 8px 0;
    border-radius: 36px 36px 0 0;
    text-align: center;
    margin-top: 3rem;
  }
  .about-footer small {
    opacity: 0.8;
  }
  @media (max-width: 600px) {
    .about-header h1 { font-size: 2rem; }
    .about-section { padding: 22px 8px; }
  }
</style>
{{-- Pastikan JS Bootstrap sudah di-include di layout utama agar accordion berfungsi --}}
<div class="about-header position-relative">
  <a href="javascript:history.back()" class="btn btn-light rounded-circle shadow-sm position-absolute top-0 start-0 m-4" title="Kembali" style="z-index:2;">
    <i class="bi bi-arrow-left" style="font-size:1.3rem;"></i>
  </a>
  <h1>FREQUENTLY ASK QUESTION</h1>
  <p>Punya pertanyaan mengenai LaporPak? Silakan telusuri daftar Pertanyaan yang Sering Diajukan (FAQ) berikut ini untuk mendapatkan informasi yang Anda butuhkan.</p>
</div>
<section class="about-section">
  @if($faqs && $faqs->count() > 0)
    <div class="accordion" id="faqAccordion">
      @foreach($faqs as $faq)
        <div class="accordion-item mb-3">
          <h2 class="accordion-header" id="heading{{ $loop->index }}">
            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
              {{ $faq->question }}
            </button>
          </h2>
          <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              {!! nl2br(e($faq->answer)) !!}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="text-center text-muted py-5">
      <em>Belum ada pertanyaan yang tersedia.</em>
    </div>
  @endif
</section>
<footer class="about-footer">
  <div>
    <b>LaporPak!</b> &copy; 2025 &middot; Untuk Infrastruktur Indonesia yang Lebih Baik<br>
    <small>Dikembangkan oleh Tim LaporPak</small>
  </div>
</footer>
@endsection
