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
        Schema::create('chelsi_medical_records', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('hewan_id');
    $table->unsignedBigInteger('dokter_id');
    $table->date('tanggal');
    $table->text('kondisi');
    $table->text('vaksinasi')->nullable();
    $table->string('file_hasil')->nullable();
    $table->boolean('layak_adopsi')->default(false);
    $table->timestamps();

    $table->foreign('hewan_id')->references('id')->on('chelsi_animals')->onDelete('cascade');
    $table->foreign('dokter_id')->references('id')->on('chelsi_users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chelsi_medical_records');
    }
};
