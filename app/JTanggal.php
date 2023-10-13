<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JTanggal extends Model
{
    //
    protected $table = 'jtanggal';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
