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
        $pst_laki = DB::table('kunjungan')
                      ->leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')
                      ->selectRaw('year(tanggal) as tahun, month(tanggal) as bulan, id_jk, count(*) jumlah')
                      ->where('is_pst','1')
                      ->where('id_jk','1')
                      ->groupBy('bulan','tahun','id_jk')
                      ->get();
        $pst_perempuan = DB::table('kunjungan')
                        ->leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')
                        ->selectRaw('year(tanggal) as tahun, month(tanggal) as bulan, id_jk, count(*) jumlah')
                        ->where('is_pst','1')
                        ->where('id_jk','2')
                        ->groupBy('bulan','tahun','id_jk')
                        ->get();
        $pst_total = DB::table('kunjungan')
                        ->leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')
                        ->selectRaw('year(tanggal) as tahun, month(tanggal) as bulan, count(*) jumlah')
                        ->where('is_pst','1')
                        ->groupBy('bulan','tahun')
                        ->get();
        $kantor_laki = DB::table('kunjungan')
                        ->leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')
                        ->selectRaw('year(tanggal) as tahun, month(tanggal) as bulan, id_jk, count(*) jumlah')
                        ->where('is_pst','0')
                        ->where('id_jk','1')
                        ->groupBy('bulan','tahun','id_jk')
                        ->get();
        $kantor_perempuan = DB::table('kunjungan')
                        ->leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')
                        ->selectRaw('year(tanggal) as tahun, month(tanggal) as bulan, id_jk, count(*) jumlah')
                        ->where('is_pst','0')
                        ->where('id_jk','2')
                        ->groupBy('bulan','tahun','id_jk')
                        ->get();
        $kantor_total = DB::table('kunjungan')
                        ->leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')
                        ->selectRaw('year(tanggal) as tahun, month(tanggal) as bulan, count(*) jumlah')
                        ->where('is_pst','0')
                        ->groupBy('bulan','tahun')
                        ->get();
        for ($i=1; $i <= 12 ; $i++) { 
            foreach ($pst_laki as $item) {
                if ($i == $item->bulan)
                {
                    $jumlah_laki[$i]=$item->jumlah;
                } 
                else 
                {
                    $jumlah_laki[$i+1]=0;
                }              
            }
            
            foreach ($pst_perempuan as $wanita) {
                if ($i == $wanita->bulan)
                {
                    $jumlah_perempuan[$i]=$wanita->jumlah;
                } 
                else 
                {
                    $jumlah_perempuan[$i+1]=0;
                }              
            }
            foreach ($pst_total as $total) {
                if ($i == $total->bulan)
                {
                    $jumlah_total[$i]=$total->jumlah;
                } 
                else 
                {
                    $jumlah_total[$i+1]=0;
                }              
            }

            foreach ($kantor_laki as $kntrlaki) {
                if ($i == $kntrlaki->bulan)
                {
                    $jumlah_kntr_laki[$i]=$kntrlaki->jumlah;
                } 
                else 
                {
                    $jumlah_kntr_laki[$i+1]=0;
                }              
            }
            foreach ($kantor_perempuan as $kntrwanita) {
                if ($i == $kntrwanita->bulan)
                {
                    $jumlah_kntr_perempuan[$i]=$kntrwanita->jumlah;
                } 
                else 
                {
                    $jumlah_kntr_perempuan[$i+1]=0;
                }              
            }
            foreach ($kantor_total as $kntrtotal) {
                if ($i == $kntrtotal->bulan)
                {
                    $jumlah_kntr_total[$i]=$kntrtotal->jumlah;
                } 
                else 
                {
                    $jumlah_kntr_total[$i+1]=0;
                }              
            }
            $dataKunjungan[$i] = array(
                'bulan' => $data_bulan[$i],
                'pst_laki' => $jumlah_laki[$i],
                'pst_perempuan'=> $jumlah_perempuan[$i],
                'pst_total'=> $jumlah_total[$i],
                'kntr_laki' => $jumlah_kntr_laki[$i],
                'kntr_perempuan'=> $jumlah_kntr_perempuan[$i],
                'kntr_total'=> $jumlah_kntr_total[$i] 
            );
        }
        
        //dd($pst_laki,$pst_perempuan,$pst_total,$jumlah_laki,$jumlah_perempuan,$jumlah_total,$dataKunjungan);
        return view('laporan.index',['dataKunjungan'=>$dataKunjungan,'dataBulan'=>$data_bulan,'dataTahun'=>$data_tahun,'tahun'=>$tahun_filter]);
    }
}
