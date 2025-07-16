<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class UpdateStatusEnumInChelsiAdoptionRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('chelsi_adoption_requests', function (Blueprint $table) {
            // Ubah dulu ke string sementara agar bisa update data
            $table->string('status', 20)->change();
        });

        // Ubah isi 'pending' ke 'menunggu'
        DB::table('chelsi_adoption_requests')
            ->where('status', 'pending')
            ->update(['status' => 'menunggu']);

        // Ubah kembali jadi ENUM ['menunggu', 'disetujui', 'ditolak']
        Schema::table('chelsi_adoption_requests', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->change();
        });
    }

    public function down()
    {
        Schema::table('chelsi_adoption_requests', function (Blueprint $table) {
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->change();
        });

        DB::table('chelsi_adoption_requests')
            ->where('status', 'menunggu')
            ->update(['status' => 'pending']);
    }
}
