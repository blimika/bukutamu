<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mkatpekerjaan extends Model
{
    //
    protected $table = 'mkat_pekerjaan';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
