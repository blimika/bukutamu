<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MKunjungan extends Model
{
    //
    protected $table = 'mkunjungan';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
