<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mjkunjungan extends Model
{
    //
    protected $table = 'mjkunjungan';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
