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
        Schema::create('detail_buku', function (Blueprint $table) {
    $table->string('no_buku',10)->primary();
    $table->unsignedBigInteger('id_buku');
    $table->enum('status', ['Tersedia','Dipinjam','Rusak'])->default('Tersedia');
    $table->timestamps();

    $table->foreign('id_buku')->references('id_buku')->on('buku');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_buku');
    }
};
