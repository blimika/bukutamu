<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaFlag extends Model
{
    //
    protected $table = 'm_wa_flag';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
