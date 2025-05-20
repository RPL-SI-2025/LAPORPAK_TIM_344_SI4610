<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporan = Laporan::query();

        // Filter
        if ($request->filled('status')) {
            $laporan->where('status', $request->status);
        }

        // Ganti filter tanggal_lapor ke created_at
        if ($request->filled('tanggal')) {
            $laporan->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('jenis')) {
            $laporan->where('jenis_laporan', $request->jenis);
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'terbaru':
                    $laporan->orderBy('created_at', 'desc');
                    break;
                case 'prioritas':
                    $laporan->orderBy('prioritas', 'desc');
                    break;
                case 'status':
                    $laporan->orderBy('status');
                    break;
            }
        } else {
            $laporan->orderBy('created_at', 'desc'); // Default sort
        }

        $laporans = $laporan->paginate(10);

        return view('admin.laporan.index', compact('laporans'));
    }

    public function updateStatus(Request $request, Laporan $laporan)
    {
        $validStatuses = [
            'diajukan', 'diverifikasi', 'diterima', 'ditolak', 'ditindaklanjuti', 'ditanggapi', 'selesai'
        ];

        $request->validate([
            'status' => 'required|in:' . implode(',', $validStatuses)
        ]);

        // Save the previous status to check if it's changed
        $oldStatus = $laporan->status;

        // Update status
        $laporan->status = $request->status;
        $laporan->save();

        // Sinkronkan status ke complaint jika ada relasi nomor laporan
        $complaint = \App\Models\Complaint::where('name', $laporan->nomor_laporan)->first();
        if ($complaint) {
            $complaint->status = $request->status;
            $complaint->save();
        }

        // Create notification for the user who submitted the laporan
        // Check if laporan has user_id and status is updated to "diajukan"
        if ($laporan->user_id && $request->status === 'selesai') {
            try {
                $nextEndpoint = route('users.feedback', ['laporan' => $laporan->nomor_laporan]);

                $notificationData = [
                    'title' => 'Status Laporan Diperbarui',
                    'message' => 'Laporan nomor ' . $laporan->nomor_laporan . ' telah selesai.',
                    'laporan_id' => $laporan->id,
                    'nomor_laporan' => $laporan->nomor_laporan,
                    'status' => $laporan->status,
                    'updated_at' => now()->toISOString(),
                    'next_endpoint' => $nextEndpoint
                ];

                // Create notification
                $notification = new Notification();
                $notification->user_id = $laporan->user_id;
                $notification->type = 'info';
                $notification->data = $notificationData;
                $notification->read_at = null;
                $notification->save();

                Log::info('Notification created for user #' . $laporan->user_id . ' for laporan #' . $laporan->id);
            } catch (\Exception $e) {
                Log::error('Failed to create notification: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui');
    }

    public function detail($id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);

        return view('admin.laporan.detaillaporan', compact('laporan'));
    }

    public function show(Laporan $laporan)
    {
        return view('admin.laporan.show', compact('laporan'));
    }
}
