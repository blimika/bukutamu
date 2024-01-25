<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelPstAntrian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_antrian', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->bigInteger('kunjungan_id')->unsigned();
            $table->date('tanggal');
            $table->tinyInteger('nomor_antrian')->unsigned()->default(0);
            $table->tinyInteger('petugas_antrian')->unsigned()->default(0);
            $table->boolean('layanan')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_antrian', function (Blueprint $table) {
            //
        });
    }
}
