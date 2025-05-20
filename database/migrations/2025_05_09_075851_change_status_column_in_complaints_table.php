<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStatusColumnInComplaintsTable extends Migration
{
    public function up()
    {
        // Mengubah kolom 'status' menjadi string (text) yang kompatibel dengan SQLite
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('status')->default('diajukan')->change(); // Mengubah status menjadi string
        });
    }

    public function down()
    {
        // Jika rollback, kita kembali ke tipe sebelumnya (ENUM) jika perlu untuk MySQL atau PostgreSQL
        Schema::table('complaints', function (Blueprint $table) {
            $table->enum('status', ['diajukan', 'diverifikasi', 'diterima', 'ditolak', 'ditindaklanjuti', 'ditanggapi', 'selesai'])->default('diajukan')->change();
        });
    }
}
