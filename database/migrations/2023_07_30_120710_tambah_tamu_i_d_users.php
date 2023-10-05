<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahTamuIDUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->bigInteger('tamu_id')->unsigned()->default(0)->after('level');
            $table->string('user_foto',250)->nullable()->after('tamu_id');
            $table->string('telepon',20)->nullable()->after('user_foto');
            $table->boolean('flag')->default(1)->after('telepon');
            $table->string('email_kodever',10)->default(0)->after('flag');
            $table->string('email_ganti',254)->nullable()->after('email');
            $table->timestamp('akun_verified_at')->nullable()->after('email_verified_at');
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
