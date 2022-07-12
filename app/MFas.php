<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MFas extends Model
{
    //
    protected $table = 'mfas';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
