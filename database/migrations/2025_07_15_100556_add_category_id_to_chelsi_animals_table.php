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
    Schema::table('chelsi_animals', function (Blueprint $table) {
        $table->unsignedBigInteger('category_id')->after('nama');

        $table->foreign('category_id')->references('id')->on('chelsi_categories')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('chelsi_animals', function (Blueprint $table) {
        $table->dropForeign(['category_id']);
        $table->dropColumn('category_id');
    });
}

};
