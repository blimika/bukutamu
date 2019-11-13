<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mlayanan extends Model
{
    //
    protected $table = 'mlayanan';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
