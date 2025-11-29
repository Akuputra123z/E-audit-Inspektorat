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
        Schema::create('kode_temuan', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();            // contoh: 1.03.01
            $table->string('kelompok')->nullable();      // Ketidakpatuhan / SPI / 3E
            $table->string('sub_kelompok')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_temuan');
    }
};
