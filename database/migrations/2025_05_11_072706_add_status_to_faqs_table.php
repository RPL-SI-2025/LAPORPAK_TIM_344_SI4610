<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::table('faqs', function (Blueprint $table) {
        $table->boolean('status')->default(1)->after('answer');
    });
}

public function down()
    {
    Schema::table('faqs', function (Blueprint $table) {
        $table->dropColumn('status');
    });
    }
};