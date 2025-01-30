<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Mjk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Feedback;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Generate;
use QrCode;
use App\User;
use App\MasterLevel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\DaftarMember;
use App\Mail\ResetPasswd;
use App\Mail\KirimAntrian;
use App\MTanggal;
use PDF;
use App\MasterLayananPST;
use App\MasterTipeKunjungan;
use App\MasterTujuan;
use App\NewKunjungan;
use App\Pengunjung;
use App\MAkses;
use App\MasterPendidikan;
use App\Mtamu;
use App\Kunjungan;
use App\FlagAntrian;
use App\Mjkunjungan;
use Svg\Tag\Rect;

class NewBukutamuController extends Controller
{
    public function Kunjungan()
    {
        //cek tanggal dulu
        //apakah hari libur skrg
        $cek_hari = MTanggal::where('tanggal', Carbon::today()->format('Y-m-d'))->first();
        //dd($cek_hari);
        if ($cek_hari->jtgl == 1 or ENV('APP_CEK_LIBUR') == false) {
            //$ipakses = config('app.ip_akses');
            $data_ip = MAkses::where('ip', \Request::getClientIp(true))->count();
            if (Auth::user() or $data_ip > 0) {
                if (Auth::user()) {
                    //login sebagai pengunjung
                    //load mtamu
                    if (Auth::user()->level == 1 and Auth::user()->tamu_id != 0) {
                        $dataTamu = Mtamu::where('id', Auth::user()->tamu_id)->first();
                    } else {
                        $dataTamu = '';
                    }
                } else {
                    $dataTamu = '';
                }
                $Mjk = Mjk::orderBy('id', 'asc')->get();
                $MasterPendidikan = MasterPendidikan::orderBy('id', 'asc')->get();
                $MasterTujuan = MasterTujuan::orderBy('id', 'asc')->get();
                $MasterLayananPST = MasterLayananPST::orderBy('id', 'asc')->get();
            } else {
                return redirect()->route('depan');
            }
            return view('newbukutamu.kunjungan', ['Mjk' => $Mjk, 'MasterPendidikan' => $MasterPendidikan, 'dataTamu' => $dataTamu,
        'MasterLayananPST'=>$MasterLayananPST,'MasterTujuan'=>$MasterTujuan]);
        }
        else {
            return view('kunjungan.libur', ['tanggal' => $cek_hari]);
        }
    }
    public function FlagAntrianUpdate(Request $request)
    {
        $arr = array(
            'status'=>false,
            'message'=>'Data tidak tersedia'
        );
        if (Auth::user()->level > 5)
        {
            $data = NewKunjungan::where('kunjungan_uid',$request->kunjungan_uid)->first();
            if ($data)
            {
                $data->kunjungan_flag_antrian = $request->kunjungan_flag_antrian;
                if ($request->kunjungan_flag_antrian == 1)
                {
                    $jam_datang = null;
                    $jam_pulang = null;
                    $petugas_id = 0;
                    $petugas_username = null;
                    $loket_petugas = 0;
                }
                elseif ($request->kunjungan_flag_antrian == 2)
                {
                    $jam_datang = Carbon::parse($data->tanggal . ' 08:00:00')->format('Y-m-d H:i:s');
                    $jam_pulang = null;
                    $petugas_id = Auth::user()->id;
                    $petugas_username = Auth::user()->username;
                    $loket_petugas = 1;
                }
                else
                {
                    $jam_datang = Carbon::parse($data->tanggal . ' 08:00:00')->format('Y-m-d H:i:s');
                    $jam_pulang = Carbon::parse($data->tanggal . ' 10:00:00')->format('Y-m-d H:i:s');
                    $petugas_id = Auth::user()->id;
                    $petugas_username = Auth::user()->username;
                    $loket_petugas = 1;
                }
                $data->kunjungan_petugas_id = $petugas_id;
                $data->kunjungan_petugas_username = $petugas_username;
                $data->kunjungan_jam_datang = $jam_datang;
                $data->kunjungan_jam_pulang = $jam_pulang;
                $data->kunjungan_loket_petugas = $loket_petugas;
                $data->update();

                $arr = array(
                    'status'=>true,
                    'message'=>'Data kunjungan an. '.$data->Pengunjung->pengunjung_nama.' tanggal '.$data->kunjungan_tanggal.' telah berhasil di update'
                );
            }
            else
            {
                $arr = array(
                    'status'=>false,
                    'message'=>'Data kunjungan tidak tersedia'
                );
            }
        }
        else
        {
            $arr = array(
                'status'=>false,
                'message'=>'Anda tidak mempunyai hak akses'
            );
        }
        return Response()->json($arr);
    }
    public function HapusKunjungan(Request $request)
    {
        $arr = array(
            'status'=>false,
            'message'=>'Data tidak tersedia'
        );
        if (Auth::user()->level > 5)
        {
            $data = NewKunjungan::where('kunjungan_uid',$request->uid)->first();
            if ($data)
            {
                $nama = $data->Pengunjung->pengunjung_nama;
                $tanggal = $data->kunjungan_tanggal;
                $file = $data->kunjungan_foto;
                //hapus dulu kunjungan
                $data->delete();
                //cek dulu file fotonya ada tidak
                if (Storage::disk('public')->exists($file))
                {
                    Storage::disk('public')->delete($file);
                }
                $arr = array(
                    'status' => true,
                    'message' => 'Data kunjungan an. ' . $nama . ' tanggal '.$tanggal.' berhasil dihapus',
                    'data' => true,
                );
            }
            else
            {
                $arr = array(
                    'status'=>false,
                    'message'=>'Data kunjungan tidak tersedia'
                );
            }
        }
        return Response()->json($arr);
    }
    public function DataKunjungan()
    {
        //$data = NewKunjungan::orderBy('kunjungan_id','desc')->get();
        $MasterTujuan = MasterTujuan::orderBy('id', 'asc')->get();
        $MasterLayananPST = MasterLayananPST::orderBy('id', 'asc')->get();
        $MasterJenisKunjungan = Mjkunjungan::orderBy('id', 'asc')->get();
        $flag_antrian = FlagAntrian::get();
        return view('newbukutamu.list-data',['master_flag_antrian'=>$flag_antrian,'MasterTujuan'=>$MasterTujuan,'MasterLayananPST'=>$MasterLayananPST,'MasterJenisKunjungan'=>$MasterJenisKunjungan]);
    }
    public function MulaiLayanan(Request $request)
    {
        $arr = array(
            'status'=>false,
            'message'=>'Data tidak tersedia'
        );
        if (Auth::user()->level > 5)
        {
            //hanya operator / admin yg bisa klik ini
            $data = NewKunjungan::where([['kunjungan_uid', $request->uid], ['kunjungan_jam_datang', NULL]])->first();
            if ($data)
            {
                //cek dulu petugas ini lagi melayani tidak
                //kalo tidak melayani
                //cek loket petugas1 dan 2 pada tanggal itu flag_antrian kode 2 tidak
                $cek = NewKunjungan::where([['kunjungan_tanggal',Carbon::now()->format("Y-m-d")],['kunjungan_flag_antrian',2],['kunjungan_petugas_id',Auth::user()->id]])->first();
                if ($cek)
                {
                    //ada pengunjung ternyata
                    $arr = array(
                        'status' => false,
                        'message' => 'Masih ada pengunjung yang dilayani, silakan diselesaikan dulu'

                    );
                }
                else
                {
                   //cek apakah tujuan pst / tidak
                   //kalo pst cek loket
                   //selain itu langsung taruh loket sesuai kode tujuan
                   if ($data->kunjungan_tujuan == 2)
                    {
                        $cek_jumlah_loket = NewKunjungan::where([['kunjungan_tanggal',Carbon::now()->format("Y-m-d")],['kunjungan_flag_antrian',2],['kunjungan_tujuan',2]])->get();
                        if ($cek_jumlah_loket->count() == 2)
                        {
                            $arr = array(
                                'status' => false,
                                'message' => 'Semua loket petugas masih ada pengunjung dilayani, tunggu setelah selesai dilayani'

                            );
                        }
                        elseif ($cek_jumlah_loket->count() == 1)
                        {
                            //hanya ada 1 loket, cek loket mana yg dipakai
                            foreach ($cek_jumlah_loket as $item) {
                                $loket_aktif = $item->kunjungan_loket_petugas;
                            }
                            if ($loket_aktif == 1)
                            {
                                $loket_petugas = 2;
                            }
                            else
                            {
                                $loket_petugas = 1;
                            }
                        }
                        else
                        {
                            $loket_petugas = 1;
                        }
                    }
                    else
                        {
                            //langsung masukkan loket sesuai kode tujuan
                            $loket_petugas = $data->kunjungan_tujuan;
                        }

                    $data->kunjungan_petugas_id = Auth::user()->id;
                    $data->kunjungan_petugas_username = Auth::user()->username;
                    $data->kunjungan_jam_datang = \Carbon\Carbon::now();
                    $data->kunjungan_loket_petugas = $loket_petugas;
                    $data->kunjungan_flag_antrian = 2;
                    $data->update();
                    $arr = array(
                        'status' => true,
                        'message' => 'Data kunjungan an. ' . $data->Pengunjung->pengunjung_nama . ' berhasil mulai dilayani',
                        'data' => true
                        );
                }
            }
            else
            {
                $arr = array(
                    'status'=>false,
                    'message'=>'Kunjungan ini sudah dilayani'
                );
            }
        }
        return Response()->json($arr);
    }
    public function AkhirLayanan(Request $request)
    {
        $arr = array(
            'status'=>false,
            'message'=>'Data tidak tersedia'
        );
        $data = NewKunjungan::where([['kunjungan_uid', $request->uid], ['kunjungan_jam_pulang', NULL]])->first();
        if ($data) {
            $data->kunjungan_jam_pulang = \Carbon\Carbon::now();
            $data->kunjungan_flag_antrian = 3;
            $data->kunjungan_flag_feedback = 1;
            $data->update();
            //kirim email untuk isi feedback

            $arr = array(
                'status' => true,
                'message' => 'Data kunjungan an. ' . $data->Pengunjung->pengunjung_nama . ' berhasil diakhiri'
            );
        }
        return Response()->json($arr);
    }
    public function FeedbackSave(Request $request)
    {
        $arr = array(
            'status'=>false,
            'message'=>'Data tidak di simpan'
        );
        if ($request->feedback_nilai == "")
        {
            //balikin nilai masih kosong
            $arr = array(
                'status'=>false,
                'message'=>'Nilai rating belum diberikan, silakan ulangi lagi'
            );
        }
        else
        {
            $data = NewKunjungan::where('kunjungan_uid',$request->kunjungan_uid)->first();
            if ($data)
            {
                $data->kunjungan_flag_feedback = 2;
                $data->kunjungan_nilai_feedback = $request->feedback_nilai;
                $data->kunjungan_komentar_feedback = $request->feedback_komentar;
                $data->update();

                $arr = array(
                    'status'=>true,
                    'message'=>'Feedback an. '.$data->Pengunjung->pengunjung_nama.' sudah tersimpan',
                    'data'=>true
                );
            }
        }
        return Response()->json($arr);
    }
    public function TindakLanjutSave(Request $request)
    {
        $arr = array(
            'status'=>false,
            'message'=>'Data tidak di simpan'
        );
        if (Auth::user()->level > 5)
        {
            $data = NewKunjungan::where('kunjungan_uid',$request->kunjungan_uid)->first();
            if ($data)
            {
                $data->kunjungan_tindak_lanjut = $request->kunjungan_tindak_lanjut;
                $data->update();

                $arr = array(
                    'status'=>true,
                    'message'=>'Tindak lanjut untuk kunjungan an. '.$data->Pengunjung->pengunjung_nama.' sudah tersimpan',
                    'data'=>true
                );
            }
        }
        return Response()->json($arr);
    }
    public function TujuanBaruSave(Request $request)
    {
        $arr = array(
            'status'=>false,
            'message'=>'Data tidak di simpan'
        );
        if (Auth::user()->level > 5)
        {
            $data = NewKunjungan::where('kunjungan_uid',$request->kunjungan_uid)->first();
            if ($data)
            {
                if ($request->kunjungan_tujuan_baru == 2)
                {
                    $layanan_pst_baru = $request->kunjungan_layanan_pst_baru;
                }
                else
                {
                    $layanan_pst_baru = 0;
                }
                $data->kunjungan_tujuan = $request->kunjungan_tujuan_baru;
                $data->kunjungan_pst = $layanan_pst_baru;
                $data->update();

                $arr = array(
                    'status'=>true,
                    'message'=>'Tujuan untuk kunjungan an. '.$data->Pengunjung->pengunjung_nama.' sudah diperbarui',
                    'data'=>true
                );
            }
        }
        return Response()->json($arr);
    }
    public function JenisKunjunganSave(Request $request)
    {
        $arr = array(
            'status'=>false,
            'message'=>'Data tidak di simpan'
        );
        if (Auth::user()->level > 5)
        {
            $data = NewKunjungan::where('kunjungan_uid',$request->kunjungan_uid)->first();
            if ($data)
            {
                if ($request->kunjungan_jenis == 1)
                {
                    //perorangan
                    if ($data->Pengunjung->pengunjung_jk == 1)
                    {
                        $jumlah_orang = 1;
                        $jumlah_pria = 1;
                        $jumlah_wanita = 0;
                    }
                    else
                    {
                        $jumlah_orang = 1;
                        $jumlah_pria = 0;
                        $jumlah_wanita = 1;
                    }
                }
                else
                {
                    $jumlah_orang = $request->jumlah_orang;
                    $jumlah_pria = $request->jumlah_pria;
                    $jumlah_wanita = $request->jumlah_wanita;
                }
                $data->kunjungan_jenis = $request->kunjungan_jenis;
                $data->kunjungan_jumlah_orang = $jumlah_orang;
                $data->kunjungan_jumlah_pria = $jumlah_pria;
                $data->kunjungan_jumlah_wanita = $jumlah_wanita;
                $data->update();

                $arr = array(
                    'status'=>true,
                    'message'=>'Jenis kunjungan an. '.$data->Pengunjung->pengunjung_nama.' sudah diperbarui',
                    'data'=>true
                );
            }
        }
        return Response()->json($arr);
    }
    public function PageListKunjungan(Request $request)
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
        $totalRecords = NewKunjungan::count();
        //total record searching
        $totalRecordswithFilter =  DB::table('m_new_kunjungan')
        ->leftJoin('m_pengunjung', 'm_new_kunjungan.pengunjung_uid', '=', 'm_pengunjung.pengunjung_uid')
        ->leftJoin('mjk', 'm_pengunjung.pengunjung_jk', '=', 'mjk.id')
        ->leftJoin('m_tujuan', 'm_new_kunjungan.kunjungan_tujuan', '=', 'm_tujuan.kode')
        ->leftJoin('users', 'm_new_kunjungan.kunjungan_petugas_id', '=', 'users.id')
        ->leftJoin('mjkunjungan', 'm_new_kunjungan.kunjungan_jenis', '=', 'mjkunjungan.id')
        ->leftJoin('m_layanan_pst', 'm_new_kunjungan.kunjungan_pst', '=', 'm_layanan_pst.kode')
        ->leftJoin('mf_antrian', 'm_new_kunjungan.kunjungan_flag_antrian', '=', 'mf_antrian.kode')
        ->leftJoin('m_pendidikan', 'm_pengunjung.pengunjung_pendidikan', '=', 'm_pendidikan.kode')
        ->when($searchValue, function ($q) use ($searchValue) {
            return $q->where('pengunjung_nama', 'like', '%' . $searchValue . '%')
                     ->orWhere('kunjungan_keperluan', 'like', '%' . $searchValue . '%')
                     ->orWhere('kunjungan_tanggal', 'like', '%' . $searchValue . '%')
                     ->orWhere('users.name', 'like', '%' . $searchValue . '%')
                     ->orWhere('mf_antrian.nama', 'like', '%' . $searchValue . '%')
                     ->orWhere('m_layanan_pst.nama', 'like', '%' . $searchValue . '%')
                     ->orWhere('mjkunjungan.nama', 'like', '%' . $searchValue . '%')
                     ->orWhere('kunjungan_teks_antrian', 'like', '%' . $searchValue . '%');
        })->count();

