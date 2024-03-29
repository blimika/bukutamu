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
            $table->boolean('kode'); // 0 = kantor, 1 perpus, 2 penjualan, 3 konsultasi, 4 rekomendasi
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
        Schema::table('mlayanan_utama', function (Blueprint $table) {
            //
        });
    }
}
