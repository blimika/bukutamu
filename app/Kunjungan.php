<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    //
    protected $table = 'kunjungan';
    protected $casts = [
        'pst_layanan' => 'array',
        'pst_manfaat' => 'array'
    ];
    /*
    public function tamu()
    {
        return $this->hasMany('App\Mwarga', 'id', 'id_mwarga');
    }
    */
    public function tamu()
    {
        return $this->belongsTo('App\Mtamu', 'tamu_id', 'id');
    }
}
