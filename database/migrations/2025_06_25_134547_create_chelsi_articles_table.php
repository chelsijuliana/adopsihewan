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
        Schema::create('chelsi_articles', function (Blueprint $table) {
    $table->id();
    $table->string('judul');
    $table->longText('konten');
    $table->string('foto')->nullable();
    $table->unsignedBigInteger('created_by');
    $table->timestamps();

    $table->foreign('created_by')->references('id')->on('chelsi_users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chelsi_articles');
    }
};
