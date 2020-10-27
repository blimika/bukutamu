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

class MasterController extends Controller
{
    //
    public function ListPengunjung()
    {
        $Mtamu = Mtamu::orderBy('id','asc')->get();
        return view('master.listpengunjung',['dataTamu'=>$Mtamu]);
    }
    public function CariPengunjung($id)
    {
        $dataCek = Mtamu::where('id',$id)->first();
        $arr = array('hasil' => 'Data pengunjung tidak tersedia', 'status' => false);
        if ($dataCek) {
            //data tamu tersedia
            $arr = array(
                'hasil' => array(
                    'tamu_id'=>$dataCek->id,
                    'id_identitas'=>$dataCek->id_midentitas,
                    'id_identitas_nama'=>$dataCek->identitas->nama,
                    'nomor_identitas'=>$dataCek->nomor_identitas,
                    'nama_lengkap'=>$dataCek->nama_lengkap,
                    'tgl_lahir'=>$dataCek->tgl_lahir,
                    'tgl_lahir_nama'=>Carbon::parse($dataCek->tgl_lahir)->isoFormat('D MMMM Y'),
                    'id_jk'=>$dataCek->id_jk,
                    'nama_jk'=>$dataCek->jk->nama,
                    'inisial_jk'=>$dataCek->jk->inisial,
                    'id_kerja'=>$dataCek->id_mkerja,
                    'nama_kerja'=>$dataCek->pekerjaan->nama,
                    'kat_kerja'=>$dataCek->id_mkat_kerja,
                    'kat_kerja_nama'=>$dataCek->kategoripekerjaan->nama,
                    'kerja_detil'=>$dataCek->kerja_detil,
                    'id_mdidik'=>$dataCek->id_mdidik,
                    'nama_mdidik'=>$dataCek->pendidikan->nama ,
                    'id_mwarga'=>$dataCek->id_mwarga,
                    'nama_mwarga'=>$dataCek->warga->nama,
                    'email'=>$dataCek->email,
                    'telepon'=>$dataCek->telepon ,
                    'alamat'=>$dataCek->alamat,
                    'created_at'=>$dataCek->created_at,
                    'created_at_nama'=>Carbon::parse($dataCek->created_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                    'updated_at'=>$dataCek->updated_at,
                    'updated_at_nama'=>Carbon::parse($dataCek->updated_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                ), 
                'status' => true
            );
        }
        return Response()->json($arr);
    }
    public function HapusPengunjung(Request $request)
    {

        $count = Mtamu::where('id',$request->id)->count();
        $arr = array(
            'status'=>false,
            'hasil'=>'Data pengunjung tidak tersedia'
        );
        if ($count>0)
        {
            $data = Mtamu::where('id',$request->id)->first();
            $nama = $data->nama_lengkap;
            $data->delete();
            $cek_kunjungan = Kunjungan::where('tamu_id',$request->id)->count();
            if ($cek_kunjungan > 0)
            {
                $dataKunjungan = Kunjungan::where('tamu_id',$request->id)->get();
                foreach ($dataKunjungan as $item)
                {
                    if ($item->is_pst == 1)
                    {
                        Pstlayanan::where('kunjungan_id',$item->id)->delete();
                        Pstmanfaat::where('kunjungan_id',$item->id)->delete();
                    }
                }
                Kunjungan::where('tamu_id',$request->id)->delete();
            }
            $arr = array(
                'status'=>true,
                'hasil'=>'Data pengunjung an. '.$nama.' berhasil dihapus beserta data kunjungan'
            );
        }
        return Response()->json($arr);
    }
}
