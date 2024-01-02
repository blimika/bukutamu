<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Generate;
use QrCode;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\MTanggal;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\JTanggal;

class TanggalController extends Controller
{
    //
    public function MasterTanggal()
    {
        $data_jtanggal = JTanggal::get();
        return view('tanggal.index',['jtanggal'=>$data_jtanggal]);
    }
    public function CariTanggal($id)
    {
        $data = MTanggal::where('id',$id)->first();
        $arr = array(
            'status'=>false,
            'hasil'=>'Tanggal tidak ditemukan'
        );
        if ($data)
        {
            $arr_data = array(
                "id" => $data->id,
                "tanggal" => $data->tanggal,
                "hari" => $data->hari,
                "hari_num"=> (int) Carbon::parse($data->tanggal)->format('w'),
                "jtgl" => $data->jtgl,
                "jtgl_nama" => $data->jTanggal->nama,
                "deskripsi" => $data->deskripsi,
                "created_at" => $data->created_at,
                "created_at_nama"=>Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                "updated_at" =>$data->updated_at,
                "updated_at_nama"=>Carbon::parse($data->updated_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
            );
            $arr = array(
                'status'=>true,
                'hasil'=> $arr_data
            );
        }
        #dd($request->all());
        return Response()->json($arr);
    }
    public function CekTanggal($tgl)
    {
        $data = MTanggal::where('tanggal',$tgl)->first();
        $arr = array(
            'status'=>false,
            'hasil'=>'Tanggal tidak ditemukan'
        );
        if ($data)
        {
            $arr_data = array(
                "id" => $data->id,
                "tanggal" => $data->tanggal,
                "hari" => $data->hari,
                "hari_num"=> (int) Carbon::parse($data->tanggal)->format('w'),
                "jtgl" => $data->jtgl,
                "jtgl_nama" => $data->jTanggal->nama,
                "deskripsi" => $data->deskripsi,
                "created_at" => $data->created_at,
                "created_at_nama"=>Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                "updated_at" =>$data->updated_at,
                "updated_at_nama"=>Carbon::parse($data->updated_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
            );
            $arr = array(
                'status'=>true,
                'hasil'=> $arr_data
            );
        }
        #dd($request->all());
        return Response()->json($arr);
    }
    public function UpdateTanggal(Request $request)
    {
        $data = MTanggal::where('id',$request->id)->first();
        $arr = array(
            'status'=>false,
            'hasil'=>'Tanggal tidak ditemukan'
        );
        if ($data)
        {
            /*
             id: id,
                    jtgl: jtgl,
                    deskripsi: deskripsi,
                    hari_num: hari_num,
                    */
            if ($request->jtgl == 1)
            {
                $deskripsi = "";
            }
            else 
            {
                $deskripsi = trim($request->deskripsi);
            }
            $data->jtgl = $request->jtgl;
            $data->deskripsi = $deskripsi;
            $data->update();
            $arr = array(
                'status'=>true,
                'hasil'=>'Tanggal sudah di update'
            );
        }
        return Response()->json($arr);
    }
    public function PageListTanggal(Request $request)
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
        $totalRecords = MTanggal::select('count(*) as allcount')->count();
        $totalRecordswithFilter = MTanggal::select('count(*) as allcount')->where('tanggal', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = MTanggal::orderBy($columnName,$columnSortOrder)
            ->where('mtanggal.tanggal', 'like', '%' .$searchValue . '%')
            ->select('mtanggal.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start+1;
        foreach($records as $record){
            $id = $record->id;
            $tanggal = $record->tanggal;
            $hari = $record->hari;
            $jtanggal_id = $record->jTanggal->nama;
            $deskripsi = $record->deskripsi;
            if (Auth::user()->level == 20)
                {
                    $aksi ='
                    <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ti-settings"></i>
                    </button>
                    <div class="dropdown-menu">

                        <a class="dropdown-item" href="#" data-id="'.$record->id.'" data-tanggal="'.$record->tanggal.'" data-toggle="modal" data-target="#EditTanggal">Edit</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item hapusakses" href="#" data-id="'.$record->id.'" data-tanggal="'.$record->tanggal.'">Ubah Flag</a>
                    </div>
                    </div>
                    ';
                }
                else
                {
                    $aksi ='';
                }
            $data_arr[] = array(
                "id" => $id,
                "tanggal"=>$tanggal,
                "hari"=>$hari,
                "jtanggal_id"=> $jtanggal_id,
                "deskripsi"=>$deskripsi,
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
    public function GenerateTanggal(Request $request)
    {
        $nama_hari_panjang = array (0=> "Minggu", 1=> "Senin", 2=> "Selasa", 3=> "Rabu", 4=> "Kamis", 5=> "Jumat", 6=> "Sabtu");
        $nama_hari_pendek = array (0=> "Mgg", 1=> "Sen", 2=> "Sel", 3=> "Rab", 4=> "Kam", 5=> "Jum", 6=> "Sab");
        $r = file_get_contents(env('APP_API_TANGGAL'));
        $hari_libur = json_decode($r, true);
        $arr = array(
            'status'=>false,
            'hasil'=>'Data tanggal tahun '.$request->gentahun.' sudah pernah digenerate',
            'pesan_error'=>'Data tanggal tahun '.$request->gentahun.' sudah pernah digenerate',
        );
        $data = MTanggal::whereYear('tanggal',$request->gentahun)->count();
        if (!$data)
        {
            for ($b=1;$b<=12;$b++)
            {
                $tgl_cek = $request->gentahun.'-'.$b.'-01';
                $jumlah_hari = \Carbon\Carbon::parse($tgl_cek)->daysInMonth;
                for ($i=1;$i<=$jumlah_hari;$i++)
                {
                    $tgl_i = $request->gentahun.'-'.$b.'-'.$i;
                    //cek dulu apakah hari libur
                    $cek_libur = isset($hari_libur[Carbon::parse($tgl_i)->format("Y-m-d")])?true:false;
                    if ($cek_libur == true and $hari_libur[Carbon::parse($tgl_i)->format("Y-m-d")]['holiday'] == true)
                    {
                        //kode 1 = kerja, 2 = Sabtu/Minggu, 3 = libur
                        $j_libur = 3;
                        $deskripsi = $hari_libur[Carbon::parse($tgl_i)->format("Y-m-d")]['summary'][0];
                    }
                    else
                    {
                        //selain hari libur
                        //cek dulu hari sabtu apa minggu
                        if (Carbon::parse($tgl_i)->format('w') > 0 and Carbon::parse($tgl_i)->format('w') < 6)
                        {
                            $j_libur = 1;
                            $deskripsi = '';
                        }
                        else {
                            //hari sabtu ato minggu
                            $j_libur = 2;
                            if (Carbon::parse($tgl_i)->format('w')==6)
                            {
                                $deskripsi = "Sabtu";
                            }
                            else
                            {
                                $deskripsi = "Minggu";
                            }
                        }
                    }

                    //save ke database
                    $data = new MTanggal();
                    $data->tanggal = Carbon::parse($tgl_i)->format("Y-m-d");
                    $data->hari = $nama_hari_panjang[Carbon::parse($tgl_i)->format('w')];
                    $data->jtgl = $j_libur;
                    $data->deskripsi = $deskripsi;
                    $data->save();
                }
            }
            $arr = array(
                'status'=>true,
                'hasil'=>'Data tanggal tahun '.$request->gentahun.' berhasil digenerate',
                'pesan_error'=>'Data tanggal tahun '.$request->gentahun.' berhasil digenerate',
            );
        }
        return Response()->json($arr);
    }
}
