<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pstmanfaat extends Model
{
    //
    protected $table = 'pst_manfaat';
    public function Kunjungan()
    {
        return $this->belongsTo('App\Kunjungan', 'kunjungan_id', 'id');
    }
}
