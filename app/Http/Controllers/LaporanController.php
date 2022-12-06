<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Midentitas;
use Illuminate\Support\Facades\Session;
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
    public function NewLaporan()
    {
        if (request('tahun')==NULL)
        {
            $tahun_filter=date('Y');
        }
        elseif (request('tahun')==0)
        {
            $tahun_filter=date('Y');
        }
        else
        {
            $tahun_filter = request('tahun');
        }
        $data_bulan = array (
            1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
        );
        $data_tahun = DB::table('kunjungan')
                        ->selectRaw('year(tanggal) as tahun')
                        ->groupBy('tahun')
                        ->orderBy('tahun','asc')
                        ->get();

        $data_total = \DB::table('bulan')
        ->leftJoin(\DB::Raw("(select month(tanggal) as bln_total, count(*) as jumlah_total, sum(jumlah_tamu) as jumlah_tamu, sum(tamu_m) as tamu_laki, sum(tamu_f) as tamu_wanita from kunjungan where year(tanggal)='".$tahun_filter."' GROUP by bln_total) as total"),'bulan.id','=','total.bln_total')
        ->select(\DB::Raw('nama_bulan,COALESCE(jumlah_total,0) as k_total, COALESCE(jumlah_tamu,0) as jumlah_tamu, COALESCE(tamu_laki,0) as tamu_laki, COALESCE(tamu_wanita,0) as tamu_wanita'))->get();
        $data_pst = \DB::table('bulan')
        ->leftJoin(\DB::Raw("(select month(tanggal) as bln_total, count(*) as jumlah_total, sum(jumlah_tamu) as jumlah_tamu, sum(tamu_m) as tamu_laki, sum(tamu_f) as tamu_wanita from kunjungan where is_pst='1' and year(tanggal)='".$tahun_filter."' GROUP by bln_total) as total"),'bulan.id','=','total.bln_total')
        ->select(\DB::Raw('nama_bulan,COALESCE(jumlah_total,0) as k_total, COALESCE(jumlah_tamu,0) as jumlah_tamu, COALESCE(tamu_laki,0) as tamu_laki, COALESCE(tamu_wanita,0) as tamu_wanita'))->get();
        $data_kantor = \DB::table('bulan')
        ->leftJoin(\DB::Raw("(select month(tanggal) as bln_total, count(*) as jumlah_total, sum(jumlah_tamu) as jumlah_tamu, sum(tamu_m) as tamu_laki, sum(tamu_f) as tamu_wanita from kunjungan where is_pst='0' and year(tanggal)='".$tahun_filter."' GROUP by bln_total) as total"),'bulan.id','=','total.bln_total')
        ->select(\DB::Raw('nama_bulan,COALESCE(jumlah_total,0) as k_total, COALESCE(jumlah_tamu,0) as jumlah_tamu, COALESCE(tamu_laki,0) as tamu_laki, COALESCE(tamu_wanita,0) as tamu_wanita'))->get();

        //dd($data_pst);
        return view('laporan.new',[
            'dataBulan'=>$data_bulan,
            'dataTahun'=>$data_tahun,
            'tahun'=>$tahun_filter,
            'data_pst'=>$data_pst,
            'data_kantor'=>$data_kantor,
            'data_total'=>$data_total
        ]);
    }
    public function list()
    {
        /*
        select month(tanggal) as bulan, count(*) as total,laki.*, perempuan.* from kunjungan left join (select month(tanggal) as bulan_laki, count(*) as laki from kunjungan left join mtamu on mtamu.id=kunjungan.tamu_id where id_jk=1 and is_pst=0) as laki on laki.bulan_laki=month(tanggal) left join (select month(tanggal) as bulan_perempuan, count(*) as perempuan from kunjungan left join mtamu on mtamu.id=kunjungan.tamu_id where id_jk=2 and is_pst=0) as perempuan on perempuan.bulan_perempuan = month(tanggal) where is_pst=0 GROUP by bulan
        */
        if (request('tahun')==NULL)
        {
            $tahun_filter=date('Y');
        }
        elseif (request('tahun')==0)
        {
            $tahun_filter=date('Y');
        }
        else
        {
            $tahun_filter = request('tahun');
        }

        //$dataKunjungan = Kunjungan::get();
        $data_bulan = array (
            1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
        );
        $data_tahun = DB::table('kunjungan')
                        ->selectRaw('year(tanggal) as tahun')
                        ->groupBy('tahun')
                        ->orderBy('tahun','asc')
                        ->get();
        //dd($data_tahun);
        $dataKunjungan = array();
        for ($i=1; $i <=12 ; $i++) {
            $pst_laki = DB::table('kunjungan')
                      ->leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')
                      ->selectRaw('year(tanggal) as tahun, month(tanggal) as bulan, id_jk, count(*) jumlah')
                      ->where('is_pst','1')
                      ->whereMonth('tanggal',$i)
                      ->whereYear('tanggal',$tahun_filter)
                      ->where('id_jk','1')
                      ->groupBy('bulan','tahun','id_jk')
                      ->first();
            $pst_perempuan = DB::table('kunjungan')
                            ->leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')
                            ->selectRaw('year(tanggal) as tahun, month(tanggal) as bulan, id_jk, count(*) jumlah')
                            ->whereMonth('tanggal',$i)
                            ->whereYear('tanggal',$tahun_filter)
                            ->where('is_pst','1')
                            ->where('id_jk','2')
                            ->groupBy('bulan','tahun','id_jk')
                            ->first();
            $pst_total = DB::table('kunjungan')
                            ->leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')
                            ->selectRaw('year(tanggal) as tahun, month(tanggal) as bulan, count(*) jumlah')
                            ->whereMonth('tanggal',$i)
                            ->whereYear('tanggal',$tahun_filter)
                            ->where('is_pst','1')
                            ->groupBy('bulan','tahun')
                            ->first();
            $kantor_laki = DB::table('kunjungan')
                            ->leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')
                            ->selectRaw('year(tanggal) as tahun, month(tanggal) as bulan, id_jk, count(*) jumlah')
                            ->whereMonth('tanggal',$i)
                            ->whereYear('tanggal',$tahun_filter)
                            ->where('is_pst','0')
                            ->where('id_jk','1')
                            ->groupBy('bulan','tahun','id_jk')
                            ->first();
            $kantor_perempuan = DB::table('kunjungan')
                            ->leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')
                            ->selectRaw('year(tanggal) as tahun, month(tanggal) as bulan, id_jk, count(*) jumlah')
                            ->whereMonth('tanggal',$i)
                            ->whereYear('tanggal',$tahun_filter)
                            ->where('is_pst','0')
                            ->where('id_jk','2')
                            ->groupBy('bulan','tahun','id_jk')
                            ->first();
            $kantor_total = DB::table('kunjungan')
                            ->leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')
                            ->selectRaw('year(tanggal) as tahun, month(tanggal) as bulan, count(*) jumlah')
                            ->whereMonth('tanggal',$i)
                            ->whereYear('tanggal',$tahun_filter)
                            ->where('is_pst','0')
                            ->groupBy('bulan','tahun')
                            ->first();
            if ($pst_laki)
            {
                $jumlah_laki = $pst_laki->jumlah;
            }
            else
            {
                $jumlah_laki = 0;
            }
            if ($pst_perempuan)
            {
                $jumlah_perempuan = $pst_perempuan->jumlah;
            }
            else
            {
                $jumlah_perempuan = 0;
            }
            if ($pst_total)
            {
                $jumlah_pst_total = $pst_total->jumlah;
            }
            else
            {
                $jumlah_pst_total = 0;
            }
            if ($kantor_laki)
            {
                $jumlah_laki_kantor = $kantor_laki->jumlah;
            }
            else
            {
                $jumlah_laki_kantor = 0;
            }
            if ($kantor_perempuan)
            {
                $jumlah_perempuan_kantor = $kantor_perempuan->jumlah;
            }
            else
            {
                $jumlah_perempuan_kantor = 0;
            }
            if ($kantor_total)
            {
                $jumlah_total_kantor = $kantor_total->jumlah;
            }
            else
            {
                $jumlah_total_kantor = 0;
            }
            $dataKunjungan[$i] = array(
                'bulan' => $data_bulan[$i],
                'pst_laki' => $jumlah_laki,
                'pst_perempuan'=> $jumlah_perempuan,
                'pst_total'=> $jumlah_pst_total,
                'kntr_laki' => $jumlah_laki_kantor,
                'kntr_perempuan'=> $jumlah_perempuan_kantor,
                'kntr_total'=> $jumlah_total_kantor
            );
        }
        return view('laporan.index',['dataKunjungan'=>$dataKunjungan,'dataBulan'=>$data_bulan,'dataTahun'=>$data_tahun,'tahun'=>$tahun_filter]);
    }
}