        // Fetch records
        $records = DB::table('m_new_kunjungan')
            ->leftJoin('m_pengunjung', 'm_new_kunjungan.pengunjung_uid', '=', 'm_pengunjung.pengunjung_uid')
            ->leftJoin('mjk', 'm_pengunjung.pengunjung_jk', '=', 'mjk.id')
            ->leftJoin('m_tujuan', 'm_new_kunjungan.kunjungan_tujuan', '=', 'm_tujuan.kode')
            ->leftJoin('users', 'm_new_kunjungan.kunjungan_petugas_id', '=', 'users.id')
            ->leftJoin('mjkunjungan', 'm_new_kunjungan.kunjungan_jenis', '=', 'mjkunjungan.id')
            ->leftJoin('m_layanan_pst', 'm_new_kunjungan.kunjungan_pst', '=', 'm_layanan_pst.kode')
            ->leftJoin('mf_antrian', 'm_new_kunjungan.kunjungan_flag_antrian', '=', 'mf_antrian.kode')
            ->leftJoin('m_pendidikan', 'm_pengunjung.pengunjung_pendidikan', '=', 'm_pendidikan.kode')
            ->when($searchValue, function ($q) use ($searchValue) {
                return $q->where('pengunjung_nama', 'like', '%' . $searchValue . '%')
                         ->orWhere('kunjungan_keperluan', 'like', '%' . $searchValue . '%')
                         ->orWhere('kunjungan_tanggal', 'like', '%' . $searchValue . '%')
                         ->orWhere('users.name', 'like', '%' . $searchValue . '%')
                         ->orWhere('mf_antrian.nama', 'like', '%' . $searchValue . '%')
                         ->orWhere('m_layanan_pst.nama', 'like', '%' . $searchValue . '%')
                         ->orWhere('mjkunjungan.nama', 'like', '%' . $searchValue . '%')
                         ->orWhere('kunjungan_teks_antrian', 'like', '%' . $searchValue . '%');
            })
            ->select('m_new_kunjungan.*', 'm_pengunjung.pengunjung_nama','m_pengunjung.pengunjung_email', 'm_pengunjung.pengunjung_jk', 'mjk.inisial as jk_inisial', 'mjk.nama as jk_nama', 'm_tujuan.inisial as tujuan_inisial', 'm_tujuan.nama as tujuan_nama', 'users.name', 'users.username', 'mjkunjungan.nama as jenis_nama', 'm_layanan_pst.nama as kunjungan_pst_teks', 'm_pendidikan.nama as pendidikan_nama','mf_antrian.nama as flag_antrian_teks')
            ->skip($start)
            ->take($rowperpage)
            ->orderBy($columnName, $columnSortOrder)
            ->get();

