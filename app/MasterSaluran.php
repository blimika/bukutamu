<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterSaluran extends Model
{
    //
    protected $table = 'msaluran';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
