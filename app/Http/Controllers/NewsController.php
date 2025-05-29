<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        // Get featured news (latest 3 published news)
        $featuredNews = Berita::where('status', 'publish')
                            ->orderBy('tanggal_terbit', 'desc')
                            ->take(3)
                            ->get();

        // Get all published news
        $beritas = Berita::where('status', 'publish')
                        ->orderBy('tanggal_terbit', 'desc')
                        ->paginate(9);

        return view('news.index', compact('beritas', 'featuredNews'));
    }

    public function show($id)
    {
        $berita = Berita::where('status', 'publish')
                      ->where('id', $id)
                      ->firstOrFail();
        return view('news.show', compact('berita'));
    }
}
