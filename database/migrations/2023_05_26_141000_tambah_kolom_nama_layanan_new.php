<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomNamaLayananNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pst_layanan', function (Blueprint $table) {
            //
            $table->string('layanan_nama', 250)->change();
            $table->string('layanan_nama_new',250)->nullable()->after('layanan_nama'); ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pst_layanan', function (Blueprint $table) {
            //
        });
    }
}
