<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterFlagAntrian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mf_antrian', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->boolean('kode'); // 1 = Masuk Antrian, 2 Dalam Layanan, 3 Selesai
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
        Schema::dropIfExists('mf_antrian');
    }
}
