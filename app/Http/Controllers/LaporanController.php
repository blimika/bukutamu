<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Midentitas;
use Session;
use Carbon\Carbon;
use App\Mjk;
use App\Mkatpekerjaan;
use App\Mlayanan;
use App\Mpendidikan;
use App\MKunjungan;
use App\Mwarga;
use App\Mpekerjaan;
use App\Mtamu;
use App\Kunjungan;
use App\Pstlayanan;
use App\Pstmanfaat;
use App\Mfasilitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    //
    public function list()
    {
        /*
        select month(tanggal) as bulan, count(*) as total,laki.*, perempuan.* from kunjungan left join (select month(tanggal) as bulan_laki, count(*) as laki from kunjungan left join mtamu on mtamu.id=kunjungan.tamu_id where id_jk=1 and is_pst=0) as laki on laki.bulan_laki=month(tanggal) left join (select month(tanggal) as bulan_perempuan, count(*) as perempuan from kunjungan left join mtamu on mtamu.id=kunjungan.tamu_id where id_jk=2 and is_pst=0) as perempuan on perempuan.bulan_perempuan = month(tanggal) where is_pst=0 GROUP by bulan
        */
        $dataKunjungan = Kunjungan::get();
        $data_bulan = array (
            1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
        );
        return view('laporan.index',['dataKunjungan'=>$dataKunjungan]);
    }
}
