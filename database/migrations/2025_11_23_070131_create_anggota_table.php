<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
 Schema::create('anggotas', function (Blueprint $table) {
    $table->id('id_anggota');

    $table->unsignedBigInteger('id_user')->nullable(); // ⬅️ PENTING

    $table->string('nama_anggota');
    $table->text('alamat');
    $table->string('jeniskelamin', 20);
    $table->string('no_hp', 15);
    $table->string('tempat_lahir');
    $table->date('tgl_lahir');
    $table->string('agama', 20);

    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('anggotas');
    }
};
