<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomKunjungan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_new_kunjungan', function (Blueprint $table) {
            //
            $table->tinyInteger('kunjungan_kantor')->default(99)->after('kunjungan_pst');
            $table->string('kunjungan_ip_feedback',20)->nullable()->after('kunjungan_komentar_feedback');
            $table->string('kunjungan_agent_feedback',255)->nullable()->after('kunjungan_ip_feedback');
            $table->dateTime('kunjungan_tanggal_feedback')->nullable()->after('kunjungan_agent_feedback');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_new_kunjungan', function (Blueprint $table) {
            //
        });
    }
}
