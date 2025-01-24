<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterTujuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_tujuan', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->boolean('kode')->unsigned(); //1 Kantor, 2 pst , 3 pojok statistik, 4, email, 5 wa, 6 telepon/lainnya
            $table->boolean('tipe')->unsigned()->default(1); //tipe 1 offline, 2 online
            $table->string('inisial',3);
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
        Schema::dropIfExists('m_tujuan');
    }
}
