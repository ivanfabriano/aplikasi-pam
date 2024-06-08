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
        Schema::create('penggunaans', function (Blueprint $table) {
            $table->id();
            $table->string('id_pelanggan');
            $table->string('no_meter');
            $table->string('nama_pelanggan');
            $table->string('bulan_penggunaan');
            $table->integer('meter_awal');
            $table->integer('meter_akhir');
            $table->date('tanggal_pengecekan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaans');
    }
};
