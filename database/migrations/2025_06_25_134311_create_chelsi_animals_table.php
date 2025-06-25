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
        Schema::create('chelsi_animals', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('jenis');
    $table->string('ras');
    $table->integer('usia');
    $table->enum('jenis_kelamin', ['jantan', 'betina']);
    $table->text('deskripsi');
    $table->string('foto');
    $table->enum('status', ['menunggu', 'diverifikasi', 'siap', 'diadopsi'])->default('menunggu');
    $table->unsignedBigInteger('user_id'); // pemberi
    $table->unsignedBigInteger('dokter_id')->nullable();
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('chelsi_users')->onDelete('cascade');
    $table->foreign('dokter_id')->references('id')->on('chelsi_users')->onDelete('set null');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chelsi_animals');
    }
};
