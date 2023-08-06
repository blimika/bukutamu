<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //tambah flag, user_foto, code_verifikasi_email            
            $table->string('user_foto',250)->nullable()->after('level');
            $table->string('telepon',20)->nullable()->after('user_foto');
            $table->boolean('flag')->default(1)->after('telepon');
            $table->string('email_kodever',10)->default(0)->after('flag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
