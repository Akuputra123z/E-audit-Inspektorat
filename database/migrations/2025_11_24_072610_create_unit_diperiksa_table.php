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
        Schema::create('unit_diperiksa', function (Blueprint $table) {
            $table->id();
         
            $table->string('kategori')->nullable(); // OPD / Desa / Bidang / Sekolah
            $table->string('nama_kecamatan')->nullable();
            $table->string('nama_unit'); // misal: Dinas Pendidikan, Kecamatan, Desa Krikilan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_diperiksa');
    }
};
