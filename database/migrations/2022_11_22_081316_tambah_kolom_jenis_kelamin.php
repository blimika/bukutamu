<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomJenisKelamin extends Migration
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
            $table->tinyInteger('tamu_m')->default(0)->after('jumlah_tamu'); //tamu laki
            $table->tinyInteger('tamu_f')->default(0)->after('tamu_m'); //tamu wanita
            $table->tinyInteger('flag_edit_tamu')->default(0)->after('tamu_f'); //tamu wanita
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
            //
        });
    }
}
