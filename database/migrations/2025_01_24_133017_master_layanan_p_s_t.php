<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterLayananPST extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_layanan_pst', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->boolean('kode')->unsigned(); // 1 perpus, 2 penjualan, 3 konsultasi, 4 rekomendasi
            $table->string('inisial',2);
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
        Schema::dropIfExists('m_layanan_pst');
    }
}
