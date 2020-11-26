<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $table = 'feedback';
    public function Kunjungan()
    {
        return $this->belongsTo('App\Kunjungan', 'id', 'kunjungan_id');
    }
}
