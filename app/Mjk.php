<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mjk extends Model
{
    //
    protected $table = 'mjk';
    protected $fillable = ["nama"];
    public $timestamps = false;
    
}
