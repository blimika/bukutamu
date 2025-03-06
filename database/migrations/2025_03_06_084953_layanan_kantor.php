<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LayananKantor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_layanan_kantor', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->boolean('kode')->unsigned(); // 1 Konsultasi 2 Pengaduan 99 Lainnya
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
        Schema::dropIfExists('m_layanan_kantor');
    }
}
