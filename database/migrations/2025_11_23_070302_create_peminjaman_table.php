<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_pinjam');
            $table->unsignedBigInteger('id_anggota');

            $table->date('tgl_pinjam');
            $table->date('tgl_harus_kembali');
            $table->date('tgl_kembali')->nullable();

            $table->enum('status', ['Dipinjam', 'Dikembalikan'])
                  ->default('Dipinjam');

            $table->decimal('total_denda', 10, 2)->nullable();

            $table->timestamps();

            $table->foreign('id_anggota')
                  ->references('id_anggota')->on('anggotas')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
