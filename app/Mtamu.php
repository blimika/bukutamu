<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mtamu extends Model
{
    //return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
    protected $table = 'mtamu';
    public function identitas()
    {
        return $this->belongsTo('App\Midentitas', 'id_midentitas', 'id');
    }
    public function jk()
    {
        return $this->belongsTo('App\Mjk', 'id_jk', 'id');
    }
    public function kategoripekerjaan()
    {
        return $this->belongsTo('App\Mkatpekerjaan', 'id_mkat_kerja','id' );
    }
    public function pekerjaan()
    {
        return $this->belongsTo('App\Mpekerjaan', 'id_mkerja', 'id');
    }
    public function pendidikan()
    {
        return $this->belongsTo('App\Mpendidikan', 'id_mdidik', 'id');
    }
    public function warga()
    {
        return $this->belongsTo('App\Mwarga', 'id_mwarga', 'id');
    }
    public function kunjungan()
    {
        return $this->hasMany('App\Kunjungan','tamu_id','id');
    }
}
