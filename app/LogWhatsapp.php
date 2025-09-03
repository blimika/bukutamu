<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogWhatsapp extends Model
{
    //
    protected $table = 'm_whatsapp';
     public function Pengunjung(){
    	return $this->belongsTo('App\Pengunjung', 'pengunjung_uid', 'pengunjung_uid');
    }
    public function Kunjungan()
    {
        return $this->belongsTo('App\NewKunjungan', 'kunjungan_uid', 'kunjungan_uid');
    }
    public function FlagWhatsapp(){
    	return $this->belongsTo('App\WaFlag', 'wa_flag', 'kode');
    }
}
