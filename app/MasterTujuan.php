<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterTujuan extends Model
{
    protected $table = 'm_tujuan';
    public $timestamps = false;
    public function Tipe(){
    	return $this->belongsTo('App\MasterTipeKunjungan', 'tipe', 'kode');
    }
}
