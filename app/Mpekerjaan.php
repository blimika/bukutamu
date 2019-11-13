<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mpekerjaan extends Model
{
    //
    protected $table = 'mpekerjaan';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
