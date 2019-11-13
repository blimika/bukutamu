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
        $Kunjungan = Kunjungan::with('tamu')->orderBy('id','desc')->get();
        $Mtamu = Mtamu::orderBy('id','asc')->get();
        return view('depan',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mtamu' => $Mtamu, 'Kunjungan'=> $Kunjungan]);
    }

    public function simpan(Request $request)
    {
        //$test = $request->pst_layanan;
        //dd($request->all());
        
        $data = new Mtamu();
        $data -> id_midentitas = $request->jenis_identitas;
        $data -> nomor_identitas = $request->nomor_identitas;
        $data -> nama_lengkap = $request->nama_lengkap;
        $data -> tgl_lahir = $request->tgl_lahir;
        $data -> id_jk = $request->jk;
        $data -> id_mkerja = $request->id_kerja;
        $data -> id_mkat_kerja = $request->kat_kerja;
        $data -> kerja_detil = $request->pekerjaan_detil;
        $data -> id_mdidik = $request->id_mdidik;
        $data -> id_mwarga = $request->mwarga;
        $data -> email = $request->email;
        $data -> telepon = $request->telepon;
        $data -> alamat = $request->alamat;
        $data -> save();

        //$dataTamu = Mtamu::where('nomor_identitas','=',$request->nomor_identitas)->first();
        $id_tamu = $data->id;

        $dataKunjungan = new Kunjungan();
        $dataKunjungan -> tamu_id = $id_tamu;
        $dataKunjungan -> keperluan = $request->keperluan;
        if ($request->pst==NULL) { $ispst=0;}
        else { $ispst=$request->pst; }
        $dataKunjungan -> ispst = $ispst;
        $dataKunjungan -> pst_layanan = $request->pst_layanan;
        $dataKunjungan -> pst_manfaat = $request->pst_manfaat;         
        $dataKunjungan -> save();

        Session::flash('message', 'Data tamu berhasil di tambahkan');
        Session::flash('message_type', 'success');
        return redirect()->route('depan');
    }
    public function editdata($id)
    {}
    public function updatedata(Request $request)
    {}
    public function hapus(Request $request)
    {}
}
