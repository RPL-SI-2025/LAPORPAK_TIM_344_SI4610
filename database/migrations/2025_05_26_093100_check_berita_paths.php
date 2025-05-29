<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Check current paths
        $beritas = DB::table('berita')->whereNotNull('gambar')->get();
        foreach ($beritas as $berita) {
            echo "ID: {$berita->id}, Path: {$berita->gambar}\n";
        }
    }

    public function down(): void
    {
        //
    }
};
