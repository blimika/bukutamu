<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MTanggal extends Model
{
    //
    protected $table = 'mtanggal';
    public function jTanggal()
    {
        return $this->belongsTo('App\JTanggal', 'jtgl', 'id');
    }
}
