<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomNamaManfaatNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pst_manfaat', function (Blueprint $table) {
            //
            $table->string('manfaat_nama', 250)->change();
            $table->string('manfaat_nama_new',250)->nullable()->after('manfaat_nama'); ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pst_manfaat', function (Blueprint $table) {
            //
        });
    }
}
