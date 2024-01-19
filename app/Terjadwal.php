<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terjadwal extends Model
{
    //
    protected $table = 'k_terjadwal';
    public function tamu()
    {
        return $this->belongsTo('App\Mtamu', 'tamu_id', 'id');
    }
    public function jKunjungan(){
    	return $this->belongsTo('App\Mjkunjungan', 'jenis_kunjungan', 'id');
    }
    public function mTujuan(){
    	return $this->belongsTo('App\MTujuan', 'is_pst', 'kode');
    }
    public function LayananTerjadwal(){
    	return $this->hasMany('App\LPTerjadwal', 'terjadwal_id', 'id');
    }
    public function FasilitasTerjadwal(){
    	return $this->hasMany('App\FPTerjadwal', 'terjadwal_id', 'id');
    }
    public function Flag(){
    	return $this->belongsTo('App\MFKunjungan', 'flag_kunjungan', 'kode');
    }
}
