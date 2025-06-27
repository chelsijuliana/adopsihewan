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
        Schema::create('chelsi_adoption_requests', function (Blueprint $table) {
    $table->id();

    // FK ke tabel hewan
    $table->unsignedBigInteger('hewan_id');
    $table->unsignedBigInteger('adopter_id'); // FK ke user (role adopter)

    // Form tambahan
    $table->text('alasan')->nullable();
    $table->text('pengalaman')->nullable();

    $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');

    $table->timestamps();

    // Relasi
    $table->foreign('hewan_id')->references('id')->on('chelsi_animals')->onDelete('cascade');
    $table->foreign('adopter_id')->references('id')->on('chelsi_users')->onDelete('cascade');
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chelsi_adoption_requests');
    }
};
