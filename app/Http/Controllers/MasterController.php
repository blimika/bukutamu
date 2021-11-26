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
use App\Helpers\Generate;
use App\Feedback;
use Illuminate\Support\Facades\Storage;
use QrCode;

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
            //create qrcode simpan di public
            //$qrcode = base64_encode(QrCode::format('png')->size(100)->margin(0)->generate($dataCek->kode_qr));
            /*
            $qrcode_foto = QrCode::format('png')
                    ->size(200)->errorCorrection('H')
                     ->generate($dataCek->kode_qr);
            $output_file = '/img/qrcode/'.$dataCek->kode_qr.'-'.$dataCek->id.'.png';
            //$data_foto = base64_decode($qrcode_foto);
            Storage::disk('public')->put($output_file, $qrcode_foto);
            $cek_kunjungan = Kunjungan::where('tamu_id',$dataCek->id)->count();
            $arr_kunjungan = array('hasil'=>'Data Kunjungan Kosong','status'=>false);
            if ($cek_kunjungan > 0)
            {
                //ada kunjungan
                $dataKunjungan = Kunjungan::with('tamu','pLayanan','pManfaat')->where('tamu_id',$dataCek->id)->get();
                foreach ($dataKunjungan as $item)
                {
                    $dataItem[] = array(
                            'id'=>$item->id,
                            'tanggal'=>$item->tanggal,
                            'tanggal_nama'=>Carbon::parse($item->tanggal)->isoFormat('D MMMM Y'),
                            'keperluan'=>$item->keperluan,
                            'is_pst'=>$item->is_pst,
                            'f_id'=>$item->f_id,
                            'f_feedback'=>$item->f_feedback,
                            'file_foto'=>$item->file_foto,
                            'created_at'=>$item->created_at,
                            'created_at_nama'=>Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                            'updated_at'=>$item->updated_at,
                            'updated_at_nama'=>Carbon::parse($item->updated_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                    );  
                }
                $arr_kunjungan = array(
                    'hasil' => $dataItem,
                    'status'=>true,
                    'jumlah'=>$cek_kunjungan
                );
            }
           */
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
                    'kode_qr'=>$dataCek->kode_qr,
                    'created_at'=>$dataCek->created_at,
                    'created_at_nama'=>Carbon::parse($dataCek->created_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                    'updated_at'=>$dataCek->updated_at,
                    'updated_at_nama'=>Carbon::parse($dataCek->updated_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                    'url_foto'=>$dataCek->tamu_foto,
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
            //$data->delete();
            $namafile_photo = $data->tamu_foto;
            $data->delete();
            if ($data->tamu_foto != NULL)
            {
                Storage::disk('public')->delete($namafile_photo);
            }
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
                    $cek_feedback = Feedback::where('kunjungan_id',$item->id)->count();
                    if ($cek_feedback > 0)
                    {
                        Feedback::where('kunjungan_id',$item->id)->delete();
                    }
                    $namafile_kunjungan = $item->file_foto;
                    Storage::disk('public')->delete($namafile_kunjungan);
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
    public function SyncKodePengunjung()
    {
        $count = Mtamu::count();
        if ($count > 0)
        {
            $data = Mtamu::get();
            foreach ($data as $item)
            {
                if ($item->kode_qr == NULL)
                {
                    $qrcode_foto = '';
                    $qrcode = Generate::Kode(6);
                    $data_update = Mtamu::where('id',$item->id)->first();
                    $data_update->kode_qr = $qrcode;
                    $data_update->update();

                    //buat qrcode img nya langsung
                    $qrcode_foto = QrCode::format('png')
                    ->size(400)->margin(1)->errorCorrection('H')
                    ->generate($qrcode);
                    $output_file = '/img/qrcode/'.$qrcode.'-'.$item->id.'.png';
                    //$data_foto = base64_decode($qrcode_foto);
                    Storage::disk('public')->put($output_file, $qrcode_foto);
                }
            }
            $pesan_error = 'Data pengunjung berhasil sync';
            $warna_error = 'success';
        }
        else
        {
            $pesan_error = 'Data pengunjung masih kosong';
            $warna_error = 'danger';
        }

        Session::flash('message', $pesan_error);
        Session::flash('message_type', $warna_error);
        return redirect()->route('pengunjung.list');
    }
    public function SyncPhoto()
    {
        //ubah nama file di mtamu dan kunjungan
        //kunjungan
        $namafile_kunjungan = '/img/kunjungan/';
        $namafile_profil = '/img/profil/';

        //ambil data kunjungan
        $countKunjungan = Kunjungan::count();
        if ($countKunjungan > 0)
        {
            //proses nama
            $dataKunjungan = Kunjungan::get();
            foreach ($dataKunjungan as $item)
            {
                if ($item->file_foto != NULL)
                {
                    //cek dulu nama file sudah ada tanda / didepannya
                    if (substr($item->file_foto, 0, 1) != '/')
                    {
                        //update isiannya
                        $data_update = Kunjungan::where('id',$item->id)->first();
                        $data_update->file_foto = '/img/kunjungan/'.$item->file_foto;
                        $data_update->update();
                    }
                }
            }
            $pesan_error1 = 'Data photo kunjungan berhasil di sync';
            $warna_error = 'success';
        }
        else 
        {
            $pesan_error1 = 'Data kunjungan masih kosong';
            $warna_error = 'danger';
        }
        $countTamu = Mtamu::count();
        if ($countTamu > 0)
        {
            //data tamu ada
            $dataMtamu = Mtamu::get();
            foreach ($dataMtamu as $item)
            {
                if ($item->tamu_foto != NULL)
                {
                    //cek dulu nama file sudah ada tanda / didepannya
                    if (substr($item->tamu_foto, 0, 1) != '/')
                    {
                        //update isiannya
                        $data_update = Mtamu::where('id',$item->id)->first();
                        $data_update->tamu_foto = '/img/profil/'.$item->tamu_foto;
                        $data_update->update();
                    }
                }
            }
            $pesan_error = $pesan_error1 .' dan Data photo kunjungan berhasil di sync';
            $warna_error = 'success';
        }
        else 
        {
            $pesan_error = $pesan_error1 .' dan Data Tamu masih kosong';
            $warna_error = 'danger';
        }
        

        Session::flash('message', $pesan_error);
        Session::flash('message_type', $warna_error);
        return redirect()->route('pengunjung.list');
    }
}
