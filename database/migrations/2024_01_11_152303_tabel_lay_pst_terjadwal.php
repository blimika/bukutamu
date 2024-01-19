<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelLayPstTerjadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_p_terjadwal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('terjadwal_id')->unsigned();
            $table->tinyInteger('l_p_id')->unsigned();
            $table->string('l_p_nama',200);
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
        Schema::dropIfExists('l_p_terjadwal');
    }
}
