<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelKunjunganTerjadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_terjadwal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tamu_id')->unsigned();
            $table->string('kode_booking',6)->nullable();
            $table->date('tanggal');
            $table->text('keperluan');
            $table->boolean('is_pst')->default(0); //0 = kantor, PST = 1
            $table->tinyInteger('f_id')->default(0); //tujuan kedatangan ke pst
            $table->string('f_teks',200)->nullable(); //teks tujuan kedatangan ke pst
            $table->tinyInteger('jenis_kunjungan')->default(1); //
            $table->tinyInteger('jumlah_tamu')->default(1);
            $table->tinyInteger('tamu_m')->default(0); //tamu laki
            $table->tinyInteger('tamu_f')->default(0); //tamu wanita
            $table->boolean('flag_kunjungan')->default(1); //flag = 1 masih terjadwal, 2 = sudah datang, 3 = batal
            $table->boolean('layanan_utama')->default(0);
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
        Schema::dropIfExists('k_terjadwal');
    }
}
