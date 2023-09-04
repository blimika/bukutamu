<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PstMelayani extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //pengunjung pst yg datang dilayani oleh operator
        //dicatat awal mulai dilayani dan akhir dari layanan
        //masuk ke feedback layanan
        Schema::create('pst_melayani', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kunjungan_id')->unsigned();
            $table->bigInteger('tamu_id')->unsigned();
            $table->bigInteger('userid')->unsigned();
            $table->string('username',50);
            $table->dateTime('mulai_layanan')->nullable();
            $table->dateTime('akhir_layanan')->nullable();
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
        Schema::dropIfExists('pst_melayani');
    }
}
