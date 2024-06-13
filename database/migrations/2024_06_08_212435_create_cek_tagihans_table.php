<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // 'id_pembayaran',
    // 'id_pelanggan',
    // 'nama_pelanggan',
    // 'waktu_bayar',
    // 'bulan_tagihan',
    // 'meter_awal',
    // 'meter_akhir',
    // 'tarif',
    // 'jumlah_bayar',
    // 'biaya_admin',
    // 'total_akhir',
    // 'bayar',
    // 'status_bayar'
    public function up(): void
    {
        Schema::create('cek_tagihans', function (Blueprint $table) {
            $table->id();
            $table->string('id_pembayaran')->unique();
            $table->string('id_pelanggan');
            $table->string('nama_pelanggan');
            $table->date('waktu_bayar');
            $table->string('bulan_tagihan');
            $table->integer('meter_awal');
            $table->integer('meter_akhir');
            $table->integer('tarif');
            $table->integer('jumlah_bayar');
            $table->integer('biaya_admin');
            $table->integer('total_akhir');
            $table->integer('bayar');
            $table->boolean('status_bayar')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cek_tagihans');
    }
};
