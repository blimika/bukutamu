<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mtujuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtujuan', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->boolean('kode')->default(0);
            $table->string('nama_pendek',6);
            $table->string('nama',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtujuan');
    }
}
