<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelLayananUtama extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mlayanan_utama', function (Blueprint $table) {
            //
            $table->smallIncrements('id');
            $table->boolean('kode');
            $table->string('nama',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mlayanan_utama', function (Blueprint $table) {
            //
        });
    }
}
