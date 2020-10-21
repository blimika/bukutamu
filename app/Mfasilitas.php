<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mfasilitas extends Model
{
    //
    protected $table = 'mfasilitas';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
