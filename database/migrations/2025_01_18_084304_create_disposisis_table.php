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
        Schema::create('disposisi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kepada');
            $table->date('tanggal');
            $table->text('isi');
            $table->string('catatan')->nullable();
            $table->uuid('suratmasuk_id');
            $table->foreignId('sifat_id')->constrained('sifat','id')->cascadeOnDelete();
            $table->timestamps();

            $table->foreign('suratmasuk_id')->references('id')->on('surat_masuk')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisi');
    }
};
