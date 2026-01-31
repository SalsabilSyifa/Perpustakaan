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
        Schema::create('buku_items', function (Blueprint $table) {
    $table->id();
    $table->string('kode_buku')->unique();
    $table->foreignId('buku_id')->constrained('bukus')->cascadeOnDelete();
    $table->foreignId('status_buku_id')->constrained('status_bukus');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_items');
    }
};
