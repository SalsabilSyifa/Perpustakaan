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
        Schema::create('buku', function (Blueprint $table) {
    $table->id('id_buku');
    $table->string('judul_buku',150);
    $table->string('pengarang',100)->nullable();
    $table->string('penerbit',100)->nullable();
    $table->year('tahun_terbit')->nullable();
    $table->integer('jumlah')->default(1);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
