<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayananUtama extends Model
{
    //
    protected $table = 'mlayanan_utama';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
