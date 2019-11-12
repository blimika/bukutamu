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
            $table->string('no_identitas',20);
            $table->string('nama_lengkap',250);
            $table->date('tgl_lahir');
            $table->string('jk',9);
            $table->string('pekerjaan',50);
            $table->string('pekerjaan_detil',254)->nullable();
            $table->string('email',254)->nullable();
            $table->string('telepon',20)->nullable();
            $table->string('pendidikan',20)->nullable();
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
