<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PstLayanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pst_layanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kunjungan_id')->unsigned();
            $table->tinyInteger('layanan_id')->unsigned();
            $table->string('layanan_nama',100);
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
        Schema::dropIfExists('pst_layanan');
    }
}
