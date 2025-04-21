<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    public function showForm(Request $request)
    {
        $success = $request->query('success');
        $errors = $request->query('errors');
        return view('form-laporan', compact('success', 'errors'));
    }

    public function submitLaporan(Request $request)
    {
        // Check if form is completely empty
        if ($request->except('_token') === []) {
            return response()->json([
                'message' => 'Tidak dapat mengirimkan laporan kosong'
            ], 400);
        }

        // Check if pernyataan is checked
        if (!$request->has('pernyataan')) {
            return response()->json([
                'message' => 'Ceklis pernyataan persetujuan'
            ], 400);
        }

        // Check if bukti laporan is provided
        if (!$request->hasFile('bukti_laporan')) {
            return response()->json([
                'message' => 'Lengkapi bukti kerusakan'
            ], 400);
        }

        // Validate required fields
        $validator = Validator::make($request->all(), [
            'lokasi_laporan' => 'required',
            'kategori_laporan' => 'required',
            'deskripsi_laporan' => 'required',
            'bukti_laporan' => 'required|file|max:2048', // max 2MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Lengkapi kolom yang kosong'
            ], 400);
        }

        // Store the bukti laporan
        $file = $request->file('bukti_laporan');
        $path = $file->store('bukti_laporan', 'public');

        // Here you would typically save the report to database
        // For now, we'll just return success response

        return response()->json([
            'message' => 'Laporan berhasil dikirim!'
        ], 200);
    }
}
