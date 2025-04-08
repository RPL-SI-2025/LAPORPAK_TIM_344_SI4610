<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    // Tampilkan semua laporan
    public function index()
    {
        $laporan = Laporan::all();
        return view('laporan.index', compact('laporan'));
    }

    // Tampilkan form tambah laporan
    public function create()
    {
        return view('laporan.create');
    }

    // Simpan laporan baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:proses,selesai',
        ]);

        Laporan::create([
            'id_user' => auth()->id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $request->status,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    // Tampilkan detail laporan
    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('laporan.show', compact('laporan'));
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('laporan.edit', compact('laporan'));
    }

    // Update laporan
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:proses,selesai',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update($request->all());

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    // Hapus laporan
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
