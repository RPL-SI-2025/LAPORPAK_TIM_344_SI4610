<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the feedback.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get laporans that don't have feedback (pending)
        $pendingLaporans = Laporan::whereNull('feedback_file')
            ->latest()
            ->paginate(10, ['*'], 'pending_page');

        // Get laporans with feedback (completed)
        $completedLaporans = Laporan::whereNotNull('feedback_file')
            ->latest()
            ->paginate(10, ['*'], 'completed_page');

        return view('admin.feedback.index', compact('pendingLaporans', 'completedLaporans'));
    }

    /**
     * Show the form for creating a new feedback.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Get the selected laporan ID from the request
        $selectedLaporanId = $request->input('laporan_id');

        // Cast to integer if not null
        if ($selectedLaporanId) {
            $selectedLaporanId = (int) $selectedLaporanId;
        }

        // First get all available laporans for the dropdown
        $query = Laporan::whereNull('feedback_file')
            ->whereIn('status', ['diproses', 'selesai'])
            ->orderBy('nomor_laporan');

        // Get the filtered laporans
        $laporans = $query->get();

        // If we have a selected ID, make sure it's included in the collection
        if ($selectedLaporanId) {
            // Get the selected laporan
            $selectedLaporan = Laporan::find($selectedLaporanId);

            if ($selectedLaporan) {
                // Check if it's already in the collection
                $containsSelected = $laporans->contains('id', $selectedLaporanId);

                if (!$containsSelected) {
                    // Add it to the collection if not already there
                    $laporans->prepend($selectedLaporan);
                }
            }
        }

        // Log info for debugging
        Log::info('Selected Laporan ID: ' . ($selectedLaporanId ?? 'null'));
        Log::info('Available Laporan IDs: ' . $laporans->pluck('id')->join(', '));

        return view('admin.feedback.create', compact('laporans', 'selectedLaporanId'));
    }

    /**
     * Store a newly created feedback in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'laporan_id' => 'required|exists:laporans,id',
            'file_proof' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        try {
            $laporan = Laporan::findOrFail($request->laporan_id);

            // Upload file
            $filePath = $request->file('file_proof')->store('feedback_proofs', 'public');

            // Update laporan
            $laporan->feedback_file = $filePath;
            $laporan->status = 'selesai';

            // send notification to user
            $notificationData = [
                'title' => 'Status Laporan Diperbarui',
                'message' => 'Laporan nomor ' . $laporan->nomor_laporan . ' telah selesai.',
                'laporan_id' => $laporan->id,
                'nomor_laporan' => $laporan->nomor_laporan,
                'status' => $laporan->status,
                'updated_at' => now()->toISOString(),
                'next_endpoint' => route('users.feedback', ['laporan' => $laporan->nomor_laporan]),
            ];

            $notification = new Notification();
            $notification->user_id = $laporan->user_id;
            $notification->type = 'info';
            $notification->data = $notificationData;
            $notification->read_at = null;
            $notification->save();

            $laporan->save();

            // If this was submitted from the index page, return to index
            if ($request->has('from_index')) {
                return redirect()->route('admin.feedback.index')->with('success', 'Bukti feedback berhasil disimpan.');
            }

            return redirect()->route('admin.feedback.index')->with('success', 'Bukti feedback berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified feedback.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);

        if (!$laporan->feedback_file) {
            return redirect()->route('admin.feedback.index')
                ->with('error', 'Laporan ini belum memiliki feedback.');
        }

        return view('admin.feedback.edit', compact('laporan'));
    }

    /**
     * Update the specified feedback in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'file_proof' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        try {
            $laporan = Laporan::findOrFail($id);

            // Handle file upload if a new file is provided
            if ($request->hasFile('file_proof')) {
                // Delete old file
                if ($laporan->feedback_file) {
                    Storage::disk('public')->delete($laporan->feedback_file);
                }

                // Upload new file
                $filePath = $request->file('file_proof')->store('feedback_proofs', 'public');
                $laporan->feedback_file = $filePath;
                $laporan->save();
            }

            return redirect()->route('admin.feedback.index')->with('success', 'Bukti feedback berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified feedback from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $laporan = Laporan::findOrFail($id);

            // Delete the file
            if ($laporan->feedback_file) {
                Storage::disk('public')->delete($laporan->feedback_file);
            }

            // Clear the feedback_file field
            $laporan->feedback_file = null;
            $laporan->save();

            return redirect()->route('admin.feedback.index')->with('success', 'Bukti feedback berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