        //inisiasi aawal
        $data_arr = array();

        //list data
        foreach ($records as $item) {

            $aksi = '
            <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti-settings"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#" data-uid="' . $item->kunjungan_uid . '" data-toggle="modal" data-target="#ViewKunjunganModal">View</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="'.route("tamu.printantrian",$item->kunjungan_id).'" target="_blank" data-toggle="tooltip" title="Print Nomor Antrian">Print Antrian</a>
                    <a class="dropdown-item kirimnomorantrian" href="#" data-id="' . $item->kunjungan_id . '" data-nama="' . $item->pengunjung_nama . '" data-email="' . $item->pengunjung_email.'" data-toggle="tooltip" title="Kirim Nomor Antrian">Kirim Antrian</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-id="' . $item->kunjungan_id . '" data-uid="' . $item->kunjungan_uid . '" data-nama="' . $item->pengunjung_nama . '" data-toggle="modal" data-target="#EditTindakLanjutModal"><span data-toggle="tooltip" title="Edit tindak lanjut kunjungan an. '.$item->pengunjung_nama.'">Edit Tindak Lanjut</span></a>
                <a class="dropdown-item" href="#" data-uid="' . $item->pengunjung_uid . '" data-toggle="modal" data-target="#EditModal"><span data-toggle="tooltip" title="Edit Kunjungan an. '.$item->pengunjung_nama.'">Edit Kunjungan</span></a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#EditTujuanModal" data-id="' . $item->kunjungan_id . '" data-uid="' . $item->kunjungan_uid . '" data-nama="' . $item->pengunjung_nama . '">Ubah Tujuan</a>
                <a class="dropdown-item" href="#" data-id="' . $item->kunjungan_id . '" data-uid="' . $item->kunjungan_uid . '" data-jenis="'.$item->kunjungan_jenis.'" data-nama="' . $item->pengunjung_nama . '" data-toggle="modal" data-target="#EditJenisKunjunganModal">Ubah Jenis</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-id="' . $item->kunjungan_id . '" data-uid="' . $item->kunjungan_uid . '" data-nama="' . $item->pengunjung_nama . '" data-toggle="modal" data-target="#EditFlagAntrianModal">Flag Antrian</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item hapuskunjungan" href="#" data-id="' . $item->kunjungan_id . '" data-uid="' . $item->kunjungan_uid . '" data-nama="' . $item->pengunjung_nama . '" data-tanggal="'.$item->kunjungan_tanggal.'">Delete</a>

            </div>
        </div>
        ';
            if ($item->kunjungan_tujuan == 2)
            {
                //ke pst ambil layanan pst
                $tujuan = $item->kunjungan_pst_teks;

                if ($item->kunjungan_pst == 1)
                {
                    $warna_layanan_utama = 'badge-success';
                }
                else if ($item->kunjungan_pst == 2)
                {
                    $warna_layanan_utama = 'badge-warning';
                }
                else if ($item->kunjungan_pst == 3)
                {
                    $warna_layanan_utama = 'badge-info';
                }
                else if ($item->kunjungan_pst == 4)
                {
                    $warna_layanan_utama = 'badge-primary';
                }
                else
                {
                    $warna_layanan_utama = 'badge-primary';
                }
            }
            else
            {
                //nama layanan aja
                $tujuan = $item->tujuan_nama;
                if ($item->kunjungan_tujuan == 1)
                {
                    $warna_layanan_utama = 'badge-danger';
                }
                else if ($item->kunjungan_tujuan == 2)
                {
                    $warna_layanan_utama = 'badge-success';
                }
                else if ($item->kunjungan_tujuan == 3)
                {
                    $warna_layanan_utama = 'badge-warning';
                }
                else if ($item->kunjungan_tujuan == 4)
                {
                    $warna_layanan_utama = 'badge-info';
                }
                else
                {
                    $warna_layanan_utama = 'badge-primary';
                }
            }
            //edit tampilang warna2
            //warna layanan utama
            $layanan_utama = '<span class="badge '.$warna_layanan_utama.' badge-pill">'.$tujuan.'</span>';
            //warna flag antrian
            if ($item->kunjungan_flag_antrian == 1)
            {
                $warna_flag_antrian = 'badge-danger';
                $tombol_feedback='';
            }
            else if ($item->kunjungan_flag_antrian == 2)
            {
                $warna_flag_antrian = 'badge-warning';
                $tombol_feedback='';
            }
            else
            {
                $warna_flag_antrian = 'badge-success';
                if ($item->kunjungan_flag_feedback == 2)
                {
                    if ($item->kunjungan_komentar_feedback == "")
                    {
                        $warna_komentar_feedback = 'btn-info';
                    }
                    else
                    {
                        $warna_komentar_feedback = 'btn-success';
                    }
                    $tombol_feedback = '<button type="button" class="btn btn-rounded '.$warna_komentar_feedback.' btn-xs m-t-5" data-id="' . $item->kunjungan_id . '" data-uid="' . $item->kunjungan_uid . '" data-nama="' . $item->pengunjung_nama . '" data-tanggal="' . $item->kunjungan_tanggal . '" data-toggle="modal" data-target="#ViewFeedbackModal"><span data-toggle="tooltip" data-placement="top" title="Sudah memberikan feedback"><i class="fas fa-check-circle"></i> feedback</span></button>';
                }
                else
                {
                    $tombol_feedback = '<button type="button" class="btn btn-rounded btn-danger btn-xs tombolfeedback m-t-5" data-id="' . $item->kunjungan_id . '" data-uid="' . $item->kunjungan_uid . '" data-nama="' . $item->pengunjung_nama . '" data-tanggal="' . $item->kunjungan_tanggal . '" data-toggle="modal" data-target="#BeriFeebackModal"><span data-toggle="tooltip" data-placement="top" title="Belum memberikan feedback"><i class="fas fa-question"></i> feedback</span></button>';
                }

            }
            $flag_antrian_teks = '<span class="badge '.$warna_flag_antrian.' badge-pill">'.$item->flag_antrian_teks.'</span>';
            //batas flag antrian
            //waktu datang dan waktu pulang
            if ($item->kunjungan_jam_datang == "") {
                $mulai = '<button type="button" class="btn btn-circle btn-success btn-sm mulailayanan" data-toggle="tooltip" data-placement="top" title="Mulai memberikan layanan" data-id="' . $item->kunjungan_id . '" data-uid="' . $item->kunjungan_uid . '" data-nama="' . $item->pengunjung_nama . '" data-tanggal="' . $item->kunjungan_tanggal . '"><i class="fas fa-hand-holding-heart"></i></button>';
            }
            else {
                $mulai = '<span class="badge badge-info badge-pill">' . Carbon::parse($item->kunjungan_jam_datang)->format('H:i') . '</span>';
            }
            if ($item->kunjungan_jam_pulang == "") {
                if ($item->kunjungan_jam_datang != "") {
                    $akhir = '<button type="button" class="btn btn-circle btn-danger btn-sm akhirlayanan" data-toggle="tooltip" data-placement="top" title="Mengakhiri pemberian layanan" data-id="' . $item->kunjungan_id . '" data-uid="' . $item->kunjungan_uid . '" data-nama="' . $item->pengunjung_nama . '" data-tanggal="' . $item->kunjungan_tanggal . '"><i class="fas fa-sign-out-alt"></i></button>';
                } else {
                    $akhir = '';
                }
            } else {
                $akhir = '<span class="badge badge-success badge-pill">' . Carbon::parse($item->kunjungan_jam_pulang)->format('H:i') . '</span>';
            }
            //petugas
            if ($item->kunjungan_petugas_id != 0) {
                if ($item->kunjungan_loket_petugas == 1)
                {
                    $loket_petugas = '<span class="badge badge-success badge-pill">Petugas '.$item->kunjungan_loket_petugas.'</span>';
                }
                else
                {
                    $loket_petugas = '<span class="badge badge-info badge-pill">Petugas '.$item->kunjungan_loket_petugas.'</span>';
                }
                $petugas = $item->name .'<br />'. $loket_petugas;
            }
            else {
                $petugas = '<span class="badge badge-danger badge-pill">belum ada</span';
            }
            //jenis kelamin
            if ($item->jk_inisial == 'L') {
                $jk = '<span class="badge badge-info badge-pill">' . $item->jk_inisial . '</span>';
            }
            else {
                $jk = '<span class="badge badge-danger badge-pill">' . $item->jk_inisial . '</span>';
            }
            //jenis kunjungan 1 perorangan 2 kelompok
            if ($item->kunjungan_jenis == 1) {
                $kunjungan_jenis = '<span class="badge badge-info badge-pill">' . $item->jenis_nama . '</span>';
            } else {
                $kunjungan_jenis = '<span class="badge badge-warning badge-pill">' . $item->jenis_nama . ' (' . $item->kunjungan_jumlah_orang . ' org)</span> <span class="badge badge-info badge-pill">L ' . $item->kunjungan_jumlah_pria . '</span> <span class="badge badge-danger badge-pill">P ' . $item->kunjungan_jumlah_wanita . '</span>';
            }
            //tujuan
            if ($item->kunjungan_tujuan == 1) {
                $warna_tujuan = 'badge-danger';
            }
            elseif ($item->kunjungan_tujuan == 2)
            {
                $warna_tujuan = 'badge-success';
            }
            elseif ($item->kunjungan_tujuan == 3)
            {
                $warna_tujuan = 'badge-warning';
            }
            elseif ($item->kunjungan_tujuan == 4)
            {
                $warna_tujuan = 'badge-info';
            }
            elseif ($item->kunjungan_tujuan == 5)
            {
                $warna_tujuan = 'badge-dark';
            }
            else {
                $warna_tujuan = 'badge-primary';
            }
            $tujuan = '<span class="badge '.$warna_tujuan.' badge-pill">' . $item->tujuan_inisial . '</span>';
            //batas
            $data_arr[] = array(
                "kunjungan_uid" => $item->kunjungan_uid,
                "pengunjung_nama" => $item->pengunjung_nama .'<br />'.$jk,
                "kunjungan_tanggal" => $item->kunjungan_tanggal,
                "kunjungan_keperluan" => $item->kunjungan_keperluan .'<br />'.$tujuan .' '.$kunjungan_jenis,
                "kunjungan_tindak_lanjut" => $item->kunjungan_tindak_lanjut,
                "kunjungan_tujuan" => $layanan_utama .'<p>'.$tombol_feedback.'</p>',
                "kunjungan_teks_antrian" => $item->kunjungan_teks_antrian,
                "kunjungan_flag_antrian" => $flag_antrian_teks,
                "kunjungan_jam_datang" => $mulai,
                "kunjungan_jam_pulang" => $akhir,
                "kunjungan_petugas_id" => $petugas,
                "aksi" => $aksi
            );
        }
        //batas list

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;

    }
    public function DataPengunjung()
    {
        //$data = Pengunjung::orderBy('pengunjung_id','desc')->get();
        return view('newbukutamu.list-pengunjung');
    }
    public function PengunjungPageList(Request $request)
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
        $totalRecords = Pengunjung::count();
        //total record searching
        $totalRecordswithFilter =  Pengunjung::where('pengunjung_nama', 'like', '%' . $searchValue . '%')->count();
        // Fetch records
        $records = DB::table('m_pengunjung')
            ->leftJoin('mjk', 'm_pengunjung.pengunjung_jk', '=', 'mjk.id')
            ->leftJoin('m_pendidikan', 'm_pengunjung.pengunjung_pendidikan', '=', 'm_pendidikan.kode')
            ->leftJoin('users', 'm_pengunjung.pengunjung_user_id', '=', 'users.id')
            ->when($searchValue, function ($q) use ($searchValue) {
                return $q->where('pengunjung_nama', 'like', '%' . $searchValue . '%')
                         ->orWhere('pengunjung_nomor_hp', 'like', '%' . $searchValue . '%')
                         ->orWhere('pengunjung_pekerjaan', 'like', '%' . $searchValue . '%')
                         ->orWhere('users.name', 'like', '%' . $searchValue . '%')
                         ->orWhere('m_pendidikan.nama', 'like', '%' . $searchValue . '%')
                         ->orWhere('pengunjung_email', 'like', '%' . $searchValue . '%');
            })
            ->select('m_pengunjung.*', 'm_pendidikan.nama as nama_pendidikan', 'mjk.inisial','mjk.nama as jk_nama', 'users.name', 'users.username')
            ->skip($start)
            ->take($rowperpage)
            ->orderBy($columnName, $columnSortOrder)
            ->get();

            $data_arr = array();

            foreach ($records as $item) {

                $aksi = '
                <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti-settings"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" data-uid="' . $item->pengunjung_uid . '" data-toggle="modal" data-target="#ViewPengunjungModal">View</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-uid="' . $item->pengunjung_uid . '" data-toggle="modal" data-target="#EditModal">Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item hapuspengunjung" href="#" data-id="' . $item->pengunjung_id . '" data-uid="' . $item->pengunjung_uid . '" data-nama="' . $item->pengunjung_nama . '">Delete</a>

                </div>
            </div>
            ';
                $data_arr[] = array(
                    "pengunjung_uid" => $item->pengunjung_uid,
                    "pengunjung_nama" => $item->pengunjung_nama,
                    "pengunjung_nomor_hp" => $item->pengunjung_nomor_hp,
                    "pengunjung_tahun_lahir" => $item->pengunjung_tahun_lahir .'<br />('.(Carbon::now()->format('Y')-$item->pengunjung_tahun_lahir).' tahun)',
                    "pengunjung_jk" => $item->inisial,
                    "pengunjung_pekerjaan" => $item->pengunjung_pekerjaan,
                    "pengunjung_pendidikan" => $item->nama_pendidikan,
                    "pengunjung_email" => $item->pengunjung_email,
                    "pengunjung_alamat" => $item->pengunjung_alamat,
                    "pengunjung_total_kunjungan" => $item->pengunjung_total_kunjungan,
                    "aksi" => $aksi
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
    public function Database()
    {
        //menu database
        $pengunjung_lama = Mtamu::count();
        $kunjungan_lama = Kunjungan::count();
        $pengunjung_baru = Pengunjung::count();
        $kunjungan_baru = NewKunjungan::count();
        return view('master.database',[
            'pengunjung_lama'=>$pengunjung_lama,
            'kunjungan_lama'=>$kunjungan_lama,
            'pengunjung_baru'=>$pengunjung_baru,
            'kunjungan_baru'=>$kunjungan_baru
        ]);
    }
    public function Sinkron()
    {
        if (Auth::user()->level == 20)
        {
            //ambil data pengunjung
            $pengunjung_lama = Mtamu::get();
            $kunjungan_lama = Kunjungan::get();

            //pengunjung
            $i=0;
            foreach ($pengunjung_lama as $item) {
                //cek dulu ada tidak
                $cek = Pengunjung::where('pengunjung_nomor_hp',$item->telepon)->count();
                if ($cek < 1)
                {
                    $data = new Pengunjung();
                    $data->pengunjung_uid = $item->kode_qr;
                    $data->pengunjung_nama = $item->nama_lengkap;
                    $data->pengunjung_nomor_hp = $item->telepon;
                    $data->pengunjung_tahun_lahir = Carbon::parse($item->tgl_lahir)->year;
                    $data->pengunjung_jk = $item->id_jk ;
                    $data->pengunjung_pekerjaan = $item->pekerjaan->nama .' '. $item->kerja_detil;
                    $data->pengunjung_pendidikan = $item->id_mdidik;
                    $data->pengunjung_email = $item->email;
                    $data->pengunjung_alamat = $item->alamat ;
                    $data->pengunjung_foto_profil = $item->tamu_foto;
                    $data->pengunjung_total_kunjungan = $item->total_kunjungan;
                    $data->pengunjung_user_id = $item->user_id;
                    $data->created_at = $item->created_at;
                    $data->updated_at = $item->updated_at;
                    $data->save();
                    $i++;
                }
            }
            //kunjungan
            $j=0;
            foreach ($kunjungan_lama as $item) {
               //cek dulu kode_qr tamu
               //kalo ada di Pengunjung gas input ke NewKunjungan
               //cek dulu kode_kunjungan = 2 artinya sudah di import
               $cek = Pengunjung::where('pengunjung_uid',$item->tamu->kode_qr)->first();
               if ($cek && $item->kode_kunjungan != 2)
               {
                if ($item->is_pst == 1)
                {
                    $tujuan_kunjungan = 2;
                }
                else
                {
                    //kantor
                    $tujuan_kunjungan = 1;
                }
                if ($item->f_feedback == 1)
                {
                    $flag_feedback = 1;
                    $nilai_feedback = 0;
                    $komentar_feedback = null;
                }
                else
                {
                    $flag_feedback = 2;
                    $nilai_feedback = $item->Feedback->feedback_nilai;
                    $komentar_feedback = $item->Feedback->feedback_komentar;
                }
                $data = new NewKunjungan();
                $data->pengunjung_uid = $item->tamu->kode_qr;
                $data->kunjungan_uid = Generate::Kode(7);
                $data->kunjungan_tanggal = $item->tanggal;
                $data->kunjungan_keperluan = $item->keperluan;
                $data->kunjungan_jenis = $item->jenis_kunjungan;
                $data->kunjungan_tujuan = $tujuan_kunjungan;
                $data->kunjungan_pst = $item->layanan_utama;
                $data->kunjungan_foto = $item->file_foto;
                $data->kunjungan_jumlah_orang = $item->jumlah_tamu;
                $data->kunjungan_jumlah_pria = $item->tamu_m;
                $data->kunjungan_jumlah_wanita = $item->tamu_f;
                $data->kunjungan_flag_feedback = $flag_feedback;
                $data->kunjungan_nilai_feedback = $nilai_feedback;
                $data->kunjungan_komentar_feedback = $komentar_feedback;
                $data->Kunjungan_nomor_antrian = $item->NomorAntrian->nomor_antrian;
                $data->Kunjungan_teks_antrian = $item->NomorAntrian->teks_antrian;
                $data->kunjungan_loket_petugas = $item->NomorAntrian->loket_petugas;
                $data->kunjungan_flag_antrian = $item->NomorAntrian->flag_antrian;
                $data->kunjungan_jam_datang = $item->jam_datang;
                $data->kunjungan_jam_pulang = $item->jam_pulang;
                $data->kunjungan_petugas_id = $item->petugas_id;
                $data->kunjungan_petugas_username = $item->petugas_username;
                $data->created_at = $item->created_at;
                $data->updated_at = $item->updated_at;
                $data->save();

                //update kode_kunjungan
                $item->kode_kunjungan = 2;
                $item->update();
                $j++;
               }
            }
            $pesan_error="data pengunjung sebanyak ".$i." dan kunjungan sebanyak ".$j." sudah di sinkronisasi";
            $pesan_warna="success";
        }
        else
        {
            $pesan_error="tidak mempunyai hak untuk sinkoronisasi";
            $pesan_warna="danger";
        }
        Session::flash('message', $pesan_error);
        Session::flash('message_type', $pesan_warna);
        return redirect()->route('master.database');
    }
    public function NewWebApi(Request $request)
    {
        /*
        //key=register
        model=hp
        model=pengunjung
        model=kunjungan
        id=xxx
        */
        $arr = array(
            'status'=>false,
            'message'=>'Data tidak tersedia'
        );
        if ($request->model == "hp")
        {
            //cari nomor hp
            $data = Pengunjung::with('Pendidikan','JenisKelamin','Kunjungan','Kunjungan.Tujuan','Kunjungan.JenisKunjungan','Kunjungan.LayananUtama','Kunjungan.FlagAntrian')->where('pengunjung_nomor_hp',$request->nomor)->first();
            if ($data)
            {
                $arr = array(
                    'status'=>true,
                    'message'=>'Data ditemukan',
                    'data'=>$data
                );

            }
        }

        if ($request->model == "pengunjung")
        {
            //pengunjung
            $data = Pengunjung::with('Pendidikan','JenisKelamin','Kunjungan','Kunjungan.Tujuan','Kunjungan.JenisKunjungan','Kunjungan.LayananUtama','Kunjungan.FlagAntrian')->where('pengunjung_uid',$request->uid)->first();
            if ($data)
            {
                $arr = array(
                    'status'=>true,
                    'message'=>'Data tersedia',
                    'data'=>$data
                );
            }
            else
            {
                $arr = array(
                    'status'=>false,
                    'message'=>'Data tidak tersedia',
                    'data'=>null
                );
            }

        }

        if ($request->model == "kunjungan")
        {
            //kunjungan
            $data = NewKunjungan::with('Pengunjung','Tujuan','JenisKunjungan','LayananUtama','FlagAntrian','Petugas','Pengunjung.JenisKelamin','Pengunjung.Pendidikan','Tujuan.Tipe')->where('kunjungan_uid',$request->uid)->first();
            if ($data)
            {
                $arr = array(
                    'status'=>true,
                    'message'=>'Data tersedia',
                    'data'=>$data
                );
            }
            else
            {
                $arr = array(
                    'status'=>false,
                    'message'=>'Data tidak tersedia',
                    'data'=>null
                );
            }

        }

        return Response()->json($arr);
    }
}
