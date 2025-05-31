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
        // Check the first berita
        $berita = DB::table('berita')->orderBy('id', 'asc')->first();
        if ($berita) {
            echo "First Berita:\n";
            echo "ID: {$berita->id}\n";
            echo "Judul: {$berita->judul}\n";
            echo "Gambar: " . ($berita->gambar ?? 'null') . "\n";
        }
    }

    public function down(): void
    {
        //
    }
};
