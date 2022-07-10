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

class FeedbackController extends Controller
{
    //
    public function list()
    {
        //menu tambah
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
        $Midentitas = Midentitas::orderBy('id','asc')->get();
        $Mpekerjaan = Mpekerjaan::orderBy('id','asc')->get();
        $Mjk = Mjk::orderBy('id','asc')->get();
        $Mpendidikan = Mpendidikan::orderBy('id','asc')->get();
        $Mkatpekerjaan = Mkatpekerjaan::orderBy('id','asc')->get();
        $Mwarga = Mwarga::orderBy('id','asc')->get();
        $MKunjungan = MKunjungan::orderBy('id','asc')->get();
        $Mlayanan = Mlayanan::orderBy('id','asc')->get();
        $Mfasilitas = Mfasilitas::orderBy('id','asc')->get();
        //batas tambah
        $feed = Feedback::when($tahun_filter > 0,function ($query) use ($tahun_filter){
                    return $query->whereYear('feedback_tanggal','=',$tahun_filter);
                })->orderBy('feedback_tanggal','desc')->get();
        $nama_feed = Feedback::LeftJoin('kunjungan','kunjungan.id','=','feedback.kunjungan_id')
                    ->when($tahun_filter > 0,function ($query) use ($tahun_filter){
                        return $query->whereYear('feedback_tanggal','=',$tahun_filter);
                    })
                    ->orderBy('tanggal','desc')->paginate(30);
        return view('feedback.index',['Midentitas'=>$Midentitas, 'Mpekerjaan'=>$Mpekerjaan, 'Mjk'=>$Mjk, 'Mpendidikan' => $Mpendidikan, 'Mkatpekerjaan'=>$Mkatpekerjaan, 'Mwarga' => $Mwarga, 'MKunjungan' => $MKunjungan, 'Mlayanan' => $Mlayanan, 'Mfasilitas'=>$Mfasilitas,'dataFeedback'=>$feed,'dataNamaFeedback'=>$nama_feed,'dataTahun'=>$data_tahun,'tahun'=>$tahun_filter]);
    }
    public function Simpan(Request $request)
    {
        //dd($request->all());
        /*
        1. cek dulu kunjungan dan tamunya ada tidak
        2. cek dulu di tabel feedback apakah sudah pernah ngisi
        "_token" => "AH0NET0e3dn2ErzEXHPlUaJ9xzvsQmzVG7eVsHRE"
        "kunjungan_id" => "93"
         "tamu_id" => "2"
        "feedback_nilai" => "6"
        "imbalan_nilai" => "2"
        "pungli_nilai" => "2"
        "feedback_komentar" => null
        */
        $cek_kunjungan = Kunjungan::where('id',$request->kunjungan_id)->count();
        if ($cek_kunjungan > 0)
        {
            $dKunjungan = Kunjungan::where('id',$request->kunjungan_id)->first();
            $dKunjungan->f_feedback = '2';
            $dKunjungan->update();

            $data = new Feedback();
            $data->kunjungan_id = $request->kunjungan_id;
            $data->tamu_id = $request->tamu_id;
            //$data->feedback_tanggal = Carbon::today()->format('Y-m-d');
            $data->feedback_tanggal = $dKunjungan->tanggal;
            $data->feedback_nilai = $request->feedback_nilai;
            $data->imbalan_nilai = $request->imbalan_nilai;
            $data->pungli_nilai = $request->pungli_nilai;
            $data->feedback_komentar = $request->feedback_komentar;
            $data->save();


            Session::flash('message_header', "<strong>Terimakasih</strong>");
            $pesan_error="Sudah memberikan <strong><i>Feedback</i></strong> untuk layanan kami";
            $warna_error="success";
        }
        else
        {
            $pesan_error="Data kunjungan tidak tersedia";
            $warna_error="danger";
        }
        Session::flash('message', $pesan_error);
        Session::flash('message_type', $warna_error);
        return redirect()->back();
    }
}
