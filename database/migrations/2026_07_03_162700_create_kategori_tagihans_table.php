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
        Schema::create('kategori_tagihans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori'); // Menyimpan nama seperti "Uang Sekolah (Uang Program)", "Uang Ekskul", dll.
            $table->integer('harga_default'); // Menyimpan nominal harga (1000000, 100000, dll)
            $table->boolean('bisa_dicicil')->default(false); // Penanda true/false apakah iuran bisa diangsur
            $table->integer('maksimal_angsuran')->default(1); // Jumlah maksimal angsuran (misal: 3)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_tagihans');
    }
};