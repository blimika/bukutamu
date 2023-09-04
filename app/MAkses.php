<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MAkses extends Model
{
    //
    protected $table = 'm_akses';
    protected $fillable = ['ip','flag'];
}
