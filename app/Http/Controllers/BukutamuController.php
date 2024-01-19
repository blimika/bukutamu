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
use App\FPTerjadwal;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Generate;
use App\LPTerjadwal;
use QrCode;
use App\MAkses;
use App\User;
use App\MasterLevel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\DaftarMember;
use App\Mail\ResetPasswd;
use App\MTanggal;
use App\MFKunjungan;
use App\Terjadwal;

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
    public function SimpanTerjadwal(Request $request)
    {
        /*
        array:29 [▼
        "_token" => "zjtqDIEqScR7yhLDJLBpeblcWJk8pV1AO9xOGBm1"
        "edit_tamu" => "1"
        "tamu_baru" => "1"
        "tgl_kunjungan" => "2024-01-12"
        "jenis_kunjungan" => "1"
        "jumlah_tamu" => "1"
        "tamu_laki" => "0"
        "tamu_wanita" => "0"
        "tamu_id" => "2"
        "jenis_identitas" => "2"
        "nomor_identitas" => "5272031903820005"
        "nama_lengkap" => "I Putu Dyatmika"
        "id_jk" => "1"
        "tgl_lahir" => "1982-03-19"
        "email" => "pdyatmika@gmail.com"
        "telepon" => "081237802900"
        "mwarga" => "1"
        "alamat" => "Jl. Dr. Soedjono No. 74"
        "id_mdidik" => "3"
        "id_kerja" => "3"
        "kat_kerja" => "3"
        "pekerjaan_detil" => "BPS Provinsi NTB"
        "tujuan_kedatangan" => "1"
        "id_manfaat" => "4"
        "manfaat_nama" => "Penelitian"
        "pst_layanan" => array:3 [▼
            0 => "1"
            1 => "2"
            2 => "16"
        ]
        "pst_fasilitas" => array:3 [▼
            0 => "2"
            1 => "4"
            2 => "8"
        ]
        "fas_lainnya" => null
        "keperluan" => "testing"
        ]
        */
        //dd($request->all());
        //cek dulu data penanggung jawab apa ada
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
            $data->total_kunjungan = 0;
            $data->save();
            $id_tamu = $data->id;


            //buat qrcode img nya langsung
            $qrcode_foto = QrCode::format('png')
            ->size(500)->margin(1)->errorCorrection('H')
             ->generate($qrcode);
            $output_file = '/img/qrcode/'.$qrcode.'-'.$data->id.'.png';
            //$data_foto = base64_decode($qrcode_foto);
            Storage::disk('public')->put($output_file, $qrcode_foto);
        }
        else
        {
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
            }
            $id_tamu = $request->tamu_id;
        }
        //cek tujuannya
        if ($request->tujuan_kedatangan==0) {
            $is_pst=0;
            $f_id = 0;
            $f_teks = NULL;
        }
        else {
            $is_pst=$request->tujuan_kedatangan;
            $f_id = $request->id_manfaat;
            $f_teks = $request->manfaat_nama;
        }
        //input ke tabel Terjadwal
        //cek dulu apakah hari ini juga sudah mengisi
        //kalo sudah ada tidak bisa mengisi dua kali bukutamu
        $data = Mtamu::where('id','=',$id_tamu)->first();
        $cek_kunjungan = Terjadwal::where([['tamu_id',$id_tamu],['tanggal',$request->tgl_kunjungan],['is_pst',$is_pst]])->count();
        if ($cek_kunjungan > 0 )
        {
            //sudah ada kasih info kalo sudah mengisi
            $pesan_error = 'Data pengunjung '.$data->nama_lengkap.' sudah pernah mengisi bukutamu hari tanggal '.Carbon::parse($request->tgl_kunjungan)->isoFormat('dddd, D MMMM Y');
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
            $kode_booking = Generate::Kode(6);
            $dataKunjungan = new Terjadwal();
            $dataKunjungan->tamu_id = $id_tamu;
            $dataKunjungan->kode_booking = $kode_booking;
            $dataKunjungan->tanggal = $request->tgl_kunjungan;
            $dataKunjungan->keperluan = $request->keperluan;
            $dataKunjungan->jenis_kunjungan = $request->jenis_kunjungan;
            $dataKunjungan->jumlah_tamu = $jumlah_tamu;
            $dataKunjungan->tamu_m = $laki;
            $dataKunjungan->tamu_f = $wanita;
            $dataKunjungan->is_pst = $is_pst;
            $dataKunjungan->f_id = $f_id;
            $dataKunjungan->f_teks = $f_teks;

            $dataKunjungan->save();
            if ($is_pst>0) {
                //isi tabel pst_layanan, pst_manfaat dan pst_fasilitas
                //$MLay = MLay::orderBy('id','asc')->get();
                //$pst_layanan = Mlayanan::whereIn('id',$request->pst_layanan)->get();
                $pst_layanan = MLay::whereIn('id',$request->pst_layanan)->get();
                $pst_fasilitas = MFas::whereIn('id',$request->pst_fasilitas)->get();
                $terjadwal_id = $dataKunjungan->id;
                foreach ($pst_layanan as $l)
                {
                    $dataLayanan = new LPTerjadwal();
                    $dataLayanan->terjadwal_id = $terjadwal_id;
                    $dataLayanan->l_p_id = $l->id;
                    $dataLayanan->l_p_nama = $l->nama;
                    $dataLayanan->save();
                }
                foreach ($pst_fasilitas as $fas)
                {
                    $dataFasilitas = new FPTerjadwal();
                    $dataFasilitas->terjadwal_id = $terjadwal_id;
                    $dataFasilitas->f_p_id = $fas->id;
                    $dataFasilitas->f_p_nama = $fas->nama;
                    $dataFasilitas->save();
                }
            }
            Session::flash('message_header', "<strong>Terimakasih</strong>");
            $pesan_error="Data Pengunjung <strong><i>".trim($request->nama_lengkap)."</i></strong> berhasil ditambahkan";
            $warna_error="success";
        }
        Session::flash('message', $pesan_error);
        Session::flash('message_type', $warna_error);
        return redirect()->route('depan');
        //batas
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
            $data->total_kunjungan = 0;
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
            //cek kunjungan
            $cek_kunjungan = Kunjungan::where('tamu_id',$dataCek->id)->count();
            $arr_kunjungan = array('hasil'=>'Data Kunjungan Kosong','status'=>false);
            if ($cek_kunjungan > 0)
            {
                //ada kunjungan
                $dataKunjungan = Kunjungan::with('tamu','pLayanan','pManfaat')->where('tamu_id',$dataCek->id)->orderBy('created_at','desc')->take(10)->get();
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
                            'jenis_kunjungan'=>$item->jenis_kunjungan,
                            'jumlah_tamu'=>$item->jumlah_tamu,
                            'tamu_m'=>$item->tamu_m,
                            'tamu_f'=>$item->tamu_m,
                            'flag_edit_tamu'=>$item->flag_edit_tamu,
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
            //batas kunjungan
            //cek member/users
            $arr_member = array('hasil'=>'Data member tidak tersedia','status'=>false);
            if ($dataCek->member)
            {
                //member terkoneksi
                $arr_member = array(
                    'hasil' => array(
                        'id'=> $dataCek->member->id,
                        'name' => $dataCek->member->name,
                        'username' => $dataCek->member->username,
                        'level' => $dataCek->member->level,
                        'level_nama' => $dataCek->member->mLevel->nama,
                        'lastlogin' => $dataCek->member->lastlogin,
                        'lastip' => $dataCek->member->lastip,
                        'user_foto' => $dataCek->member->user_foto,
                        'tamu_id' => $dataCek->member->tamu_id,
                        'created_at'=>$dataCek->member->created_at,
                        'created_at_nama'=>Carbon::parse($dataCek->member->created_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                        'updated_at'=>$dataCek->member->updated_at,
                        'updated_at_nama'=>Carbon::parse($dataCek->member->updated_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                        'email_verified_at'=>$dataCek->member->email_verified_at,
                        'email_verified_at_nama'=>Carbon::parse($dataCek->member->email_verified_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                        'akun_verified_at'=>$dataCek->member->akun_verified_at,
                        'akun_verified_at_nama'=>Carbon::parse($dataCek->member->akun_verified_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                    ),
                    'status'=>true
                );
            }
            //batas member
            $arr = array(
                'hasil' => array(
                    /*
                    'tamu_id'=>$dataCek->id,
                    'nama_lengkap'=>$dataCek->nama_lengkap,
                    'kode_qr'=>$dataCek->kode_qr,
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
                    */
                    'tamu_id'=>$dataCek->id,
                    'id_identitas'=>$dataCek->id_midentitas,
                    'id_identitas_nama'=>$dataCek->identitas->nama,
                    'nomor_identitas'=>$dataCek->nomor_identitas,
                    'nama_lengkap'=>$dataCek->nama_lengkap,
                    'tgl_lahir'=>$dataCek->tgl_lahir,
                    'tgl_lahir_nama'=>Carbon::parse($dataCek->tgl_lahir)->isoFormat('D MMMM Y'),
                    'umur'=>Carbon::parse($dataCek->tgl_lahir)->age,
                    'id_jk'=>$dataCek->id_jk,
                    'nama_jk'=>$dataCek->jk->nama,
                    'inisial_jk'=>$dataCek->jk->inisial,
                    'id_kerja'=>$dataCek->id_mkerja,
                    'nama_kerja'=>$dataCek->pekerjaan->nama,
                    'kat_kerja'=>$dataCek->id_mkat_kerja,
                    'kat_kerja_nama'=>$dataCek->kategoripekerjaan->nama,
                    'kerja_detil'=>$dataCek->kerja_detil,
                    'pekerjaan_detil'=>$dataCek->kerja_detil,
                    'id_mdidik'=>$dataCek->id_mdidik,
                    'nama_mdidik'=>$dataCek->pendidikan->nama ,
                    'id_mwarga'=>$dataCek->id_mwarga,
                    'mwarga'=>$dataCek->id_mwarga,
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
                    'user_id'=>$dataCek->user_id,
                    'kunjungan'=>$arr_kunjungan,
                    'member'=>$arr_member
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
        //cek tanggal dulu
        //apakah hari libur skrg
        $cek_hari = MTanggal::where('tanggal',Carbon::today()->format('Y-m-d'))->first();
        //dd($cek_hari);
        if ($cek_hari->jtgl == 1)
        {
            //$ipakses = config('app.ip_akses');
            $data_ip = MAkses::where('ip',\Request::getClientIp(true))->count();
            if (Auth::user() or $data_ip > 0)
            {
                if (Auth::user())
                {
                    //login sebagai pengunjung
                    //load mtamu
                    if (Auth::user()->level == 1 and Auth::user()->tamu_id != 0)
                    {
                        $dataTamu = Mtamu::where('id',Auth::user()->tamu_id)->first();
                    }
                    else
                    {
                        $dataTamu ='';
                    }
                }
                else
                {
                    $dataTamu ='';
                }
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
            return view('kunjungan.new',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'Mlayanan' => $MLay, 'Mfasilitas'=>$MFas,'MManfaat'=>$MManfaat,'dataTamu'=>$dataTamu]);
        }
        else
        {
            return view('kunjungan.libur',['tanggal'=>$cek_hari]);
        }

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
        if ($data_tamu)
        {
            $Kunjungan = Kunjungan::with('tamu')
                        ->where('tamu_id',$data_tamu->id)
                        ->orderBy('tanggal','asc')->get();
        }
        else
        {
            $Kunjungan ="";
        }
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
        $data = User::where('username',trim($request->username))->orWhere('email',trim($request->email))->orWhere('telepon',trim($request->telepon))->first();
        $arr = array(
            'status'=>false,
            'hasil'=>'Username ('.trim($request->username).'), E-Mail ('.trim($request->email).') atau Nomor HP ('.trim($request->telepon).') sudah digunakan'
        );
        if (!$data)
        {
            //$email_kodever = Str::random(10);
            //simpan data member
            $data = new User();
            $data->level = 1;
            $data->name = trim($request->name);
            $data->username = trim($request->username);
            $data->email = trim($request->email);
            $data->email_ganti = trim($request->email);
            $data->telepon = trim($request->telepon);
            $data->password = bcrypt($request->passwd);
            $data->email_kodever = Str::random(10);
            $data->flag = 0;
            $data->tamu_id = 0;
            $data->save();
            //kirim mail
            $body = new \stdClass();
            $body->nama_lengkap = $data->name;
            $body->username = $data->username;
            $body->email = $data->email_ganti;
            $body->telepon = $data->telepon;
            $body->email_kodever = $data->email_kodever;
            $body->tanggal_buat = Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y H:mm:ss');
            $body->link_aktivasi = route('member.aktivasi',[$body->username,$body->email_kodever]);
            //batas
            $arr = array(
                'status'=>true,
                'hasil'=>'Data member an. '.$request->name.' ('.$request->username.') berhasil ditambahkan, silakan check email untuk aktivasi'
            );
            if (ENV('APP_KIRIM_MAIL') == true)
            {
                Mail::to($data->email)->queue(new DaftarMember($body));
            }
        }
        #dd($request->all());
        return Response()->json($arr);
    }
    public function LupaPasswd(Request $request)
    {
        $data = User::where('email',trim($request->email))->first();
        $arr = array(
            'status'=>false,
            'hasil'=>'Username tidak ditemukan'
        );
        if ($data)
        {
            $passwd_baru = Str::random(10);
            //simpan data member
            $data->password = bcrypt($passwd_baru);
            $data->update();
            //kirim mail
            $body = new \stdClass();
            $body->nama_lengkap = $data->name;
            $body->username = $data->username;
            $body->passwd_baru = $passwd_baru;
            $body->tanggal_minta = Carbon::parse(NOW())->isoFormat('dddd, D MMMM Y H:mm:ss');
            if (ENV('APP_KIRIM_MAIL') == true)
            {
                Mail::to($data->email)->send(new ResetPasswd($body));
            }
            //batas
            $arr = array(
                'status'=>true,
                'hasil'=>'Password member an. '.$data->name.' ('.$data->username.') berhasil direset, silakan check email'
            );
        }
        #dd($request->all());
        return Response()->json($arr);
    }
    public function MailAktivasi($user,$kode,$email)
    {
        $data = User::where([['username',$user],['email_kodever',$kode],['email_ganti',$email]])->first();
        if ($data)
        {
            //user belum aktivasi
            $data->email = $email;
            $data->email_kodever = 0;
            $data->email_verified_at = Carbon::parse(NOW())->format('Y-m-d H:i:s');
            $data->update();
            $pesan_error = 'Email baru berhasil di aktivasi';
            $warna_error = 'success';
        }
        else
        {
            //user tidak ditemukan atau sudah teraktivasi
            $pesan_error = 'user tidak ditemukan/user sudah teraktivasi';
            $warna_error = 'danger';

        }
        Session::flash('message', $pesan_error);
        Session::flash('message_type', $warna_error);
        return view('users.mailaktivasi');
    }
    public function MemberAktivasi($user,$kode)
    {
        $data = User::where([['username',$user],['email_kodever',$kode],['flag','0']])->first();
        if ($data)
        {
            //user belum aktivasi
            //akun_verified_at
            $data->flag = 1;
            $data->email_kodever = 0;
            $data->email_verified_at = Carbon::parse(NOW())->format('Y-m-d H:i:s');
            $data->akun_verified_at = Carbon::parse(NOW())->format('Y-m-d H:i:s');
            $data->update();
            $pesan_error = 'user berhasil di aktivasi';
            $warna_error = 'success';
        }
        else
        {
            //user tidak ditemukan atau sudah teraktivasi
            $pesan_error = 'user tidak ditemukan/user sudah teraktivasi';
            $warna_error = 'danger';

        }
        Session::flash('message', $pesan_error);
        Session::flash('message_type', $warna_error);
        return view('users.aktivasi');
    }
    public function ListTamu()
    {
        return view('tamu.index');
    }
    public function PageListTamu(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Kunjungan::count();
        $totalRecordswithFilter =  DB::table('kunjungan')->
        leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')->where('nama_lengkap', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = DB::table('kunjungan')
        ->leftJoin('mtamu','kunjungan.tamu_id','=','mtamu.id')
        ->leftJoin('mjk','mtamu.id_jk','=','mjk.id')
        ->leftJoin('mtujuan','kunjungan.is_pst','=','mtujuan.kode')
        ->leftJoin('users','kunjungan.petugas_id','=','users.id')
        ->leftJoin('mjkunjungan','kunjungan.jenis_kunjungan','=','mjkunjungan.id')
        ->where('nama_lengkap', 'like', '%' .$searchValue . '%')
        ->select('kunjungan.*','mtamu.nama_lengkap','mtamu.kode_qr','mtamu.id_jk','mjk.inisial','mtujuan.nama_pendek','mtujuan.nama as tujuan_nama','users.name','users.username','mjkunjungan.nama as jkunjungan_nama')
        ->skip($start)
        ->take($rowperpage)
        ->orderBy('tanggal','desc')
        ->orderBy($columnName,$columnSortOrder)
        ->get();

        $data_arr = array();
        $sno = $start+1;
        foreach($records as $record){
            $id = $record->id;
            $nama_lengkap = '<a href="#" class="text-info" data-kodeqr="'.$record->kode_qr.'" data-toggle="modal" data-target="#ViewModal">'.$record->nama_lengkap.'</a>';
            $keperluan = $record->keperluan;
            $tanggal = $record->tanggal;

            if ($record->jam_datang == "")
            {
                $mulai = '<button type="button" class="btn btn-circle btn-success btn-sm mulailayanan" data-toggle="tooltip" data-placement="top" title="Mulai memberikan layanan" data-id="'.$record->id.'" data-nama="'.$record->nama_lengkap.'" data-tanggal="'.$record->tanggal.'"><i class="fas fa-hand-holding-heart"></i></button>';
            }
            else
            {
                $mulai = '<span class="badge badge-info badge-pill">'.Carbon::parse($record->jam_datang)->format('H:i:s').'</span>';
            }
            if ($record->jam_pulang == "")
            {
                if ($record->jam_datang != "")
                {
                    $akhir = '<button type="button" class="btn btn-circle btn-danger btn-sm akhirlayanan" data-toggle="tooltip" data-placement="top" title="Mulai memberikan layanan" data-id="'.$record->id.'" data-nama="'.$record->nama_lengkap.'" data-tanggal="'.$record->tanggal.'"><i class="fas fa-sign-out-alt"></i></button>';
                }
                else
                {
                    $akhir = '';
                }

            }
            else
            {
                $akhir = '<span class="badge badge-warning badge-pill">'.Carbon::parse($record->jam_pulang)->format('H:i:s').'</span>';
            }
            //photo
            if ($record->file_foto != NULL)
            {
                if (Storage::disk('public')->exists($record->file_foto))
                {
                    $photo = '<a class="image-popup" href="'.asset('storage/'.$record->file_foto).'" title="Nama : '.$record->nama_lengkap.'">
                <img src="'.asset('storage/'.$record->file_foto).'" class="img-circle" width="60" height="60" class="img-responsive" />
            </a>';
                }
                else
                {
                    $photo = '<a class="image-popup" href="https://via.placeholder.com/480x360/0022FF/FFFFFF/?text=photo+tidak+ada" title="Nama : '.$record->nama_lengkap.'">
                    <img src="https://via.placeholder.com/480x360/0022FF/FFFFFF/?text=photo+tidak+ada" alt="image"  class="img-circle" width="60" height="60" />
                    </a>';
                }
            }
            else
            {
                $photo = '<a class="image-popup" href="https://via.placeholder.com/480x360/0022FF/FFFFFF/?text=photo+tidak+ada" title="Nama : '.$record->nama_lengkap.'">
                <img src="https://via.placeholder.com/480x360/0022FF/FFFFFF/?text=photo+tidak+ada" alt="image"  class="img-circle" width="60" height="60" />
                </a>';
            }
            //batas photo
            if ($record->petugas_id != 0)
            {
                $petugas = $record->name;
            }
            else
            {
                $petugas = '<span class="badge badge-danger badge-pill">belum ada</span';
            }
            if ($record->inisial=='L')
            {
                $jk = '<span class="badge badge-info badge-pill">'.$record->inisial.'</span>';
            }
            else
            {
                $jk = '<span class="badge badge-danger badge-pill">'.$record->inisial.'</span>';
            }

            if ($record->is_pst == 0)
            {
                $tujuan = '<span class="badge badge-danger badge-pill">'.$record->nama_pendek.'</span>';
            }
            else
            {
                $tujuan = '<span class="badge badge-success badge-pill">'.$record->nama_pendek.'</span>';
            }

            if ($record->jenis_kunjungan == 1)
            {
                $jkunjungan = '<span class="badge badge-info badge-pill">'.$record->jkunjungan_nama.'</span>';
            }
            else
            {
                $jkunjungan = '<span class="badge badge-warning badge-pill">'.$record->jkunjungan_nama.' ('.$record->jumlah_tamu.' org)</span> <span class="badge badge-info badge-pill">L '.$record->tamu_m.'</span> <span class="badge badge-danger badge-pill">P '.$record->tamu_f.'</span>';
            }

            $aksi ='
                <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti-settings"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" data-kodeqr="'.$record->kode_qr.'" data-toggle="modal" data-target="#ViewModal">View</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item hapuskunjungantamu" href="#" data-id="'.$record->id.'" data-nama="'.$record->nama_lengkap.'" data-tanggal="'.$record->tanggal.'" data-toggle="tooltip" title="Hapus Kunjungan ini">Hapus Kunjungan</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item hapuspengunjungmaster" href="#" data-id="'.$record->tamu_id.'" data-nama="'.$record->nama_lengkap.'">Hapus Pengunjung</a>

                </div>
            </div>
            ';
            $data_arr[] = array(
                "id" => $id,
                "photo"=>$photo,
                "nama_lengkap"=>$nama_lengkap.'<br />'.$jk,
                "keperluan"=>$keperluan.'<br />'.$tujuan.' '.$jkunjungan,
                "tanggal"=>$tanggal,
                "jam_datang"=>$mulai,
                "jam_pulang"=>$akhir,
                "petugas_id"=>$petugas,
                "aksi"=>$aksi
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }
    public function MulaiLayanan(Request $request)
    {
        $data = Kunjungan::where([['id',$request->id],['jam_datang',NULL]])->first();
        $arr = array('hasil' => 'Data tidak tersedia', 'status' => false);
        if ($data) {
            $data->petugas_id = Auth::user()->id;
            $data->petugas_username = Auth::user()->username;
            $data->jam_datang = \Carbon\Carbon::now();
            $data->update();
            $arr = array(
                 'hasil'=> 'Data kunjungan an. '.$data->tamu->nama_lengkap.' berhasil dimulai',
                 'status'=> true
            );
        }
        return Response()->json($arr);
    }
    public function AkhirLayanan(Request $request)
    {
        $data = Kunjungan::where([['id',$request->id],['jam_pulang',NULL]])->first();
        $arr = array('hasil' => 'Data tidak tersedia', 'status' => false);
        if ($data) {
            $kode_feedback = Generate::Kode(7);
            $data->jam_pulang = \Carbon\Carbon::now();
            $data->kode_feedback = $kode_feedback;
            $data->update();
            $arr = array(
                 'hasil'=> 'Data kunjungan an. '.$data->tamu->nama_lengkap.' berhasil dikahiri',
                 'status'=> true
            );
        }
        return Response()->json($arr);
    }
    public function PermintaanData()
    {
        return view('permintaandata.index');
    }
    public function ListTamuTerjadwal()
    {
        $data = Terjadwal::get();
        return view('terjadwal.index',[
            'data'=>$data,
        ]);
    }
    public function PageListTamuTerjadwal(Request $request)
    {

    }
    public function KonfirmasiKunjungan()
    {

    }
}
