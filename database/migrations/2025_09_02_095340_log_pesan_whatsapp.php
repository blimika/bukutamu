<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LogPesanWhatsapp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_whatsapp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('wa_tanggal');
            $table->string('wa_uid',8)->nullable();
            $table->string('wa_pengunjung_uid',6)->nullable();
            $table->string('wa_kunjungan_uid',7)->nullable();
            $table->string('wa_device',30)->nullable();
            $table->string('wa_target',30)->nullable();
            $table->string('wa_message_id',255)->nullable();
            $table->text('wa_message')->nullable();
            $table->text('wa_status')->nullable();
            $table->boolean('wa_flag')->default(1); // 1 = antrian, 2 = terkirim, 3 = gagal
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
        Schema::dropIfExists('m_whatsapp');
    }
}
