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
        Schema::create('temuan_lhp', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lhp_id')
                ->constrained('lhp')
                ->cascadeOnDelete();

            $table->foreignId('kode_temuan_id')
                ->nullable()
                ->constrained('kode_temuan')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->text('uraian_temuan')->nullable();
            $table->decimal('nilai_temuan', 18, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temuan_lhp');
    }
};
