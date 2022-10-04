<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MTujuan extends Model
{
    //
    protected $table = 'mtujuan';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
