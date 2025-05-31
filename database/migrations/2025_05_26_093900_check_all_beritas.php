<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('berita')) return;
        // Check all beritas
        $beritas = DB::table('berita')->orderBy('id', 'asc')->get();
        foreach ($beritas as $berita) {
            echo "ID: {$berita->id}\n";
            echo "Judul: {$berita->judul}\n";
            echo "Gambar: " . ($berita->gambar ?? 'null') . "\n";
            echo "-------------------\n";
        }
    }

    public function down(): void
    {
        //
    }
};
