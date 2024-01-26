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
    public function Petugas1()
    {
        return $this->belongsTo('App\User', 'petugas1_id', 'id');
    }
    public function Petugas2()
    {
        return $this->belongsTo('App\User', 'petugas2_id', 'id');
    }
}
