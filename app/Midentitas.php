<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Midentitas extends Model
{
    //
    protected $table = 'midentitas';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
