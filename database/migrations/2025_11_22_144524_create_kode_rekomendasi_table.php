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
        Schema::create('kode_rekomendasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();          // contoh: 01.01
            $table->string('kategori')->nullable();    // Administratif / Keuangan / Pengendalian
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_rekomendasi');
    }
};
