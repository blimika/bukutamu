<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $table = 'm_pengunjung';
    protected $primaryKey = 'pengunjung_id';
    public function Pendidikan(){
    	return $this->belongsTo('App\MasterPendidikan', 'pengunjung_pendidikan', 'kode');
    }
    public function JenisKelamin()
    {
        return $this->belongsTo('App\Mjk', 'pengunjung_jk', 'id');
    }
    public function Member()
    {
        return $this->belongsTo('App\User', 'pengunjung_user_id', 'id');
    }
    public function Kunjungan()
    {
        return $this->hasMany('App\NewKunjungan','pengunjung_uid','pengunjung_uid')->orderBy('kunjungan_tanggal','desc')->take(15);
    }
}
