<?php
namespace App\Helpers;

class Tanggal {
    public static function Panjang($tgl) {
        $bln_panjang = array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $tahun=date("Y",strtotime($tgl));
	    $tgl_=date("j",strtotime($tgl));
	    $bln_indo=date("n",strtotime($tgl));
        $tanggal= $tgl_ .' '.$bln_panjang[$bln_indo].' '.$tahun;
        return $tanggal;
    }

    public static function Pendek($tgl) {
        $bln_panjang = array(1=>"Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
        $tahun=date("Y",strtotime($tgl));
	    $tgl_=date("j",strtotime($tgl));
	    $bln_indo=date("n",strtotime($tgl));
        $tanggal= $tgl_ .' '.$bln_panjang[$bln_indo].' '.$tahun;
        return $tanggal;
    }

    public static function HariPanjang($tgl) {
        $nama_hari_indo = array (0=> "Minggu", 1=> "Senin", 2=> "Selasa", 3=> "Rabu", 4=> "Kamis", 5=> "Jumat", 6=> "Sabtu");
        $bln_panjang = array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $tahun=date("Y",strtotime($tgl));
	    $hari=date("w",strtotime($tgl));
	    $tgl_=date("j",strtotime($tgl));
	    $bln_indo=date("n",strtotime($tgl));
        $tanggal= $nama_hari_indo[$hari].', '. $tgl_ .' '.$bln_panjang[$bln_indo].' '.$tahun;
	    return $tanggal;
    }
    public static function HariPendek($tgl) {
        $nama_hari_indo = array (0=> "Min", 1=> "Sen", 2=> "Sel", 3=> "Rab", 4=> "Kam", 5=> "Jum", 6=> "Sab");
        $bln_panjang = array(1=>"Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
        $tahun=date("Y",strtotime($tgl));
	    $hari=date("w",strtotime($tgl));
	    $tgl_=date("j",strtotime($tgl));
	    $bln_indo=date("n",strtotime($tgl));
        $tanggal= $nama_hari_indo[$hari].', '. $tgl_ .' '.$bln_panjang[$bln_indo].' '.$tahun;
	    return $tanggal;
    }
}
class Generate {
    public static function NoIdentitas($nomor)
    {
        //$no_id = substr($nomor, 0, strlen($nomor)-3).str_repeat('*', 3);
        $no_id = str_repeat('*', (strlen($nomor)-4)).substr($nomor, -4);
        return $no_id;
    }
    public static function Kode($length) {
        $kata='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code_gen = '';
        for ($i = 0; $i < $length; $i++) {
            $pos = rand(0, strlen($kata)-1);
            $code_gen .= $kata[$pos];
            }
        return $code_gen;
    }
    public static function JumlahKunjunganHari($tanggal)
    {
        $count = \App\Kunjungan::whereDate('tanggal',$tanggal)->count();
        return $count;
    }
    public static function JumlahTamuHari($tanggal)
    {
        $sum = \App\Kunjungan::whereDate('tanggal',$tanggal)->sum('jumlah_tamu');
        return $sum;
    }
    public static function JumlahKunjunganBulan($bulan,$tahun)
    {
        $count = \App\Kunjungan::whereYear('tanggal',$tahun)->whereMonth('tanggal',$bulan)->count();
        return $count;
    }
    public static function JumlahTamuBulan($bulan,$tahun)
    {
        $sum = \App\Kunjungan::whereYear('tanggal',$tahun)->whereMonth('tanggal',$bulan)->sum('jumlah_tamu');
        return $sum;
    }
    public static function JumlahKunjunganTahun($tahun)
    {
        $count = \App\Kunjungan::whereYear('tanggal',$tahun)->count();
        return $count;
    }
    public static function JumlahTamuTahun($tahun)
    {
        $sum = \App\Kunjungan::whereYear('tanggal',$tahun)->sum('jumlah_tamu');
        return $sum;
    }
    public static function GrafikTahunan($tahun)
    {
        /*
        $Data = \DB::table('bulan')->
                leftJoin(\DB::Raw("(select month(tgl_brkt) as bln, count(*) as jumlah,format((sum(kuitansi.total_biaya)/1000000),2) as totalbiaya from transaksi left join kuitansi on kuitansi.trx_id=transaksi.trx_id where flag_trx > 3 and year(tgl_brkt)='".$tahun."' GROUP by bln) as trx"),'bulan.id_bulan','=','trx.bln')->select(\DB::Raw('nama_bulan as y,  COALESCE(jumlah,0) as a,COALESCE(totalbiaya,0) as b'))->get()->toJson();
        */
        $data = \DB::table('bulan')
        ->leftJoin(\DB::Raw("(select month(tanggal) as bln_kntr, count(*) as jumlah_kntr, sum(jumlah_tamu) as tamu_kntr from kunjungan where year(tanggal)='".$tahun."' and is_pst='0' GROUP by bln_kntr) as kantor"),'bulan.id','=','kantor.bln_kntr')
        ->leftJoin(\DB::Raw("(select month(tanggal) as bln_pst, count(*) as jumlah_pst, sum(jumlah_tamu) as tamu_pst from kunjungan where year(tanggal)='".$tahun."' and is_pst='1' GROUP by bln_pst) as pst"),'bulan.id','=','pst.bln_pst')
        ->leftJoin(\DB::Raw("(select month(tanggal) as bln_total, count(*) as jumlah_total, sum(jumlah_tamu) as tamu_total from kunjungan where year(tanggal)='".$tahun."' GROUP by bln_total) as total"),'bulan.id','=','total.bln_total')
        ->select(\DB::Raw('nama_bulan as bulan_tahun, COALESCE(jumlah_total,0) as k_total,COALESCE(jumlah_kntr,0) as k_kantor,COALESCE(jumlah_pst,0) as k_pst'))->get()->toJson();
        return $data;
    }
    public static function GrafikBulanan($bulan,$tahun)
    {
        $tgl_cek = $tahun.'-'.$bulan.'-01';
        $jumlah_hari = \Carbon\Carbon::parse($tgl_cek)->daysInMonth;
        $data = array();
        for ($i=1;$i<=$jumlah_hari;$i++)
        {
            $tgl_i = $tahun.'-'.$bulan.'-'.$i;
            $item_kantor = \App\Kunjungan::where('tanggal',\Carbon\Carbon::parse($tgl_i)->format('Y-m-d'))->where('is_pst','0')
                    ->select(\DB::Raw('tanggal, COALESCE(count(*),0) as k_kantor, COALESCE(sum(jumlah_tamu),0) as t_kantor'))->groupBy('tanggal')->first();
            $item_pst = \App\Kunjungan::where('tanggal',\Carbon\Carbon::parse($tgl_i)->format('Y-m-d'))->where('is_pst','1')
                    ->select(\DB::Raw('tanggal, COALESCE(count(*),0) as k_pst, COALESCE(sum(jumlah_tamu),0) as t_pst'))->groupBy('tanggal')->first();
            $item = \App\Kunjungan::where('tanggal',\Carbon\Carbon::parse($tgl_i)->format('Y-m-d'))
                    ->select(\DB::Raw('tanggal, COALESCE(count(*),0) as k_jumlah, COALESCE(sum(jumlah_tamu),0) as t_jumlah'))->groupBy('tanggal')->first();
            if ($item)
            {
                if ($item_kantor)
                {
                    $k_kantor = $item_kantor->k_kantor;
                }
                else
                {
                    $k_kantor = null;
                }
                if ($item_pst)
                {
                    $k_pst = $item_pst->k_pst;
                }
                else
                {
                    $k_pst = null;
                }
                $data[] = array(
                    'tanggal'=>$i,
                    'k_total'=>$item->k_jumlah,
                    'k_kantor'=>$k_kantor,
                    'k_pst'=>$k_pst,
                );
            }
            else
            {
                $data[] = array(
                    'tanggal'=>$i,
                    'k_total'=>null,
                    'k_kantor'=>null,
                    'k_pst'=>null,
                );
            }

        }
        //dd($data);
        $data = json_encode($data);
        return $data;
    }
}
