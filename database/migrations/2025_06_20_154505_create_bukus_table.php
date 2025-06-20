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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id('id_buku');
            $table->unsignedBigInteger('id_kategori');
            $table->string('judul_buku');
            $table->string('penulis');
            $table->string('penerbit');
            $table->year('tahun_terbit');
            $table->timestamps();

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_bukus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
