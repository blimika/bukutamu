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
        $Mfasilitas = Mfasilitas::orderBy('id','asc')->get();
        $Kunjungan = Kunjungan::with('tamu')->whereDate('tanggal', Carbon::today())->orderBy('id','desc')->get();
        $Mtamu = Mtamu::orderBy('id','asc')->get();
        return view('depan',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mtamu' => $Mtamu, 'Kunjungan'=> $Kunjungan,'Mfasilitas'=>$Mfasilitas]);
    }

    public function lama()
    {
        $Midentitas = Midentitas::orderBy('id','asc')->get();
        $Mpekerjaan = Mpekerjaan::orderBy('id','asc')->get();
        $Mjk = Mjk::orderBy('id','asc')->get();
        $Mpendidikan = Mpendidikan::orderBy('id','asc')->get();
        $Mkatpekerjaan = Mkatpekerjaan::orderBy('id','asc')->get();
        $Mwarga = Mwarga::orderBy('id','asc')->get();
        $MKunjungan = MKunjungan::orderBy('id','asc')->get();
        $Mlayanan = Mlayanan::orderBy('id','asc')->get();
        $Kunjungan = Kunjungan::with('tamu')->orderBy('tanggal','desc')->get();
        $Mtamu = Mtamu::orderBy('id','asc')->get();
        $Mfasilitas = Mfasilitas::orderBy('id','asc')->get();
        return view('lama.list',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mtamu' => $Mtamu, 'Kunjungan'=> $Kunjungan,'Mfasilitas'=>$Mfasilitas]);
    }

    public function simpan(Request $request)
    {
        //$layanan= $request->pst_layanan;
        //$pst_layanan = Mlayanan::whereIn('id',$request->pst_layanan)->get();
        //$test = $request->pst_layanan;
        //dd($request->all());
        //dd($request->all());
        
        if ($request->tamu_id==NULL) {
            $data = new Mtamu();
            $data->id_midentitas = $request->jenis_identitas;
            $data->nomor_identitas = trim($request->nomor_identitas);
            $data->nama_lengkap = trim($request->nama_lengkap);
            $data->tgl_lahir = $request->tgl_lahir;
            $data->id_jk = $request->id_jk;
            $data->id_mkerja = $request->id_kerja;
            $data->id_mkat_kerja = $request->kat_kerja;
            $data->kerja_detil = $request->pekerjaan_detil;
            $data->id_mdidik = $request->id_mdidik;
            $data->id_mwarga = $request->mwarga;
            $data->email = $request->email;
            $data->telepon = trim($request->telepon);
            $data->alamat = $request->alamat;
            $data->created_at = \Carbon\Carbon::now();
            $data->save();
            $id_tamu = $data->id;
            $pesan_error = 'Data pengunjung '.trim($request->nama_lengkap).' berhasil ditambahkan';
            $warna_error = 'info';
        }
        else {
            //cek apakah di update apa tidak edit_tamu = 1 (edit)
            if ($request->edit_tamu==1) {
                //edit data tamu
                $data = Mtamu::where('id','=',$request->tamu_id)->first();
                $data->id_midentitas = $request->jenis_identitas;
                $data->nomor_identitas = trim($request->nomor_identitas);
                $data->nama_lengkap = trim($request->nama_lengkap);
                $data->tgl_lahir = $request->tgl_lahir;
                $data->id_jk = $request->id_jk;
                $data->id_mkerja = $request->id_kerja;
                $data->id_mkat_kerja = $request->kat_kerja;
                $data->kerja_detil = $request->pekerjaan_detil;
                $data->id_mdidik = $request->id_mdidik;
                $data->id_mwarga = $request->mwarga;
                $data->email = trim($request->email);
                $data->telepon = trim($request->telepon);
                $data->alamat = $request->alamat;
                $data->update();
                $pesan_error = 'Data pengunjung '.trim($request->nama_lengkap).' berhasil ditambahkan dan Diperbarui';
                $warna_error = 'success';
            }
            else {
                //data tamu tidak Diperbarui
                $pesan_error = 'Data pengunjung berhasil ditambahkan';
                $warna_error = 'info';
            }
            $id_tamu = $request->tamu_id;
        }
        //$dataTamu = Mtamu::where('nomor_identitas','=',$request->nomor_identitas)->first();
        

        if ($request->pst==NULL) { 
            $is_pst=0;
            $f_id = 0;
        }
        else { 
            $is_pst=$request->pst;
            $f_id = $request->fasilitas_utama;
        }
        //cek dulu apakah hari ini juga sudah mengisi
        //kalo sudah ada tidak bisa mengisi dua kali bukutamu
        $data = Mtamu::where('id','=',$id_tamu)->first();
        $cek_kunjungan = Kunjungan::where([['tamu_id',$id_tamu],['tanggal',Carbon::today()->format('Y-m-d')],['is_pst',$is_pst]])->count();
        if ($cek_kunjungan > 0 )
        {
            //sudah ada kasih info kalo sudah mengisi
            $pesan_error = 'Data pengunjung '.$data->nama_lengkap.' sudah pernah mengisi bukutamu hari tanggal '.Carbon::today()->isoFormat('dddd, D MMMM Y');
            $warna_error = 'danger';
        }
        else 
        {
            $dataKunjungan = new Kunjungan();
            $dataKunjungan->tamu_id = $id_tamu;
            $dataKunjungan->tanggal = Carbon::today()->format('Y-m-d');
            $dataKunjungan->keperluan = $request->keperluan;
            $dataKunjungan->is_pst = $is_pst;
            $dataKunjungan->f_id = $f_id;
            $dataKunjungan->save();
            if ($is_pst>0) {
                //isi tabel pst_layanan dan pst_manfaat
                $pst_layanan = Mlayanan::whereIn('id',$request->pst_layanan)->get();
                $pst_manfaat = MKunjungan::whereIn('id',$request->pst_manfaat)->get();
                $kunjungan_id = $dataKunjungan->id;
                foreach ($pst_layanan as $l) 
                {
                    $dataLayanan = new Pstlayanan();
                    $dataLayanan->kunjungan_id = $kunjungan_id;
                    $dataLayanan->layanan_id = $l->id;
                    $dataLayanan->layanan_nama = $l->nama;
                    $dataLayanan->save();
                }
                foreach ($pst_manfaat as $m) 
                {
                    $dataManfaat = new Pstmanfaat();
                    $dataManfaat->kunjungan_id = $kunjungan_id;
                    $dataManfaat->manfaat_id = $m->id;
                    $dataManfaat->manfaat_nama = $m->nama;
                    $dataManfaat->save();
                }
                
            }
        }
        Session::flash('message', $pesan_error);
        Session::flash('message_type', $warna_error);
        return redirect()->route('depan');
    }

    public function SimpanLama(Request $request)
    {
        //$layanan= $request->pst_layanan;
        //$pst_layanan = Mlayanan::whereIn('id',$request->pst_layanan)->get();
        //$test = $request->pst_layanan;
        //dd($request->all());
        //dd($pst_layanan);
        
        if ($request->tamu_id_lama==NULL) {
            $data = new Mtamu();
            $data->id_midentitas = $request->jenis_identitas_lama;
            $data->nomor_identitas = trim($request->nomor_identitas_lama);
            $data->nama_lengkap = trim($request->nama_lengkap_lama);
            $data->tgl_lahir = $request->tgl_lahir_lama;
            $data->id_jk = $request->id_jk_lama;
            $data->id_mkerja = $request->id_kerja_lama;
            $data->id_mkat_kerja = $request->kat_kerja_lama;
            $data->kerja_detil = $request->pekerjaan_detil_lama;
            $data->id_mdidik = $request->id_mdidik_lama;
            $data->id_mwarga = $request->mwarga_lama;
            $data->email = $request->email_lama;
            $data->telepon = trim($request->telepon_lama);
            $data->alamat = $request->alamat_lama;
            $data->created_at = \Carbon\Carbon::now();
            $data->save();
            $id_tamu = $data->id;
            $pesan_error = 'Data pengunjung lama berhasil ditambahkan';
            $warna_error = 'info';
        }
        else {
            //cek apakah di update apa tidak edit_tamu_lama = 1 (edit)
            if ($request->edit_tamu_lama==1)
            {
                $data = Mtamu::where('id','=',$request->tamu_id_lama)->first();
                $data->id_midentitas = $request->jenis_identitas_lama;
                $data->nomor_identitas = trim($request->nomor_identitas_lama);
                $data->nama_lengkap = trim($request->nama_lengkap_lama);
                $data->tgl_lahir = $request->tgl_lahir_lama;
                $data->id_jk = $request->id_jk_lama;
                $data->id_mkerja = $request->id_kerja_lama;
                $data->id_mkat_kerja = $request->kat_kerja_lama;
                $data->kerja_detil = $request->pekerjaan_detil_lama;
                $data->id_mdidik = $request->id_mdidik_lama;
                $data->id_mwarga = $request->mwarga_lama;
                $data->email = $request->email_lama;
                $data->telepon = trim($request->telepon_lama);
                $data->alamat = $request->alamat_lama;
                $data->update();
                $pesan_error = 'Data pengunjung '.trim($request->nama_lengkap_lama).' berhasil ditambahkan dan Diperbarui';
                $warna_error = 'success';
            }
            else {
                //data tamu tidak Diperbarui
                $pesan_error = 'Data pengunjung '.trim($request->nama_lengkap_lama).' berhasil ditambahkan';
                $warna_error = 'info';
            }
            $id_tamu = $request->tamu_id_lama;
        }
        //$dataTamu = Mtamu::where('nomor_identitas','=',$request->nomor_identitas)->first();
        if ($request->pst_lama==NULL) 
        { 
            $is_pst_lama=0;
            $f_id_lama = 0;
        }
        else 
        { 
            $is_pst_lama = $request->pst_lama;
            $f_id_lama = $request->fasilitas_utama_lama; 
        }
        $data = Mtamu::where('id','=',$id_tamu)->first();
        $cek_kunjungan = Kunjungan::where([['tamu_id',$id_tamu],['tanggal',Carbon::parse($request->tgl_kunjungan)->format('Y-m-d')],['is_pst',$is_pst_lama]])->count();
        if ($cek_kunjungan > 0 )
        {
            //sudah ada kasih info kalo sudah mengisi
            $pesan_error = 'Data pengunjung '.$data->nama_lengkap.' sudah pernah mengisi bukutamu hari tanggal '.Carbon::parse($request->tgl_kunjungan)->isoFormat('dddd, D MMMM Y');
            $warna_error = 'danger';
        }
        else 
        {
            $dataKunjungan = new Kunjungan();
            $dataKunjungan->tamu_id = $id_tamu;
            $dataKunjungan->tanggal =  Carbon::parse($request->tgl_kunjungan)->format('Y-m-d');
            $dataKunjungan->keperluan = $request->keperluan_lama;
            $dataKunjungan->is_pst = $is_pst_lama;
            $dataKunjungan->f_id = $f_id_lama;
            $dataKunjungan->save();

            if ($is_pst_lama>0) {
                //isi tabel pst_layanan dan pst_manfaat
                $pst_layanan_lama = Mlayanan::whereIn('id',$request->pst_layanan_lama)->get();
                $pst_manfaat_lama = MKunjungan::whereIn('id',$request->pst_manfaat_lama)->get();
                $kunjungan_id = $dataKunjungan->id;
                foreach ($pst_layanan_lama as $l) 
                {
                    $dataLayanan = new Pstlayanan();
                    $dataLayanan->kunjungan_id = $kunjungan_id;
                    $dataLayanan->layanan_id = $l->id;
                    $dataLayanan->layanan_nama = $l->nama;
                    $dataLayanan->save();
                }
                foreach ($pst_manfaat_lama as $m) 
                {
                    $dataManfaat = new Pstmanfaat();
                    $dataManfaat->kunjungan_id = $kunjungan_id;
                    $dataManfaat->manfaat_id = $m->id;
                    $dataManfaat->manfaat_nama = $m->nama;
                    $dataManfaat->save();
                }
                
            }
        }
        Session::flash('message', $pesan_error);
        Session::flash('message_type', $warna_error);
        return redirect()->route('lama');
    }
    public function editdata($id)
    {}
    public function updatedata(Request $request)
    {}
    public function hapus(Request $request)
    {
        //get dulu datanya
        //apabila is_pst = 1 
        // hapus di tabel pst_layanan dan pst_manfaat
        $count = Kunjungan::where('id',$request->id)->count();
        $arr = array(
            'status'=>false,
            'hasil'=>'Data kunjungan tidak tersedia'
        );
        if ($count>0)
        {
            $data = Kunjungan::where('id',$request->id)->first();
            if ($data->is_pst == 1)
            {
                Pstlayanan::where('kunjungan_id',$request->id)->delete();
                Pstmanfaat::where('kunjungan_id',$request->id)->delete();
            }
            $nama = $data->tamu->nama_lengkap;
            $data->delete();
            $arr = array(
                'status'=>true,
                'hasil'=>'Data kunjungan an. '.$nama.' berhasil dihapus'
            );
        }
        return Response()->json($arr);
    }
    public function getDataKunjungan($id)
    {
        $data = Kunjungan::with('tamu','pLayanan','pManfaat')->where('id','=',$id)->first();
        $arr = array('hasil' => 'Data tidak tersedia', 'status' => false);
        if ($data) {
            $arr = array(
                 'hasil'=> $data,
                 'status'=> true
            );
        }
        return Response()->json($arr);
        //dd($data);
        //$arr = array('hasil' => 'Data tidak tersedia', 'status' => false);
    }
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
