<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the feedbacks.
     */
    public function index()
    {
        // Laporan yang belum ada feedback (pending)
        $pendingLaporans = Laporan::whereDoesntHave('feedback')
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'pending_page');

        // Laporan yang sudah ada feedback (completed)
        $completedLaporans = Laporan::whereHas('feedback')
            ->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'completed_page');

        return view('admin.feedback.index', compact('pendingLaporans', 'completedLaporans'));
    }

    /**
     * Show the form for creating a new feedback (opsional, jika admin ingin menambah manual)
     */
    public function create(Request $request)
    {
        $laporans = Laporan::all();
        $selectedLaporanId = $request->laporan_id ?? null;
        return view('admin.feedback.create', compact('laporans', 'selectedLaporanId'));
    }

    /**
     * Store a newly created feedback (opsional)
     */
    public function store(Request $request)
    {
        $request->validate([
            'laporan_id' => 'required|exists:laporans,id',
            'user_id' => 'required|exists:users,id',
            'file_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        // Ambil kategori dari laporan terkait
        $laporan = Laporan::findOrFail($request->laporan_id);
        $data = $request->only(['laporan_id', 'user_id']);
        $data['kategori'] = $laporan->kategori;
        // Simpan file bukti
        if ($request->hasFile('file_proof')) {
            $file = $request->file('file_proof');
            $path = $file->store('feedback_proof', 'public');
            $data['feedback_file'] = $path;
        }
        // Pastikan kolom rating, pesan, saran diisi null agar tidak error
        $data['rating'] = null;
        $data['pesan'] = null;
        $data['saran'] = null;
        $feedback = Feedback::create($data);
        // Kirim notifikasi ke user pelapor agar mengisi feedback user
        if ($laporan->user) {
            $laporan->user->notify(new \App\Notifications\FeedbackUserRequest($laporan));
        }
        return redirect()->route('admin.feedback.index')->with('success', 'Feedback berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified feedback (opsional)
     */
    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('admin.feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified feedback (opsional)
     */
    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->update($request->all());
        return redirect()->route('admin.feedback.index')->with('success', 'Feedback berhasil diperbarui!');
    }

    /**
     * Remove the specified feedback (opsional)
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return redirect()->route('admin.feedback.index')->with('success', 'Feedback berhasil dihapus!');
    }
}
