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
        Schema::create('lhp', function (Blueprint $table) {
            $table->id();

            $table->string('nomor_lhp')->unique();
            $table->date('tanggal_lhp')->nullable();
        
            // Kecamatan dipilih manual
            $table->string('nama_kecamatan')->nullable();
        
            $table->string('jenis_pemeriksaan')->nullable();
        
            /**
             * KATEGORI UNIT (OPD / Desa / Bidang / Sekolah)
             */
            $table->string('kategori_unit')
                ->nullable()
                ->comment('OPD / Desa / Bidang / Sekolah');
        
            /**
             * RELASI KE TABEL unit_diperiksa
             * contoh: Dinas Pendidikan, Desa Sumber, Bidang Anggaran
             */
            $table->foreignId('unit_id')
                ->nullable()
                ->constrained('unit_diperiksa')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        
            /**
             * TIM PEMERIKSA
             */
            $table->string('tim')->nullable();
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lhp');
    }
};
