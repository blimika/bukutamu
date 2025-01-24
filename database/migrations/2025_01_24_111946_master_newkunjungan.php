<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterNewkunjungan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_new_kunjungan', function (Blueprint $table) {
            $table->bigIncrements('kunjungan_id');
            $table->string('pengunjung_uid',6)->nullable();
            $table->string('kunjungan_uid',6)->nullable();
            $table->date('kunjungan_tanggal');
            $table->text('kunjungan_keperluan')->nullable();
            $table->text('kunjungan_tindak_lanjut')->nullable();
            $table->tinyInteger('kunjungan_jenis')->default(1); //1 Perorangan, 2 Kelompok
            $table->tinyInteger('kunjungan_tujuan')->default(1); //1 Kantor, 2 pst , 3 pojok statistik, 4
            $table->tinyInteger('kunjungan_pst')->default(0); //isian layanan pst ini bernilai kalo tujuan 2 selain 2 nilai 0
            $table->string('kunjungan_foto',250)->nullable();
            $table->tinyInteger('kunjungan_jumlah_orang')->default(1);
            $table->tinyInteger('kunjungan_jumlah_pria')->default(0); //tamu laki
            $table->tinyInteger('kunjungan_jumlah_wanita')->default(0);
            $table->tinyInteger('kunjungan_flag_feedback')->default(1); // 1 belum 2 sudah
            $table->tinyInteger('kunjungan_nilai_feedback')->default(6); // skala 1 - 6
            $table->text('kunjungan_komentar_feedback')->nullable();
            //antrian
            $table->tinyInteger('Kunjungan_nomor_antrian')->unsigned()->default(0);
            $table->string('Kunjungan_teks_antrian',15)->nullable();
            $table->boolean('kunjungan_loket_petugas')->default(0);
            $table->boolean('kunjungan_flag_antrian')->default(1); //flag: 1 = Masuk Antrian 2 = Dalam Layanan 3 = Selesai
            $table->dateTime('kunjungan_jam_datang')->nullable();
            $table->dateTime('kunjungan_jam_pulang')->nullable();
            $table->bigInteger('kunjungan_petugas_id')->unsigned()->default(0);
            $table->string('kunjungan_petugas_username',50)->nullable();
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
        Schema::dropIfExists('m_new_kunjungan');
    }
}
