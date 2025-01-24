<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterTipeTujuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_tipe_tujuan', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->boolean('kode')->unsigned(); // 1 offline, 2 online
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
        Schema::dropIfExists('m_tipe_tujuan');
    }
}
