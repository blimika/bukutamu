<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomTotalKunjungan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mtamu', function (Blueprint $table) {
            //
            $table->tinyInteger('total_kunjungan')->unsigned()->default(0)->after('tamu_foto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mtamu', function (Blueprint $table) {
            //
        });
    }
}
