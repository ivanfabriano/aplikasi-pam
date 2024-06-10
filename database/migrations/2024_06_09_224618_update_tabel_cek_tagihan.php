<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cek_tagihans', function (Blueprint $table) {
            $table->date('waktu_bayar')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cek_tagihans', function (Blueprint $table) {
            $table->dropColumn('waktu_bayar')->nullable(false)->change();
        });
    }
};
