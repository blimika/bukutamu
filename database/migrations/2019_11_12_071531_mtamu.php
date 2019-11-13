<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mtamu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtamu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('id_midentitas',2);
            $table->string('nomor_identitas',20);
            $table->string('nama_lengkap',250);
            $table->date('tgl_lahir');
            $table->tinyInteger('jk');
            $table->tinyInteger('id_mkerja');
            $table->tinyInteger('id_mkat_kerja');
            $table->string('kerja_detil',254)->nullable();
            $table->tinyInteger('id_mdidik');
            $table->tinyInteger('id_mwarga');
            $table->string('email',254)->nullable();
            $table->string('telepon',20)->nullable();
            $table->text('alamat')->nullable();
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
        Schema::dropIfExists('mtamu');
    }
}
