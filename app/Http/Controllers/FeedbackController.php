<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display the feedback form.
     *
     * @param string $laporan Laporan ID or nomor_laporan
     * @return \Illuminate\Http\Response
     */
    public function index($laporan)
    {
        $laporanModel = Laporan::where('nomor_laporan', $laporan)
            ->orWhere('id', $laporan)
            ->firstOrFail();

        // Check if feedback already exists for this laporan
        $existingFeedback = Feedback::where('laporan_id', $laporanModel->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingFeedback) {
            return redirect()->route('user.dashboard')->with('info', 'Anda sudah memberikan feedback untuk laporan ini.');
        }

        return view('users.feedback', compact('laporanModel'));
    }

    /**
     * Handle feedback submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
        $request->validate([
            'laporan_id' => 'required|exists:laporans,id',
            'rating' => 'required|integer|min:1|max:5',
            'kategori_feedback' => 'required|string|max:255',
            'pesan_feedback' => 'required|string',
            'setuju' => 'required|accepted',
        ]);

        try {
            // Check if feedback already exists
            $existingFeedback = Feedback::where('laporan_id', $request->laporan_id)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingFeedback) {
                return redirect()->route('user.dashboard')->with('info', 'Anda sudah memberikan feedback untuk laporan ini.');
            }

            // Create new feedback
            $feedback = new Feedback();
            $feedback->user_id = Auth::id();
            $feedback->laporan_id = $request->laporan_id;
            $feedback->rating = $request->rating;
            $feedback->kategori = $request->kategori_feedback;
            $feedback->pesan = $request->pesan_feedback;
            $feedback->saran = $request->saran_perbaikan ?? null;
            $feedback->save();

            return redirect()->route('user.dashboard')->with('success', 'Terima kasih! Feedback Anda telah berhasil dikirim.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim feedback: ' . $e->getMessage())->withInput();
        }
    }
}
