<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PstManfaat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pst_manfaat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kunjungan_id')->unsigned();
            $table->tinyInteger('manfaat_id')->unsigned();
            $table->string('manfaat_nama',100);
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
        Schema::dropIfExists('pst_manfaat');
    }
}
