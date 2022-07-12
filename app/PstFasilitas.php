<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PstFasilitas extends Model
{
    //
    protected $table = 'pst_fasilitas';
    public function Kunjungan()
    {
        return $this->belongsTo('App\Kunjungan', 'kunjungan_id', 'id');
    }
}
