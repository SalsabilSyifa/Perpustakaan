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
        Schema::create('anggotas', function (Blueprint $table) {
    $table->id('id_anggota');
    $table->unsignedBigInteger('id_user');
    $table->string('nama_anggota', 100);
    $table->string('alamat', 100)->nullable();
    $table->enum('jeniskelamin', ['L','P']);
    $table->string('no_hp', 15)->nullable();
    $table->string('tempat_lahir', 100)->nullable();
    $table->date('tgl_lahir')->nullable();
    $table->string('agama', 30)->nullable();
    $table->timestamps();

    $table->foreign('id_user')->references('id')->on('users');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
