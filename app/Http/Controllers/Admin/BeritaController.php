<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:50',
            'isi' => 'required|string',
            'tanggal_terbit' => 'required|date',
            'status' => 'required|in:draft,publish',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('gambar');
        
        // Bersihkan HTML dari atribut yang tidak perlu
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->isi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        // Hapus semua atribut data-*
        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->query('//*[@*[starts-with(name(), "data-")]]');
        foreach ($nodes as $node) {
            $attributes = $node->attributes;
            $i = $attributes->length;
            while ($i--) {
                $attr = $attributes->item($i);
                if (strpos($attr->name, 'data-') === 0) {
                    $node->removeAttribute($attr->name);
                }
            }
        }
        
        // Konversi kembali ke string
        $data['isi'] = $dom->saveHTML();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
            // Pastikan folder berita ada
            if (!Storage::disk('public')->exists('berita')) {
                Storage::disk('public')->makeDirectory('berita');
            }
            // Simpan gambar
            $path = $request->file('gambar')->storeAs('berita', $nama_gambar, 'public');
            $data['gambar'] = $path;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:50',
            'isi' => 'required|string',
            'tanggal_terbit' => 'required|date',
            'status' => 'required|in:draft,publish',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $berita = Berita::findOrFail($id);
        $data = $request->except('gambar');

        // Bersihkan HTML dari atribut yang tidak perlu
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->isi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        // Hapus semua atribut data-*
        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->query('//*[@*[starts-with(name(), "data-")]]');
        foreach ($nodes as $node) {
            $attributes = $node->attributes;
            $i = $attributes->length;
            while ($i--) {
                $attr = $attributes->item($i);
                if (strpos($attr->name, 'data-') === 0) {
                    $node->removeAttribute($attr->name);
                }
            }
        }
        
        // Konversi kembali ke string
        $data['isi'] = $dom->saveHTML();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $gambar = $request->file('gambar');
            $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs('berita', $nama_gambar, 'public');
            $data['gambar'] = $path;
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
