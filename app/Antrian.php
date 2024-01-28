<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    //
    protected $table = 'm_antrian';
    public function kunjungan()
    {
        return $this->belongsTo('App\Kunjungan','kunjungan_id','id');
    }
    public function FlagAntrian(){
    	return $this->hasMany('App\FlagAntrian', 'flag_antrian', 'kode');
    }
}
