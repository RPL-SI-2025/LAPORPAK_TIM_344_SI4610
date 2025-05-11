@extends('layouts.adminlayout')

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4" style="font-size:2rem; color:#232b44; font-family:'Poppins', 'Roboto', Arial, sans-serif;">
        Tambah FAQ
    </h1>
    <!-- Tombol Reset di luar card/form -->
    <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
        <button 
            type="button" 
            onclick="document.getElementById('faqForm').reset();"
            style="background:#FFFF; color:#FFB84C; border:1.5px solid #FFB84C; border-radius:8px; padding:4px 26px; font-weight:400; font-size:1rem; cursor:pointer;">
            Reset
        </button>
    </div>
    <div class="d-flex justify-content-center">
        <div style="
            border:1px solid rgb(160, 168, 174);
            border-radius:10px;
            padding:32px 36px;
            background:#fff;
            max-width:1100px;
            width:100%;
            box-sizing:border-box;
            margin:0 auto;
        ">
            <form id="faqForm" action="{{ route('admin.faq.store') }}" method="POST">
                @csrf
                <div style="margin-bottom:24px;">
                    <label for="question" style="display:block; font-family:'Poppins', 'Roboto', Arial, sans-serif; font-weight:600; font-size:1.1rem; color:#444; margin-bottom:8px;">
                        Pertanyaan
                    </label>
                    <input
                        type="text"
                        name="question"
                        id="question"
                        value="{{ old('question') }}"
                        required
                        style="width:100%; border:2px solid #FFB84C; border-radius:10px; padding:14px 12px; font-size:1rem; font-family:'Poppins', 'Roboto', Arial, sans-serif; color:#333; background:#fff; margin-bottom:0; box-sizing:border-box;"
                        placeholder="Contoh: Bagaimana cara membuat laporan di LaporPak?"
                    >
                    @error('question')
                        <div class="invalid-feedback" style="color:#dc3545;">{{ $message }}</div>
                    @enderror
                </div>
                <div style="margin-bottom:24px;">
                    <label for="answer" style="display:block; font-family:'Poppins', 'Roboto', Arial, sans-serif; font-weight:600; font-size:1.1rem; color:#444; margin-bottom:6px;">
                        Jawaban
                    </label>
                    <textarea
                        name="answer"
                        id="answer"
                        rows="9"
                        required
                        style="width:100%; border:2px solid #FFB84C; border-radius:10px; padding:14px 12px; font-size:1rem; font-family:'Poppins', 'Roboto', Arial, sans-serif; color:#333; background:#fff; resize:vertical; box-sizing:border-box;"
                        placeholder="Contoh: LaporPak adalah platform digital yang memungkinkan masyarakat untuk melaporkan keluhan, saran, atau pelanggaran terkait layanan publik secara cepat dan transparan. Pengguna hanya perlu mengisi formulir pelaporan yang tersedia, melengkapi bukti pendukung jika diperlukan, lalu sistem akan menyalurkan laporan tersebut ke instansi terkait untuk ditindaklanjuti."
                    >{{ old('answer') }}</textarea>
                    @error('answer')
                        <div class="invalid-feedback" style="color:#dc3545;">{{ $message }}</div>
                    @enderror
                </div>
            </form>
        </div>
    </div>
    {{-- Tombol di luar card --}}
    <div style="display:flex; justify-content:center; gap:28px; margin-top:32px;">
        <a href="{{ route('admin.faq.index') }}"
           style="background:#00C853; color:#fff; font-weight:530; font-size:1rem; border:none; border-radius:10px; padding:8px 30px; text-decoration:none; text-align:center;">
            Kembali
        </a>
        <button type="button"
                id="submitBtn"
                style="background:#FFB84C; color:#fff; font-weight:530; font-size:1rem; border:none; border-radius:10px; padding:8px 32px;">
            Submit
        </button>
    </div>
</div>
<script>
document.getElementById('submitBtn').addEventListener('click', function(e) {
    const form = document.getElementById('faqForm');
    const question = form.querySelector('[name="question"]');
    const answer = form.querySelector('[name="answer"]');
    if (!question.value.trim() || !answer.value.trim()) {
        alert('Fill the required column');
        return;
    }
    form.submit();
});
</script>
@endsection