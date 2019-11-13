<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pstlayanan extends Model
{
    //
    protected $table = 'pst_layanan';
    public function Kunjungan()
    {
        return $this->belongsTo('App\Kunjungan', 'kunjungan_id', 'id');
    }
}
