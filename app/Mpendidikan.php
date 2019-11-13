<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mpendidikan extends Model
{
    //
    protected $table = 'mpendidikan';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
