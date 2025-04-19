<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    // Halaman form lacak laporan
    public function index()
    {
        return view('reports.track');
    }

    // Proses pencarian laporan
    public function search(Request $request)
    {
        $request->validate([
            'nomor_laporan' => 'required|string',
        ]);

        $nomorLaporan = $request->nomor_laporan;
        
        // Find the report by nomor_laporan
        $report = Report::where('nomor_laporan', $nomorLaporan)->first();
        
        if (!$report) {
            return back()->with('error', 'Nomor laporan tidak ditemukan');
        }

        // Update the report status based on progress
        if (!$report->status) {
            $report->status = 'Diajukan';
        }

        // Map status to the correct stage
        $statusMap = [
            'Diajukan' => 'Diajukan',           // Just submitted
            'Diproses' => 'Diproses',           // Being processed
            'Ditindaklanjuti' => 'Ditindaklanjuti', // In progress
            'Selesai' => 'Selesai'              // Completed
        ];

        $report->status = $statusMap[$report->status] ?? 'Diajukan';
        
        // Return the report details
        return view('reports.detail', ['report' => $report]);
    }

    // Menampilkan detail status laporan
    public function show($nomor_laporan)
    {
        $report = Report::where('nomor_laporan', $nomor_laporan)->first();

        if (!$report) {
            return redirect()->route('lacak-laporan')->with('error', 'Laporan tidak ditemukan');
        }

        return view('reports.detail', compact('report'));
    }
}
