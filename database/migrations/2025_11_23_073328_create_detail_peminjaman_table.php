<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_peminjaman', function (Blueprint $table) {
            $table->id('id_detail');

            // relasi ke peminjaman
            $table->unsignedBigInteger('id_pinjam');

            // relasi ke buku
            $table->unsignedBigInteger('id_buku');

            // jumlah buku (opsional)
            $table->integer('jumlah')->default(1);

            // denda per item (opsional)
            $table->decimal('denda', 10, 2)->nullable();

            $table->timestamps();

            // foreign keys
            $table->foreign('id_pinjam')
                  ->references('id_pinjam')->on('peminjaman')
                  ->onDelete('cascade');

            $table->foreign('id_buku')
                  ->references('id_buku')->on('buku')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_peminjaman');
    }
};
