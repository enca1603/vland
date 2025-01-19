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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('klasifikasi_id');
            $table->string('no_agenda');
            $table->string('no_surat');
            $table->date('tgl_surat');
            $table->string('tujuan');
            $table->string('prihal');
            $table->text('isi_surat');
            $table->string('lampiran')->nullable();
            $table->uuid('user_id')->nullable();

            $table->timestamps();

            $table->foreign('klasifikasi_id')->references('id')->on('klasifikasi');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};
