<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MLay extends Model
{
    //
    protected $table = 'mlay';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
