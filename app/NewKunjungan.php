<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewKunjungan extends Model
{
    protected $table = 'm_new_kunjungan';
    protected $primaryKey = 'kunjungan_id';
    public function Pengunjung(){
    	return $this->belongsTo('App\Pengunjung', 'pengunjung_uid', 'pengunjung_uid');
    }
    public function Tujuan()
    {
        return $this->belongsTo('App\MasterTujuan', 'kunjungan_tujuan', 'kode');
    }
    public function JenisKunjungan()
    {
        return $this->belongsTo('App\Mjkunjungan', 'kunjungan_jenis', 'id');
    }
    public function LayananUtama(){
    	return $this->belongsTo('App\MasterLayananPST', 'kunjungan_pst', 'kode');
    }
    public function FlagAntrian(){
    	return $this->belongsTo('App\FlagAntrian', 'kunjungan_flag_antrian', 'kode');
    }
    public function Petugas()
    {
        return $this->belongsTo('App\User', 'kunjungan_petugas_id', 'id');
    }
}
