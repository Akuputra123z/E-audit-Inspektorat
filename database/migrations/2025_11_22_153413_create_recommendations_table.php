<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();

            // Relasi ke LHP
            $table->foreignId('lhp_id')
                ->constrained('lhp')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            // Relasi kode temuan
            $table->foreignId('kode_temuan_id')
                ->nullable()
                ->constrained('kode_temuan')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            // Relasi kode rekomendasi
            $table->foreignId('kode_rekom_id')
                ->nullable()
                ->constrained('kode_rekomendasi')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            // Status
            $table->string('status')->nullable(); // pending / proses / selesai

            // Rekomendasi
            $table->text('uraian_rekom')->nullable();
            $table->decimal('nilai_rekom', 18, 2)->nullable();

            // Data temuan sebelumnya
            $table->text('uraian_temuan')->nullable();
            $table->decimal('nilai_temuan', 18, 2)->nullable();

            // Tindak lanjut
            $table->string('no_tindak_lanjut')->nullable();
            $table->text('uraian_tindak_lanjut')->nullable();
            $table->decimal('nilai_tindak_lanjut', 18, 2)->nullable();

            // Multi file JSON
            $table->json('file_tindak_lanjut')->nullable();

            // Tanggapan
            $table->text('tanggapan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
