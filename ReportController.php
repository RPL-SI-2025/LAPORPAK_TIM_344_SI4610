<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('track-report');
    }

    public function track(Request $request)
    {
        $request->validate([
            'report_number' => 'required|string',
        ]);

        $report = Report::findByNomorLaporan($request->input('report_number'));

        if ($report) {
            return view('report.result', compact('report'));
        }

        return view('report.notfound', ['nomor_laporan' => $request->input('report_number')]);
    }
}
