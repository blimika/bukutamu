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
use App\MFas;
use App\MManfaat;
use App\MLay;
use App\PstFasilitas;
use App\Mjkunjungan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Feedback;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Generate;
use QrCode;
use App\MAkses;

class BukutamuController extends Controller
{
    //
    public function depan()
    {
        //filter
        $data_bulan = array(
            1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
        );
        $data_bulan_pendek = array(
            1=>'JAN','FEB','MAR','APR','MEI','JUN','JUL','AGU','SEP','OKT','NOV','DES'
        );
        $data_tahun = DB::table('kunjungan')
                    ->selectRaw('year(tanggal) as tahun')
                    ->groupBy('tahun')
                    ->orderBy('tahun','asc')
                      ->get();
        if (request('tahun')==NULL)
        {
            $tahun_filter=date('Y');
        }
        else
        {
           $tahun_filter = request('tahun');
        }
        if (request('bulan')==NULL)
        {
            $bulan_filter = NULL;
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
        $Mfasilitas = Mfasilitas::orderBy('id','asc')->get();
        $Mjkunjungan = Mjkunjungan::orderBy('id','asc')->get();
        //$Kunjungan = Kunjungan::with('tamu')->whereDate('tanggal', Carbon::today())->orderBy('id','desc')->get();
        $Mtamu = Mtamu::orderBy('id','asc')->get();
        $Kunjungan = Kunjungan::with('tamu')
                        ->when($bulan_filter == NULL,function ($query){
                            return $query->whereDate('tanggal', Carbon::today());
                        })
                        ->when($bulan_filter > 0,function ($query) use ($bulan_filter,$tahun_filter){
                            return $query->whereMonth('tanggal',$bulan_filter)->whereYear('tanggal',$tahun_filter);
                        })
                        ->orderBy('created_at','desc')->get();
        //dd($data_tahun);
        if ($bulan_filter == NULL)
        {
            $bulan_filter= (int) date('m');
        }
        //grafik

        //batas grafik
        return view('new-depan',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mtamu' => $Mtamu, 'Mjkunjungan'=>$Mjkunjungan,'Kunjungan'=> $Kunjungan,'Mfasilitas'=>$Mfasilitas,'dataTahun'=>$data_tahun,'tahun'=>$tahun_filter,'dataBulan'=>$data_bulan,'dataBulanPendek'=>$data_bulan_pendek,'bulan'=>$bulan_filter]);
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

        if (request('jns_kunjungan')==NULL or request('jns_kunjungan')==0)
        {
            $kunjungan_filter=0;
        }
        else
        {
            $kunjungan_filter=request('jns_kunjungan');
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
        $Mjkunjungan = Mjkunjungan::orderBy('id','asc')->get();
        $Kunjungan = Kunjungan::with('tamu')
                        ->when($tamu_filter < 9,function ($query) use ($tamu_filter){
                            return $query->where('is_pst','=',$tamu_filter);
                        })
                        ->when($bulan_filter,function ($query) use ($bulan_filter){
                            return $query->whereMonth('tanggal',$bulan_filter);
                        })
                        ->when($kunjungan_filter > 0,function ($query) use ($kunjungan_filter){
                            return $query->where('jenis_kunjungan',$kunjungan_filter);
                        })
                        ->whereYear('tanggal','=',$tahun_filter)
                        ->orderBy('tanggal','desc')->get();
        //dd($tamu_filter);
        //dd($Kunjungan);
        return view('lama.list',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mtamu' => $Mtamu, 'Kunjungan'=> $Kunjungan,'Mfasilitas'=>$Mfasilitas,'bulan'=>$bulan_filter,'tahun'=>$tahun_filter,'dataBulan'=>$data_bulan,'dataTahun'=>$data_tahun,'tamupst'=>$tamu_filter,'Mjkunjungan'=>$Mjkunjungan,'jns_kunjungan'=>$kunjungan_filter]);
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
        array:19 [▼
            "_token" => "5AZQLUSLhVUnfmE5yANm1tC1e5wYjategBrBFylS"
            "tamu_id" => "2"
            "edit_tamu" => "0"
            "tamu_baru" => "0"
            "jenis_identitas" => "2"
            "nomor_identitas" => "5272031903820005"
            "nama_lengkap" => "I Putu Dyatmika"
            "tgl_lahir" => "1982-03-19"
            "email" => "pdyatmika@gmail.com"
            "telepon" => "081237802900"
            "alamat" => "Jl. Gunung Rinjani No. 2"
            "pekerjaan_detil" => "BPS Provinsi NTB"
            "foto" => null
            "tujuan_kedatangan" => "1"
            "id_manfaat" => "1"
            "manfaat_nama" => "Tugas Sekolah/Tugas Kuliah"
            "pst_layanan" => array:4 [▶]
            "pst_fasilitas" => array:2 [▶]
            "keperluan" => "adfa fsf sfafafsa"
            ]
            jenis_kunjungan" => "2"
            "jumlah_tamu" => "3"
            "tamu_laki" => "0"
            "tamu_wanita" => "3"
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
            $data->total_kunjungan = 1;
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
            $f_id = $request->id_manfaat;
            //$f_id = 0;
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
            //cek jenis kunjungan
            //perorangan atau kelompok
            //perorangan skip aja pakai jk dari tamu_id
            //kelompok isikan sesuai jumlah
            /*
            jenis_kunjungan" => "2"
            "jumlah_tamu" => "3"
            "tamu_laki" => "0"
            "tamu_wanita" => "3"
            */
            if ($request->jenis_kunjungan == 2) {
                $jumlah_tamu = $request->jumlah_tamu;
                $laki = $request-> tamu_laki;
                $wanita = $request->tamu_wanita;
            }
            else
            {
                $jumlah_tamu = 1;
                //cek jenis kelamin ambil dari query data diatas
                if ($data->id_jk == 1)
                {
                    $laki=1;
                    $wanita=0;
                }
                else
                {
                    $laki=0;
                    $wanita=1;
                }
            }
            $dataKunjungan = new Kunjungan();
            $dataKunjungan->tamu_id = $id_tamu;
            $dataKunjungan->tanggal = Carbon::today()->format('Y-m-d');
            $dataKunjungan->keperluan = $request->keperluan;
            $dataKunjungan->jenis_kunjungan = $request->jenis_kunjungan;
            $dataKunjungan->jumlah_tamu = $jumlah_tamu;
            $dataKunjungan->tamu_m = $laki;
            $dataKunjungan->tamu_f = $wanita;
            $dataKunjungan->is_pst = $is_pst;
            $dataKunjungan->f_id = $f_id;
            $dataKunjungan->file_foto = $namafile_kunjungan;
            $dataKunjungan->flag_edit_tamu = 1; //flag_tidak bisa di sync
            $dataKunjungan->save();
            //tambah counter total_kunjungan
            $total_kunjungan = $data->total_kunjungan;
            $data->total_kunjungan = $total_kunjungan+1;
            $data->update();
            //batas
            if ($is_pst>0) {
                //isi tabel pst_layanan, pst_manfaat dan pst_fasilitas
                //$MLay = MLay::orderBy('id','asc')->get();
                //$pst_layanan = Mlayanan::whereIn('id',$request->pst_layanan)->get();
                $pst_layanan = MLay::whereIn('id',$request->pst_layanan)->get();
                $pst_fasilitas = MFas::whereIn('id',$request->pst_fasilitas)->get();
                $kunjungan_id = $dataKunjungan->id;
                foreach ($pst_layanan as $l)
                {
                    $dataLayanan = new Pstlayanan();
                    $dataLayanan->kunjungan_id = $kunjungan_id;
                    $dataLayanan->layanan_id = $l->id;
                    $dataLayanan->layanan_nama = $l->nama;
                    $dataLayanan->layanan_nama_new = $l->nama;
                    $dataLayanan->save();
                }
                foreach ($pst_fasilitas as $fas)
                {
                    $dataFasilitas = new PstFasilitas();
                    $dataFasilitas->kunjungan_id = $kunjungan_id;
                    $dataFasilitas->fasilitas_id = $fas->id;
                    $dataFasilitas->fasilitas_nama = $fas->nama;
                    $dataFasilitas->save();
                }
                $dataManfaat = new Pstmanfaat();
                $dataManfaat->kunjungan_id = $kunjungan_id;
                $dataManfaat->manfaat_id = $request->id_manfaat;
                $dataManfaat->manfaat_nama = $request->manfaat_nama;
                $dataManfaat->manfaat_nama_new = $request->manfaat_nama;
                $dataManfaat->save();

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
                /* kode lama
                $pst_layanan = Mlayanan::whereIn('id',$request->pst_layanan)->get();
                $pst_manfaat = MKunjungan::whereIn('id',$request->pst_manfaat)->get();
                $kunjungan_id = $dataKunjungan->id;
                foreach ($pst_layanan as $l)
                {
                    $dataLayanan = new Pstlayanan();
                    $dataLayanan->kunjungan_id = $kunjungan_id;
                    $dataLayanan->layanan_id = $l->id;
                    $dataLayanan->layanan_nama = $l->nama;
                    $dataLayanan->layanan_nama_new = $l->nama;
                    $dataLayanan->save();
                }
                foreach ($pst_manfaat as $m)
                {
                    $dataManfaat = new Pstmanfaat();
                    $dataManfaat->kunjungan_id = $kunjungan_id;
                    $dataManfaat->manfaat_id = $m->id;
                    $dataManfaat->manfaat_nama = $m->nama;
                    $dataManfaat->manfaat_nama_new = $m->nama;
                    $dataManfaat->save();
                }
                */
                $pst_layanan = MLay::whereIn('id',$request->pst_layanan)->get();
                $pst_fasilitas = MFas::whereIn('id',$request->pst_fasilitas)->get();
                $kunjungan_id = $dataKunjungan->id;
                foreach ($pst_layanan as $l)
                {
                    $dataLayanan = new Pstlayanan();
                    $dataLayanan->kunjungan_id = $kunjungan_id;
                    $dataLayanan->layanan_id = $l->id;
                    $dataLayanan->layanan_nama = $l->nama;
                    $dataLayanan->layanan_nama_new = $l->nama;
                    $dataLayanan->save();
                }
                foreach ($pst_fasilitas as $fas)
                {
                    $dataFasilitas = new PstFasilitas();
                    $dataFasilitas->kunjungan_id = $kunjungan_id;
                    $dataFasilitas->fasilitas_id = $fas->id;
                    $dataFasilitas->fasilitas_nama = $fas->nama;
                    $dataFasilitas->save();
                }
                $dataManfaat = new Pstmanfaat();
                $dataManfaat->kunjungan_id = $kunjungan_id;
                $dataManfaat->manfaat_id = $request->id_manfaat;
                $dataManfaat->manfaat_nama = $request->manfaat_nama;
                $dataManfaat->manfaat_nama_new = $request->manfaat_nama;
                $dataManfaat->save();

            }
            $pesan_error = 'Data pengunjung <b>'.trim($request->nama_lengkap).'</b> tanggal kunjungan <b>'.$request->tgl_kunjungan.'</b> berhasil ditambahkan';
            $warna_error = 'success';
        }
        Session::flash('message', $pesan_error);
        Session::flash('message_type', $warna_error);
        return redirect()->route('lama');
    }
    public function UpdateKunjungan(Request $request)
    {
        /*
        array:6 [▼
        "_token" => "MPyUnD3up3FVIa4PvOYD05a5gZadI0H011tZt2fw"
        "kunjungan_id" => "1180"
        "tamu_id" => "1004"
        "jumlah_tamu" => "2"
        "tamu_laki" => "1"
        "tamu_wanita" => "1"
        ]
        */
        //dd($request->all());

        $cek_kunjungan = Kunjungan::where('id',$request->kunjungan_id)->count();
        if ($cek_kunjungan > 0)
        {
            //ada kunjungan update
            $data = Kunjungan::where('id',$request->kunjungan_id)->first();
            $data->jumlah_tamu = $request->jumlah_tamu;
            $data->tamu_m = $request->tamu_laki;
            $data->tamu_f = $request->tamu_wanita;
            $data->flag_edit_tamu = 1;
            $data->update();
            $pesan_error = 'Data kunjungan an. <strong>'.$data->tamu->nama_lengkap .'</strong> sudah di update';
            $warna_error = 'success';
        }
        else
        {
            //data kunjungan tidak ada
            $pesan_error = 'Data kunjungan tidak tersedia';
            $warna_error = 'danger';
        }
        Session::flash('message', $pesan_error);
        Session::flash('message_type', $warna_error);
        return redirect()->back();
    }
    public function editdata($id)
    {}
    public function updatedata(Request $request)
    {}
    public function hapus(Request $request)
    {
        //get dulu datanya
        //apabila is_pst = 1
        // hapus di tabel pst_layanan, pst_manfaat dan pst_fasilitas
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
                PstFasilitas::where('kunjungan_id',$request->id)->delete();
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
                $f_id = '0';
            }
            else
            {
                $usulan_is_pst = 1;
                $f_id = '5';
                $usulan_ispst_nama = 'PST';
                //tambahkan ke pstlayanan  dan pstmanfaat
                $pst_layanan = Mlayanan::whereIn('id',['1'])->get();
                $pst_manfaat = MManfaat::where('id',$f_id)->first();
                $kunjungan_id = $request->id;
                foreach ($pst_layanan as $l)
                {
                    $dataLayanan = new Pstlayanan();
                    $dataLayanan->kunjungan_id = $kunjungan_id;
                    $dataLayanan->layanan_id = $l->id;
                    $dataLayanan->layanan_nama = $l->nama;
                    $dataLayanan->save();
                }
                /*
                foreach ($pst_manfaat as $m)
                {
                    $dataManfaat = new Pstmanfaat();
                    $dataManfaat->kunjungan_id = $kunjungan_id;
                    $dataManfaat->manfaat_id = $m->id;
                    $dataManfaat->manfaat_nama = $m->nama;
                    $dataManfaat->save();
                }
                */
                $dataManfaat = new Pstmanfaat();
                $dataManfaat->kunjungan_id = $kunjungan_id;
                $dataManfaat->manfaat_id = $f_id;
                $dataManfaat->manfaat_nama = $pst_manfaat->nama;
                $dataManfaat->manfaat_nama_new = $pst_manfaat->nama;
                $dataManfaat->save();

            }
            $data->is_pst = $usulan_is_pst;
            $data->f_id = $f_id;
            $data->update();
            $nama = $data->tamu->nama_lengkap;
            $arr = array(
                'status'=>true,
                'hasil'=>'Data kunjungan an. '.$nama.' berhasil diubah ke '.$usulan_ispst_nama
            );
        }
        return Response()->json($arr);
    }
    public function UbahJenisKunjungan(Request $request)
    {

        $arr = array(
            'status'=>false,
            'hasil'=>'Data kunjungan tidak tersedia'
        );
        $cek_kunjungan = Kunjungan::where('id',$request->id)->count();
        if ($cek_kunjungan > 0)
        {
            //data kunjungan ada
            $data = Kunjungan::where('id',$request->id)->first();
            $id_jk = $data->tamu->id_jk;
            if ($id_jk == 1)
            {
                $tamu_laki = 1;
                $tamu_wanita = 0;
            }
            else
            {
                $tamu_laki = 0;
                $tamu_wanita = 1;
            }
            $data->jenis_kunjungan = $request->jnskunjungan_after;
            $data->jumlah_tamu= 1;
            $data->tamu_m = $tamu_laki;
            $data->tamu_f = $tamu_wanita;
            $data->update();
            $arr = array(
                'status'=>true,
                'hasil'=>'Data kunjungan an. '.$data->tamu->nama_lengkap.' berhasil diubah ke '.$data->jKunjungan->nama
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
        if (request('jns_kunjungan')==NULL or request('jns_kunjungan')==0)
        {
            $kunjungan_filter=0;
        }
        else
        {
            $kunjungan_filter=request('jns_kunjungan');
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
        $Mjkunjungan = Mjkunjungan::orderBy('id','asc')->get();
        $Kunjungan = Kunjungan::with('tamu')->with('pLayanan')
                        ->when($bulan_filter,function ($query) use ($bulan_filter){
                            return $query->whereMonth('tanggal','=',$bulan_filter);
                        })
                        ->whereYear('tanggal','=',$tahun_filter)
                        ->where('is_pst','1')
                        ->orderBy('tanggal','desc')
                        ->get();
        //dd($Kunjungan);
        return view('spi.index',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mtamu' => $Mtamu, 'Kunjungan'=> $Kunjungan,'Mfasilitas'=>$Mfasilitas,'bulan'=>$bulan_filter,'tahun'=>$tahun_filter,'dataBulan'=>$data_bulan,'dataTahun'=>$data_tahun,'tamupst'=>$tamu_filter,'Mjkunjungan'=>$Mjkunjungan,'jns_kunjungan'=>$kunjungan_filter]);
    }
    public function CLSpi23()
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
        if (request('jns_kunjungan')==NULL or request('jns_kunjungan')==0)
        {
            $kunjungan_filter=0;
        }
        else
        {
            $kunjungan_filter=request('jns_kunjungan');
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
        $MLay = MLay::orderBy('id','asc')->get();
        $Mtamu = Mtamu::orderBy('id','asc')->get();
        $Mfasilitas = Mfasilitas::orderBy('id','asc')->get();
        $Mjkunjungan = Mjkunjungan::orderBy('id','asc')->get();
        $Kunjungan = Kunjungan::with('tamu')->with('pLayanan')->with('pFasilitas')
                        ->when($bulan_filter,function ($query) use ($bulan_filter){
                            return $query->whereMonth('tanggal','=',$bulan_filter);
                        })
                        ->whereYear('tanggal','=',$tahun_filter)
                        ->where('is_pst','1')
                        ->orderBy('tanggal','desc')
                        ->get();
        //dd($Kunjungan);
        return view('spi23.index',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mtamu' => $Mtamu, 'Kunjungan'=> $Kunjungan,'Mfasilitas'=>$Mfasilitas,'bulan'=>$bulan_filter,'tahun'=>$tahun_filter,'dataBulan'=>$data_bulan,'dataTahun'=>$data_tahun,'tamupst'=>$tamu_filter,'Mjkunjungan'=>$Mjkunjungan,'jns_kunjungan'=>$kunjungan_filter,'mLayanan'=>$MLay]);
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

        if (request('jns_kunjungan')==NULL or request('jns_kunjungan')==0)
        {
            $kunjungan_filter=0;
        }
        else
        {
            $kunjungan_filter=request('jns_kunjungan');
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
        $Mjkunjungan = Mjkunjungan::orderBy('id','asc')->get();
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
        return view('skd.index',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mtamu' => $Mtamu,'Kunjungan'=> $Kunjungan,'Mfasilitas'=>$Mfasilitas,'bulan'=>$bulan_filter,'tahun'=>$tahun_filter,'dataBulan'=>$data_bulan,'dataTahun'=>$data_tahun,'tamupst'=>$tamu_filter,'Mjkunjungan'=>$Mjkunjungan,'jns_kunjungan'=>$kunjungan_filter]);
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
        //$ipakses = config('app.ip_akses');
        $data_ip = MAkses::where('ip',\Request::getClientIp(true))->count();
        if (Auth::user() or $data_ip > 0)
        {
            $Midentitas = Midentitas::orderBy('id','asc')->get();
            $Mpekerjaan = Mpekerjaan::orderBy('id','asc')->get();
            $Mjk = Mjk::orderBy('id','asc')->get();
            $Mpendidikan = Mpendidikan::orderBy('id','asc')->get();
            $Mkatpekerjaan = Mkatpekerjaan::orderBy('id','asc')->get();
            $Mwarga = Mwarga::orderBy('id','asc')->get();
            $MKunjungan = MKunjungan::orderBy('id','asc')->get();
            $Mfasilitas = Mfasilitas::orderBy('id','asc')->get();
            $MFas = MFas::orderBy('id','asc')->get();
            $MManfaat = MManfaat::orderBy('id','asc')->get();
            $MLay = MLay::orderBy('id','asc')->get();
        }
        else
        {
            return redirect()->route('depan');
        }
        return view('kunjungan.new',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'Mlayanan' => $MLay, 'Mfasilitas'=>$MFas,'MManfaat'=>$MManfaat]);
    }
    public function KunjunganTerjadwal()
    {
        if (Auth::user())
        {
            $Midentitas = Midentitas::orderBy('id','asc')->get();
            $Mpekerjaan = Mpekerjaan::orderBy('id','asc')->get();
            $Mjk = Mjk::orderBy('id','asc')->get();
            $Mpendidikan = Mpendidikan::orderBy('id','asc')->get();
            $Mkatpekerjaan = Mkatpekerjaan::orderBy('id','asc')->get();
            $Mwarga = Mwarga::orderBy('id','asc')->get();
            $MKunjungan = MKunjungan::orderBy('id','asc')->get();
            $Mfasilitas = Mfasilitas::orderBy('id','asc')->get();
            $MFas = MFas::orderBy('id','asc')->get();
            $MManfaat = MManfaat::orderBy('id','asc')->get();
            $MLay = MLay::orderBy('id','asc')->get();
        }
        else
        {
            return redirect()->route('depan');
        }
        return view('kunjungan.terjadwal',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'Mlayanan' => $MLay, 'Mfasilitas'=>$MFas,'MManfaat'=>$MManfaat]);
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
    public function DetilTamu($qrcode)
    {
        $MKunjungan = MKunjungan::orderBy('id','asc')->get();
        $Mjkunjungan = Mjkunjungan::orderBy('id','asc')->get();
        $data_tamu = Mtamu::where('kode_qr',$qrcode)->first();
        $Kunjungan = Kunjungan::with('tamu')
                        ->where('tamu_id',$data_tamu->id)
                        ->orderBy('tanggal','asc')->get();
        //dd($Kunjungan);
        return view('detil.tamu',[
            'dataTamu'=>$data_tamu,
            'dataKunjungan'=>$Kunjungan,
            'MKunjungan' => $MKunjungan,
            'Mjkunjungan'=>$Mjkunjungan
        ]);
    }
    public function Daftar()
    {
        return view('users.daftar');
    }
    public function MemberDaftar(Request $request)
    {

    }
    public function LupaPasswd(Request $request)
    {
        
    }
}
