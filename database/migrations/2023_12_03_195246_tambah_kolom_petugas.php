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
            $table->boolean('flag_kunjungan')->default(1)->after('kode_feedback'); //flag sdh dtg kunjungan (0 - 1) 1 sudah dtg / belum (terjadwal)
            $table->string('kode_kunjungan',5)->default(0)->after('flag_kunjungan');
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
