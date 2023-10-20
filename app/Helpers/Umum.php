<?php
namespace App\Helpers;

use Illuminate\Support\Arr;

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
	public static function LengkapPanjang($tgl)
	{
		$bln_panjang = array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $tahun=date("Y",strtotime($tgl));
	    $tgl_=date("j",strtotime($tgl));
		$bln_indo=date("n",strtotime($tgl));
		$jam=date("H:i",strtotime($tgl));
        $tanggal= $tgl_ .' '.$bln_panjang[$bln_indo].' '.$tahun.' '.$jam;
        return $tanggal;
	}
	public static function LengkapPendek($tgl)
	{
		$bln_panjang = array(1=>"Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
        $tahun=date("Y",strtotime($tgl));
	    $tgl_=date("j",strtotime($tgl));
		$bln_indo=date("n",strtotime($tgl));
		$jam=date("H:i",strtotime($tgl));
        $tanggal= $tgl_ .' '.$bln_panjang[$bln_indo].' '.$tahun.' '.$jam;
        return $tanggal;
	}
	public static function LengkapHariPanjang($tgl)
	{
		$nama_hari_indo = array (0=> "Minggu", 1=> "Senin", 2=> "Selasa", 3=> "Rabu", 4=> "Kamis", 5=> "Jumat", 6=> "Sabtu");
        $bln_panjang = array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $tahun=date("Y",strtotime($tgl));
	    $hari=date("w",strtotime($tgl));
	    $tgl_=date("j",strtotime($tgl));
		$bln_indo=date("n",strtotime($tgl));
		$jam=date("H:i",strtotime($tgl));
        $tanggal= $nama_hari_indo[$hari].', '. $tgl_ .' '.$bln_panjang[$bln_indo].' '.$tahun.' '.$jam;
	    return $tanggal;
	}
	public static function LengkapHariPendek($tgl)
	{
		$nama_hari_indo = array (0=> "Min", 1=> "Sen", 2=> "Sel", 3=> "Rab", 4=> "Kam", 5=> "Jum", 6=> "Sab");
        $bln_panjang = array(1=>"Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
        $tahun=date("Y",strtotime($tgl));
	    $hari=date("w",strtotime($tgl));
	    $tgl_=date("j",strtotime($tgl));
		$bln_indo=date("n",strtotime($tgl));
		$jam=date("H:i",strtotime($tgl));
        $tanggal= $nama_hari_indo[$hari].', '. $tgl_ .' '.$bln_panjang[$bln_indo].' '.$tahun.' '.$jam;
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
    public static function CekAkses($ip)
    {
        $count = \App\MAkses::where('ip',$ip)->count();
        return $count;
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
    public static function GrafikTahunanHc_Lama($tahun)
    {
        /*
        $Data = \DB::table('bulan')->
                leftJoin(\DB::Raw("(select month(tgl_brkt) as bln, count(*) as jumlah,format((sum(kuitansi.total_biaya)/1000000),2) as totalbiaya from transaksi left join kuitansi on kuitansi.trx_id=transaksi.trx_id where flag_trx > 3 and year(tgl_brkt)='".$tahun."' GROUP by bln) as trx"),'bulan.id_bulan','=','trx.bln')->select(\DB::Raw('nama_bulan as y,  COALESCE(jumlah,0) as a,COALESCE(totalbiaya,0) as b'))->get()->toJson();
        */
        $data_total = \DB::table('bulan')
        ->leftJoin(\DB::Raw("(select month(tanggal) as bln_total, count(*) as jumlah_total from kunjungan where year(tanggal)='".$tahun."' GROUP by bln_total) as total"),'bulan.id','=','total.bln_total')
        ->select(\DB::Raw('COALESCE(jumlah_total,0) as k_total'))->get();
        $data_kantor = \DB::table('bulan')
        ->leftJoin(\DB::Raw("(select month(tanggal) as bln_kntr, count(*) as jumlah_kntr from kunjungan where year(tanggal)='".$tahun."' and is_pst='0' GROUP by bln_kntr) as kantor"),'bulan.id','=','kantor.bln_kntr')
        ->select(\DB::Raw('COALESCE(jumlah_kntr,0) as k_kantor'))->get();
        $data_pst = \DB::table('bulan')
        ->leftJoin(\DB::Raw("(select month(tanggal) as bln_pst, count(*) as jumlah_pst from kunjungan where year(tanggal)='".$tahun."' and is_pst='1' GROUP by bln_pst) as pst"),'bulan.id','=','pst.bln_pst')
        ->select(\DB::Raw('COALESCE(jumlah_pst,0) as k_pst'))->get();
        $data_bulan = \DB::table('bulan')->select(\DB::Raw('nama_bulan_pendek'))->get();
        foreach ($data_total as $item)
        {
            $kun_total[] = $item->k_total;
        }
        foreach ($data_kantor as $item)
        {
            $kun_kantor[] = $item->k_kantor;
        }
        foreach ($data_pst as $item)
        {
            $kun_pst[] = $item->k_pst;
        }
        $data[] = array(
            'name'=>'Kunjungan Kantor',
            'data'=>$kun_kantor,
        );
        $data[] = array(
            'name'=>'Kunjungan PST',
            'data'=>$kun_pst,
        );
        $data[] = array(
            'name'=>'Total Kunjungan',
            'data'=>$kun_total,
        );
        //dd($data);
        $data = json_encode($data);
        foreach ($data_bulan as $item)
        {
            $data_bln[]=$item->nama_bulan_pendek;
        }
        $cat_tgl = json_encode($data_bln);
        $arr = array(
            'data_final'=> $data,
            'cat_final'=> $cat_tgl
        );
        //dd($arr);
        return $arr;
    }
    public static function GrafikTahunanHc($tahun)
    {
        /*
        $Data = \DB::table('bulan')->
                leftJoin(\DB::Raw("(select month(tgl_brkt) as bln, count(*) as jumlah,format((sum(kuitansi.total_biaya)/1000000),2) as totalbiaya from transaksi left join kuitansi on kuitansi.trx_id=transaksi.trx_id where flag_trx > 3 and year(tgl_brkt)='".$tahun."' GROUP by bln) as trx"),'bulan.id_bulan','=','trx.bln')->select(\DB::Raw('nama_bulan as y,  COALESCE(jumlah,0) as a,COALESCE(totalbiaya,0) as b'))->get()->toJson();
        */
        $data_total = \DB::table('bulan')
        ->leftJoin(\DB::Raw("(select month(tanggal) as bln_total, count(*) as jumlah_total, sum(jumlah_tamu) as jumlah_tamu, sum(tamu_m) as tamu_laki, sum(tamu_f) as tamu_wanita from kunjungan where year(tanggal)='".$tahun."' GROUP by bln_total) as total"),'bulan.id','=','total.bln_total')
        ->select(\DB::Raw('COALESCE(jumlah_total,0) as k_total, COALESCE(jumlah_tamu,0) as jumlah_tamu, COALESCE(tamu_laki,0) as tamu_laki, COALESCE(tamu_wanita,0) as tamu_wanita'))->get();
        $data_bulan = \DB::table('bulan')->select(\DB::Raw('nama_bulan_pendek'))->get();
        foreach ($data_total as $item)
        {
            $kunjungan[] = $item->k_total;
            $jumlah_tamu[] = (int) $item->jumlah_tamu;
            $tamu_laki[] = (int) $item->tamu_laki;
            $tamu_wanita[] = (int) $item->tamu_wanita;
        }
        $data[] = array(
            'name'=>'Kunjungan',
            'data'=>$kunjungan,
        );
        $data[] = array(
            'name'=>'Jumlah Tamu',
            'data'=>$jumlah_tamu,
        );
        $data[] = array(
            'name'=>'Tamu Laki-laki',
            'data'=>$tamu_laki,
        );
        $data[] = array(
            'name'=>'Tamu Perempuan',
            'data'=>$tamu_wanita,
        );
        //dd($data);
        $data = json_encode($data);
        foreach ($data_bulan as $item)
        {
            $data_bln[]=$item->nama_bulan_pendek;
        }
        $cat_tgl = json_encode($data_bln);
        $arr = array(
            'data_final'=> $data,
            'cat_final'=> $cat_tgl
        );
        //dd($arr);
        return $arr;
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
    public static function GrafikBulananHc_lama($bulan,$tahun)
    {
        $tgl_cek = $tahun.'-'.$bulan.'-01';
        $jumlah_hari = \Carbon\Carbon::parse($tgl_cek)->daysInMonth;
        $kun_kantor = array();
        $kun_pst = array();
        $kun_total = array();
        $cat_tgl = array();
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
                    $k_kantor = 0;
                }
                if ($item_pst)
                {
                    $k_pst = $item_pst->k_pst;
                }
                else
                {
                    $k_pst = 0;
                }
                $kun_kantor[] = $k_kantor;
                $kun_pst[] = $k_pst;
                $kun_total[] = $item->k_jumlah;
            }
            else
            {
                $kun_kantor[] = 0;
                $kun_pst[] = 0;
                $kun_total[] = 0;
            }
            $cat_tgl[]=$i;

        }
        $data[] = array(
            'name'=>'Kunjungan Kantor',
            'data'=>$kun_kantor,
        );
        $data[] = array(
            'name'=>'Kunjungan PST',
            'data'=>$kun_pst,
        );
        $data[] = array(
            'name'=>'Total Kunjungan',
            'data'=>$kun_total,
        );
        $data = json_encode($data);
        $cat_tgl = json_encode($cat_tgl);
        $arr = array(
            'data_final'=>$data,
            'cat_final'=>$cat_tgl
        );
        dd($arr);
        return $arr;
    }
    public static function GrafikBulananHc($bulan,$tahun)
    {
        $tgl_cek = $tahun.'-'.$bulan.'-01';
        $jumlah_hari = \Carbon\Carbon::parse($tgl_cek)->daysInMonth;
        $kunjungan = array();
        $tamu_laki= array();
        $tamu_wanita = array();
        $jumlah_tamu = array();
        $cat_tgl = array();

        for ($i=1;$i<=$jumlah_hari;$i++)
        {

            $item="";
            $tgl_i = $tahun.'-'.$bulan.'-'.$i;
            //if (\Carbon\Carbon::parse($tgl_i)->format('w') > 0 and \Carbon\Carbon::parse($tgl_i)->format('w') < 6)
            //{
                $item = \App\Kunjungan::where('tanggal',\Carbon\Carbon::parse($tgl_i)->format('Y-m-d'))
                    ->select(\DB::Raw('tanggal, COALESCE(count(*),0) as k_jumlah, COALESCE(sum(jumlah_tamu),0) as t_jumlah, COALESCE(sum(tamu_m),0) as tamu_laki, COALESCE(sum(tamu_f),0) as tamu_wanita'))->groupBy('tanggal')->first();
                if ($item)
                {
                    $kunjungan[] = (int) $item->k_jumlah;
                    $jumlah_tamu[]= (int) $item->t_jumlah;
                    $tamu_laki[] = (int) $item->tamu_laki;
                    $tamu_wanita[] = (int) $item->tamu_wanita;
                }
                else
                {
                    $kunjungan[] = 0;
                    $tamu_laki[] = 0;
                    $tamu_wanita[] = 0;
                    $jumlah_tamu[]= 0;
                }
                //ambil info tanggal
                $info_tanggal = \App\MTanggal::where('tanggal',\Carbon\Carbon::parse($tgl_i)->format('Y-m-d'))->first();
                if ($info_tanggal)
                {
                    if ($info_tanggal->jtgl > 1)
                    {
                        $cat_tgl[]=$i.'-'.$info_tanggal->deskripsi;
                    }
                    else
                    {
                        $cat_tgl[]=$i.'-'.$info_tanggal->hari;
                    }
                }
                else
                {
                    $cat_tgl[]=$i;
                }

           // }
        }
        $data[] = array(
            'name'=>'Kunjungan',
            'data'=>$kunjungan,
        );
        $data[] = array(
            'name'=>'Jumlah Tamu',
            'data'=>$jumlah_tamu,
        );
        $data[] = array(
            'name'=>'Tamu Laki-laki',
            'data'=>$tamu_laki,
        );
        $data[] = array(
            'name'=>'Tamu Perempuan',
            'data'=>$tamu_wanita,
        );
        $data = json_encode($data);
        //dd($data);
        $cat_tgl = json_encode($cat_tgl);
        $arr = array(
            'data_final'=>$data,
            'cat_final'=>$cat_tgl
        );
        //dd($arr);
        return $arr;
    }
}
