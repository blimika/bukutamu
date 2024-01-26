<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomPetugas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kunjungan', function (Blueprint $table) {
            //
            $table->bigInteger('petugas_id')->unsigned()->default(0)->after('tamu_f');
            $table->string('petugas_username',50)->nullable()->after('petugas_id');
            $table->dateTime('jam_datang')->nullable()->after('petugas_username');
            $table->dateTime('jam_pulang')->nullable()->after('jam_datang');
            $table->string('kode_feedback',7)->nullable()->after('jam_pulang'); //untuk pengiriman feedback ke email dan diisilangsung
            $table->string('kode_kunjungan',5)->default(0)->after('kode_feedback');
            $table->boolean('layanan_utama')->default(0)->after('kode_kunjungan');
            //$table->tinyInteger('nomor_antrian')->unsigned()->default(0)->after('kode_kunjungan'); //nomor antrian
            //$table->tinyInteger('petugas_antrian')->unsigned()->default(0)->after('nomor_antrian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kunjungan', function (Blueprint $table) {
        });
    }
}
