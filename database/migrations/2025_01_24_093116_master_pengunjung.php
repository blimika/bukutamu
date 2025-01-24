<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterPengunjung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_pengunjung', function (Blueprint $table) {
            $table->bigIncrements('pengunjung_id');
            $table->string('pengunjung_uid',6)->nullable();
            $table->string('pengunjung_nama',250);
            $table->string('pengunjung_nomor_hp',20);
            $table->year('pengunjung_tahun_lahir')->nullable();
            $table->tinyInteger('pengunjung_jk');
            $table->string('pengunjung_pekerjaan',254)->nullable();
            $table->tinyInteger('pengunjung_pendidikan')->nullable();
            $table->string('pengunjung_email',254)->nullable();
            $table->text('pengunjung_alamat')->nullable();
            $table->string('pengunjung_foto_profil',250)->nullable();
            $table->tinyInteger('pengunjung_total_kunjungan')->unsigned()->default(0);
            $table->bigInteger('pengunjung_user_id')->unsigned()->default(0);
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
        Schema::dropIfExists('m_pengunjung');
    }
}
