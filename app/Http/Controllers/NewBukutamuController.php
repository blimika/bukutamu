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

class NewBukutamuController extends Controller
{
    public function Kunjungan()
    {
        //cek tanggal dulu
        //apakah hari libur skrg
        $cek_hari = MTanggal::where('tanggal', Carbon::today()->format('Y-m-d'))->first();
        //dd($cek_hari);
        if ($cek_hari->jtgl == 1) {
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
        } else {
            return view('kunjungan.libur', ['tanggal' => $cek_hari]);
        }
    }
}
