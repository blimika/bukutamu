<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterTanggal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtanggal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tanggal');
            $table->string('hari',6)->nullable();
            $table->tinyInteger('jtgl')->default(1); //flag kerja = 1, libur = 2
            $table->string('deskripsi',250)->nullable();
            $table->bigInteger('petugas1_id')->unsigned()->default(0);
            $table->string('petugas1_username',50)->nullable();
            $table->bigInteger('petugas2_id')->unsigned()->default(0);
            $table->string('petugas2_username',50)->nullable();
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
        Schema::dropIfExists('mtanggal');
    }
}
