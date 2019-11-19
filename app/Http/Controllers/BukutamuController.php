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
class BukutamuController extends Controller
{
    //
    public function depan()
    {
        $Midentitas = Midentitas::orderBy('id','asc')->get();
        $Mpekerjaan = Mpekerjaan::orderBy('id','asc')->get();
        $Mjk = Mjk::orderBy('id','asc')->get();
        $Mpendidikan = Mpendidikan::orderBy('id','asc')->get();
        $Mkatpekerjaan = Mkatpekerjaan::orderBy('id','asc')->get();
        $Mwarga = Mwarga::orderBy('id','asc')->get();
        $MKunjungan = MKunjungan::orderBy('id','asc')->get();
        $Mlayanan = Mlayanan::orderBy('id','asc')->get();
        $Kunjungan = Kunjungan::with('tamu')->whereDate('created_at', Carbon::today())->orderBy('id','desc')->get();
        $Mtamu = Mtamu::orderBy('id','asc')->get();
        return view('depan',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mtamu' => $Mtamu, 'Kunjungan'=> $Kunjungan]);
    }

    public function simpan(Request $request)
    {
        //$layanan= $request->pst_layanan;
        //$pst_layanan = Mlayanan::whereIn('id',$request->pst_layanan)->get();
        //$test = $request->pst_layanan;
        //dd($request->all());
        //dd($pst_layanan);
        
        if ($request->tamu_id==NULL) {
            $data = new Mtamu();
            $data -> id_midentitas = $request->jenis_identitas;
            $data -> nomor_identitas = trim($request->nomor_identitas);
            $data -> nama_lengkap = trim($request->nama_lengkap);
            $data -> tgl_lahir = $request->tgl_lahir;
            $data -> id_jk = $request->id_jk;
            $data -> id_mkerja = $request->id_kerja;
            $data -> id_mkat_kerja = $request->kat_kerja;
            $data -> kerja_detil = $request->pekerjaan_detil;
            $data -> id_mdidik = $request->id_mdidik;
            $data -> id_mwarga = $request->mwarga;
            $data -> email = $request->email;
            $data -> telepon = trim($request->telepon);
            $data -> alamat = $request->alamat;
            $data -> created_at = \Carbon\Carbon::now();
            $data -> save();
            $id_tamu = $data->id;
        }
        else {
            $id_tamu = $request->tamu_id;
        }
        //$dataTamu = Mtamu::where('nomor_identitas','=',$request->nomor_identitas)->first();
        

        $dataKunjungan = new Kunjungan();
        $dataKunjungan -> tamu_id = $id_tamu;
        $dataKunjungan -> keperluan = $request->keperluan;
        if ($request->pst==NULL) { $is_pst=0;}
        else { $is_pst=$request->pst; }
        $dataKunjungan -> is_pst = $is_pst;
        $dataKunjungan -> save();

        if ($is_pst>0) {
            //isi tabel pst_layanan dan pst_manfaat
            $pst_layanan = Mlayanan::whereIn('id',$request->pst_layanan)->get();
            $pst_manfaat = MKunjungan::whereIn('id',$request->pst_manfaat)->get();
            $kunjungan_id = $dataKunjungan->id;
            foreach ($pst_layanan as $l) 
            {
                $dataLayanan = new Pstlayanan();
                $dataLayanan -> kunjungan_id = $kunjungan_id;
                $dataLayanan -> layanan_id = $l->id;
                $dataLayanan -> layanan_nama = $l->nama;
                $dataLayanan -> save();
            }
            foreach ($pst_manfaat as $m) 
            {
                $dataManfaat = new Pstmanfaat();
                $dataManfaat -> kunjungan_id = $kunjungan_id;
                $dataManfaat -> manfaat_id = $m->id;
                $dataManfaat -> manfaat_nama = $m->nama;
                $dataManfaat -> save();
            }
            
        }

        Session::flash('message', 'Data pengunjung berhasil di tambahkan');
        Session::flash('message_type', 'success');
        return redirect()->route('depan');
        
    }
    public function editdata($id)
    {}
    public function updatedata(Request $request)
    {}
    public function hapus(Request $request)
    {}
    public function cekID($jenis_identitas,$nomor_identitas)
    {
        $dataCek = Mtamu::where([['id_midentitas','=',$jenis_identitas],['nomor_identitas','=',$nomor_identitas]])->first();
        $arr = array('hasil' => 'Data tidak tersedia', 'status' => false);
        if ($dataCek) {
            //nomor identitas ada / tamu sudah pernah datang
            $arr = array(
                'hasil' => array(
                    'tamu_id'=>$dataCek->id,
                    'nama_lengkap'=>$dataCek->nama_lengkap,
                    'tgl_lahir'=>$dataCek->tgl_lahir,
                    'id_jk'=>$dataCek->id_jk,
                    'id_kerja'=>$dataCek->id_mkerja,
                    'kat_kerja'=>$dataCek->id_mkat_kerja,
                    'pekerjaan_detil'=>$dataCek->kerja_detil,
                    'id_mdidik'=>$dataCek->id_mdidik ,
                    'mwarga'=>$dataCek->id_mwarga,
                    'email'=>$dataCek->email,
                    'telepon'=>$dataCek->telepon ,
                    'alamat'=>$dataCek->alamat
                ), 
                'status' => true
            );
        }
        return Response()->json($arr);
    }
}
