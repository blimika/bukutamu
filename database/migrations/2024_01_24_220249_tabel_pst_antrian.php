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
        Schema::create('m_antrian', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->bigInteger('kunjungan_id')->unsigned();
            $table->date('tanggal'); //untuk cek nomor antrian
            $table->boolean('layanan_utama')->default(0); //untuk cek nomor antrian
            $table->tinyInteger('nomor_antrian')->unsigned()->default(0);
            $table->string('teks_antrian',15)->nullable();
            $table->boolean('loket_petugas')->default(0);
            $table->boolean('flag_antrian')->default(1); //flag: 1 = Masuk Antrian 2 = Dalam Layanan 3 = Selesai
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
        Schema::table('m_antrian', function (Blueprint $table) {
            //
        });
    }
}
