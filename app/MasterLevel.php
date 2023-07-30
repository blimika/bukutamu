<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterLevel extends Model
{
    //
    protected $table = 'mlevel';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
