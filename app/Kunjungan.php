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
    public function pLayanan(){
    	return $this->belongsTo('App\Pstlayanan', 'id', 'kunjungan_id');
    }
    public function pManfaat(){
    	return $this->hasMany('App\Pstmanfaat', 'kunjungan_id', 'id');
    }
    public function pFasilitas(){
    	return $this->hasMany('App\PstFasilitas', 'kunjungan_id', 'id');
    }
    public function jKunjungan(){
    	return $this->belongsTo('App\Mjkunjungan', 'jenis_kunjungan', 'id');
    }
    public function mTujuan(){
    	return $this->belongsTo('App\MTujuan', 'is_pst', 'kode');
    }
    public function Fasilitas()
    {
        return $this->belongsTo('App\Mfasilitas', 'f_id', 'id');
    }
    public function Feedback()
    {
        return $this->belongsTo('App\Feedback', 'id', 'kunjungan_id');
    }
    public function Petugas()
    {
        return $this->belongsTo('App\User', 'petugas_id', 'id');
    }
    public function NomorAntrian()
    {
        return $this->belongsTo('App\Antrian', 'id', 'kunjungan_id');
    }
    public function LayananUtama(){
    	return $this->belongsTo('App\LayananUtama', 'layanan_utama', 'kode');
    }
}
