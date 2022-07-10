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
use App\Feedback;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Generate;
use QrCode;

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
        return view('new-depan',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mtamu' => $Mtamu, 'Kunjungan'=> $Kunjungan,'Mfasilitas'=>$Mfasilitas]);
    }

    public function lama()
    {
        $data_bulan = array(
            1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
        );
        $data_tahun = DB::table('kunjungan')
                    ->selectRaw('year(tanggal) as tahun')
                    ->groupBy('tahun')
                    ->orderBy('tahun','asc')
                      ->get();
        //dd($data_tahun);
        //filter
        if (request('tamu_pst')==NULL)
        {
            $tamu_filter = 9;
        }
        elseif (request('tamu_pst')==0)
        {
            $tamu_filter = 0;
        }
        else
        {
            $tamu_filter = request('tamu_pst');
        }
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
        if (request('bulan')==NULL)
        {
            $bulan_filter= (int) date('m');
        }
        elseif (request('bulan')==0)
        {
            $bulan_filter = NULL;
        }
        else
        {
            $bulan_filter = request('bulan');
        }
        //batas filter
        $Midentitas = Midentitas::orderBy('id','asc')->get();
        $Mpekerjaan = Mpekerjaan::orderBy('id','asc')->get();
        $Mjk = Mjk::orderBy('id','asc')->get();
        $Mpendidikan = Mpendidikan::orderBy('id','asc')->get();
        $Mkatpekerjaan = Mkatpekerjaan::orderBy('id','asc')->get();
        $Mwarga = Mwarga::orderBy('id','asc')->get();
        $MKunjungan = MKunjungan::orderBy('id','asc')->get();
        $Mlayanan = Mlayanan::orderBy('id','asc')->get();
        $Mtamu = Mtamu::orderBy('id','asc')->get();
        $Mfasilitas = Mfasilitas::orderBy('id','asc')->get();
        $Kunjungan = Kunjungan::with('tamu')
                        ->when($tamu_filter < 9,function ($query) use ($tamu_filter){
                            return $query->where('is_pst','=',$tamu_filter);
                        })
                        ->when($bulan_filter,function ($query) use ($bulan_filter){
                            return $query->whereMonth('tanggal','=',$bulan_filter);
                        })
                        ->whereYear('tanggal','=',$tahun_filter)
                        ->orderBy('tanggal','desc')->get();
        //dd($tamu_filter);
        return view('lama.list',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mtamu' => $Mtamu, 'Kunjungan'=> $Kunjungan,'Mfasilitas'=>$Mfasilitas,'bulan'=>$bulan_filter,'tahun'=>$tahun_filter,'dataBulan'=>$data_bulan,'dataTahun'=>$data_tahun,'tamupst'=>$tamu_filter]);
    }

    public function simpan(Request $request)
    {
        //$layanan= $request->pst_layanan;
        //$pst_layanan = Mlayanan::whereIn('id',$request->pst_layanan)->get();
        //$test = $request->pst_layanan;
        //dd($request->all());
        //dd($request->all());
        //$foto = $request->foto;
        // foto = tamu_id_tgl_detik;
        /*
        "_token" => "153FTkKPokUhdO4VUfsThi5t53zn0tbM121ck801"
        "tamu_id" => "2"
        "edit_tamu" => "0"
        "jenis_identitas" => "2"
        "nomor_identitas" => "5272031903820005"
        "nama_lengkap" => "I Putu Dyatmika"
        "tgl_lahir" => "1982-03-19"
        "telepon" => "081237802900"
        "email" => "pdyatmika@gmail.com"
        "pekerjaan_detil" => "BPS Provinsi NTB"
        "alamat" => "Jl. Gunung Rinjani No. 2"
        "keperluan" => "eradfda"
        "tujuan_kedatangan" => "0" 0 = kantor, 1=pst
        "fasilitas_utama" => null
        */

        //dd($waktu_hari_ini,$request->all());

        if ($request->tamu_id==NULL) {
            $qrcode = Generate::Kode(6);
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
            $data->kode_qr = $qrcode;
            $data->save();
            $id_tamu = $data->id;
            $waktu_hari_ini = date('Ymd_His');
            if (preg_match('/^data:image\/(\w+);base64,/', $request->foto)) {
                $namafile_kunjungan = '/img/kunjungan/tamu_'.$id_tamu.'_'.$waktu_hari_ini.'.png';
                $namafile_profil = '/img/profil/tamu_profil_'.$id_tamu.'.png';
                $data_foto = substr($request->foto, strpos($request->foto, ',') + 1);
                $data_foto = base64_decode($data_foto);
                Storage::disk('public')->put($namafile_kunjungan, $data_foto);
                Storage::disk('public')->put($namafile_profil, $data_foto);
                //update link foto
                $data->tamu_foto = $namafile_profil;
                $data->update();
                //batas update
            }
            else
            {
                $namafile_kunjungan=NULL;
                $namafile_profil=NULL;
            }
            //buat qrcode img nya langsung
            $qrcode_foto = QrCode::format('png')
            ->size(500)->margin(1)->errorCorrection('H')
             ->generate($qrcode);
            $output_file = '/img/qrcode/'.$qrcode.'-'.$data->id.'.png';
            //$data_foto = base64_decode($qrcode_foto);
            Storage::disk('public')->put($output_file, $qrcode_foto);
            $pesan_error = 'Data pengunjung '.trim($request->nama_lengkap).' berhasil ditambahkan';
            $warna_error = 'info';
        }
        else {
            //ini kalo sudah ada datanya
            //tanpa pegawai baru
            $waktu_hari_ini = date('Ymd_His');
            if (preg_match('/^data:image\/(\w+);base64,/', $request->foto)) {
                $namafile_kunjungan = '/img/kunjungan/tamu_'.$request->tamu_id.'_'.$waktu_hari_ini.'.png';
                $namafile_profil = '/img/profil/tamu_profil_'.$request->tamu_id.'.png';
                $data_foto = substr($request->foto, strpos($request->foto, ',') + 1);
                $data_foto = base64_decode($data_foto);
                Storage::disk('public')->put($namafile_kunjungan, $data_foto);
                Storage::disk('public')->put($namafile_profil, $data_foto);
            }
            else
            {
                $namafile_kunjungan=NULL;
                $namafile_profil=NULL;
            }
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
                if ($namafile_profil != NULL)
                {
                    $data->tamu_foto = $namafile_profil;
                }
                $data->update();
                $pesan_error = 'Data pengunjung '.trim($request->nama_lengkap).' berhasil ditambahkan dan Diperbarui';
                $warna_error = 'success';
            }
            else {
                //data tamu tidak Diperbarui
                //perbarui foto profil dengan foto terbaru saja
                $data = Mtamu::where('id','=',$request->tamu_id)->first();
                if ($namafile_profil != NULL)
                {
                    $data->tamu_foto = $namafile_profil;
                }
                $data->update();
                //batasannya
                $pesan_error = 'Data pengunjung berhasil ditambahkan';
                $warna_error = 'info';
            }
            $id_tamu = $request->tamu_id;
        }
        //$dataTamu = Mtamu::where('nomor_identitas','=',$request->nomor_identitas)->first();


        if ($request->tujuan_kedatangan==0) {
            $is_pst=0;
            $f_id = 0;
        }
        else {
            $is_pst=$request->tujuan_kedatangan;
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
            $dataKunjungan->file_foto = $namafile_kunjungan;
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
            Session::flash('message_header', "<strong>Terimakasih</strong>");
            $pesan_error="Data Pengunjung <strong><i>".trim($request->nama_lengkap)."</i></strong> berhasil ditambahkan";
            $warna_error="success";
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

        if ($request->tamu_id==NULL) {
            $qrcode = Generate::Kode(6);
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
            $data->kode_qr = $qrcode;
            $data->save();
            $id_tamu = $data->id;
            $namafile_kunjungan=NULL;
            $namafile_profil=NULL;
            //buat qrcode img nya langsung
            $qrcode_foto = QrCode::format('png')
            ->size(500)->margin(1)->errorCorrection('H')
             ->generate($qrcode);
            $output_file = '/img/qrcode/'.$qrcode.'-'.$data->id.'.png';
            //$data_foto = base64_decode($qrcode_foto);
            Storage::disk('public')->put($output_file, $qrcode_foto);
            $pesan_error = 'Data pengunjung '.trim($request->nama_lengkap).' berhasil ditambahkan';
            $warna_error = 'info';
        }
        else {
            //ini kalo sudah ada datanya
            //tanpa pegawai baru
            $namafile_kunjungan=NULL;
            $namafile_profil=NULL;
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
            $id_tamu = $request->tamu_id;
        }
        //$dataTamu = Mtamu::where('nomor_identitas','=',$request->nomor_identitas)->first();


        if ($request->tujuan_kedatangan==0) {
            $is_pst=0;
            $f_id = 0;
        }
        else {
            $is_pst=$request->tujuan_kedatangan;
            $f_id = $request->fasilitas_utama;
        }
        //cek dulu apakah hari ini juga sudah mengisi
        //kalo sudah ada tidak bisa mengisi dua kali bukutamu
        $data = Mtamu::where('id','=',$id_tamu)->first();
        $cek_kunjungan = Kunjungan::where([['tamu_id',$id_tamu],['tanggal',Carbon::parse($request->tgl_kunjungan)->format('Y-m-d')],['is_pst',$is_pst]])->count();
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
            $dataKunjungan->tanggal = Carbon::parse($request->tgl_kunjungan)->format('Y-m-d');
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
            $pesan_error = 'Data pengunjung <b>'.trim($request->nama_lengkap).'</b> tanggal kunjungan <b>'.$request->tgl_kunjungan.'</b> berhasil ditambahkan';
            $warna_error = 'success';
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
            $cek_feedback = Feedback::where('kunjungan_id',$request->id)->count();
            if ($cek_feedback > 0)
            {
                Feedback::where('kunjungan_id',$request->id)->delete();
            }
            $nama = $data->tamu->nama_lengkap;
            $namafile_kunjungan = $data->file_foto;
            $data->delete();
            Storage::disk('public')->delete($namafile_kunjungan);
            $arr = array(
                'status'=>true,
                'hasil'=>'Data kunjungan an. '.$nama.' berhasil dihapus'
            );
        }
        return Response()->json($arr);
    }
    public function UbahKunjungan(Request $request)
    {
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
                $usulan_is_pst = 0;
                $usulan_ispst_nama = 'Kantor';
                //hapus yg ada di pstlayanan dan pstmanfaat
                Pstlayanan::where('kunjungan_id',$request->id)->delete();
                Pstmanfaat::where('kunjungan_id',$request->id)->delete();
            }
            else
            {
                $usulan_is_pst = 1;
                $usulan_ispst_nama = 'PST';
                //tambahkan ke pstlayanan  dan pstmanfaat
                $pst_layanan = Mlayanan::whereIn('id',['1','2'])->get();
                $pst_manfaat = MKunjungan::whereIn('id',['32'])->get();
                $kunjungan_id = $request->id;
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
            $data->is_pst = $usulan_is_pst;
            $data->update();
            $nama = $data->tamu->nama_lengkap;
            $arr = array(
                'status'=>true,
                'hasil'=>'Data kunjungan an. '.$nama.' berhasil diubah ke '.$usulan_ispst_nama
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
    public function CLSpi()
    {
        $data_bulan = array(
            1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
        );
        $data_tahun = DB::table('kunjungan')
                    ->selectRaw('year(tanggal) as tahun')
                    ->groupBy('tahun')
                    ->orderBy('tahun','asc')
                      ->get();
        //dd($data_tahun);
        //filter
        if (request('tamu_pst')==NULL)
        {
            $tamu_filter = 9;
        }
        elseif (request('tamu_pst')==0)
        {
            $tamu_filter = 0;
        }
        else
        {
            $tamu_filter = request('tamu_pst');
        }
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
        if (request('bulan')==NULL)
        {
            $bulan_filter= (int) date('m');
        }
        elseif (request('bulan')==0)
        {
            $bulan_filter = NULL;
        }
        else
        {
            $bulan_filter = request('bulan');
        }
        //batas filter
        $Midentitas = Midentitas::orderBy('id','asc')->get();
        $Mpekerjaan = Mpekerjaan::orderBy('id','asc')->get();
        $Mjk = Mjk::orderBy('id','asc')->get();
        $Mpendidikan = Mpendidikan::orderBy('id','asc')->get();
        $Mkatpekerjaan = Mkatpekerjaan::orderBy('id','asc')->get();
        $Mwarga = Mwarga::orderBy('id','asc')->get();
        $MKunjungan = MKunjungan::orderBy('id','asc')->get();
        $Mlayanan = Mlayanan::orderBy('id','asc')->get();
        $Mtamu = Mtamu::orderBy('id','asc')->get();
        $Mfasilitas = Mfasilitas::orderBy('id','asc')->get();
        $Kunjungan = Kunjungan::with('tamu')->with('pLayanan')
                        ->when($bulan_filter,function ($query) use ($bulan_filter){
                            return $query->whereMonth('tanggal','=',$bulan_filter);
                        })
                        ->whereYear('tanggal','=',$tahun_filter)
                        ->where('is_pst','1')
                        ->orderBy('tanggal','desc')
                        ->get();
        //dd($Kunjungan);
        return view('spi.index',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mtamu' => $Mtamu, 'Kunjungan'=> $Kunjungan,'Mfasilitas'=>$Mfasilitas,'bulan'=>$bulan_filter,'tahun'=>$tahun_filter,'dataBulan'=>$data_bulan,'dataTahun'=>$data_tahun,'tamupst'=>$tamu_filter]);
    }
    public function ListSkd()
    {
        $data_bulan = array(
            1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
        );
        $data_tahun = DB::table('kunjungan')
                    ->selectRaw('year(tanggal) as tahun')
                    ->groupBy('tahun')
                    ->orderBy('tahun','asc')
                      ->get();
        //dd($data_tahun);
        //filter
        if (request('tamu_pst')==NULL)
        {
            $tamu_filter = 9;
        }
        elseif (request('tamu_pst')==0)
        {
            $tamu_filter = 0;
        }
        else
        {
            $tamu_filter = request('tamu_pst');
        }
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
        if (request('bulan')==NULL)
        {
            $bulan_filter= (int) date('m');
        }
        elseif (request('bulan')==0)
        {
            $bulan_filter = NULL;
        }
        else
        {
            $bulan_filter = request('bulan');
        }
        //batas filter
        $Midentitas = Midentitas::orderBy('id','asc')->get();
        $Mpekerjaan = Mpekerjaan::orderBy('id','asc')->get();
        $Mjk = Mjk::orderBy('id','asc')->get();
        $Mpendidikan = Mpendidikan::orderBy('id','asc')->get();
        $Mkatpekerjaan = Mkatpekerjaan::orderBy('id','asc')->get();
        $Mwarga = Mwarga::orderBy('id','asc')->get();
        $MKunjungan = MKunjungan::orderBy('id','asc')->get();
        $Mlayanan = Mlayanan::orderBy('id','asc')->get();
        $Mtamu = Mtamu::orderBy('id','asc')->get();
        $Mfasilitas = Mfasilitas::orderBy('id','asc')->get();
        $Kunjungan = Kunjungan::with('tamu')->with('pLayanan')
                        ->when($tamu_filter < 9,function ($query) use ($tamu_filter){
                            return $query->where('is_pst','=',$tamu_filter);
                        })
                        ->when($bulan_filter,function ($query) use ($bulan_filter){
                            return $query->whereMonth('tanggal','=',$bulan_filter);
                        })
                        ->whereYear('tanggal','=',$tahun_filter)
                        //->where('is_pst','1')
                        ->orderBy('tanggal','desc')
                        ->get();
        //dd($Kunjungan);
        return view('skd.index',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mtamu' => $Mtamu, 'Kunjungan'=> $Kunjungan,'Mfasilitas'=>$Mfasilitas,'bulan'=>$bulan_filter,'tahun'=>$tahun_filter,'dataBulan'=>$data_bulan,'dataTahun'=>$data_tahun,'tamupst'=>$tamu_filter]);
    }
    public function KunjunganBaru()
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
        return view('kunjungan.baru',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mfasilitas'=>$Mfasilitas]);
    }
    public function NewKunjungan()
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
        return view('kunjungan.new',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mfasilitas'=>$Mfasilitas]);
    }
    public function KunjunganLama()
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
        return view('kunjungan.lama',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mfasilitas'=>$Mfasilitas]);
    }
    public function ScanQrcode()
    {
        return view('kunjungan.under');
    }
}
