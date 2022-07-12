<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MManfaat extends Model
{
    //
    protected $table = 'mmanfaat';
    protected $fillable = ["nama"];
    public $timestamps = false;
}
