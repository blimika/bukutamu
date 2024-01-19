<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MFKunjungan extends Model
{
    //
    protected $table = 'mf_kunjungan';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
