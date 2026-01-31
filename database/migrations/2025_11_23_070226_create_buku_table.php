<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id(); // id
            $table->string('kode_buku')->unique();
            $table->string('judul', 150);
            $table->string('penulis', 100);
            $table->string('penerbit', 100)->nullable();
            $table->year('tahun_terbit')->nullable();

            $table->foreignId('kategori_id')
                ->constrained('kategoris')
                ->cascadeOnDelete();

            $table->integer('stock')->default(0); // nanti dipakai status buku
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
