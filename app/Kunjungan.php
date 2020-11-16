<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    //
    protected $table = 'kunjungan';
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
    public function TamuPst()
    {
        return $this->belongsTo('App\Mtamu', 'tamu_id', 'id')->where('is_pst','1');
    }
    public function TamuKantor()
    {
        return $this->belongsTo('App\Mtamu', 'tamu_id', 'id')->where('is_pst','0');
    }
    public function pLayanan(){
    	return $this->hasMany('App\Pstlayanan', 'kunjungan_id', 'id');
    }
    public function pManfaat(){
    	return $this->hasMany('App\PstManfaat', 'kunjungan_id', 'id');
    }
    public function Fasilitas()
    {
        return $this->belongsTo('App\Mfasilitas', 'f_id', 'id');
    }
}