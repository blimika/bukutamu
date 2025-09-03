<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WhatsappFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_wa_flag', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->boolean('kode')->unsigned();  // 1 = antrian, 2 = terkirim, 3 = gagal
            $table->string('nama',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_wa_flag');
    }
}
