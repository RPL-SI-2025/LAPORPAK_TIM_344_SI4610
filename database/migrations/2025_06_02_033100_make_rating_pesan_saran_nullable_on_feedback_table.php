<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->unsignedTinyInteger('rating')->nullable()->change();
            $table->text('pesan')->nullable()->change();
            $table->text('saran')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->unsignedTinyInteger('rating')->nullable(false)->change();
            $table->text('pesan')->nullable(false)->change();
            $table->text('saran')->nullable(false)->change();
        });
    }
};
