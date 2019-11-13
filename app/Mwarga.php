<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mwarga extends Model
{
    //
    protected $table = 'mwarga';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
