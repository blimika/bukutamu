<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    //
    protected $table = 'p_antrian';
    public function kunjungan()
    {
        return $this->belongsTo('App\Kunjungan','kunjungan_id','id');
    }
    public function Layanan(){
    	return $this->hasMany('App\LayananUtama', 'layanan', 'kode');
    }
}
