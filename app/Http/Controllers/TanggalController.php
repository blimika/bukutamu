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
use App\Exports\FormatJadwal;
use App\Imports\ImportJadwalPetugas;
use Excel;

class TanggalController extends Controller
{
    //
    public function MasterTanggal()
    {
        $data_tahun = DB::table('mtanggal')
            ->selectRaw('year(tanggal) as tahun')
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();
        if (request('tahun') == NULL) {
            $tahun_filter = 0;
        } else {
            $tahun_filter = request('tahun');
        }
        $data_jtanggal = JTanggal::get();
        $data_operator = User::where('level',10)->get();
        return view('tanggal.index',[
            'jtanggal'=>$data_jtanggal,
            'operator'=>$data_operator,
            'data_tahun'=>$data_tahun,
            'tahun'=>$tahun_filter
        ]);
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
                "petugas1_id"=> $data->petugas1_id,
                "petugas1_username"=> $data->petugas1_username,
                "petugas2_id"=> $data->petugas2_id,
                "petugas2_username"=> $data->petugas2_username,

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
    public function UpdateJadwal(Request $request)
    {
        $data = MTanggal::where('id',$request->id)->first();
        $arr = array(
            'status'=>false,
            'hasil'=>'Jadwal tidak ditemukan'
        );
        if ($data)
        {
            /*
                id: id,
                petugas1_id: petugas_1,
                petugas2_id: petugas_2,
            */
            if ($request->petugas1_id == $request->petugas2_id )
            {
                $arr = array(
                    'status'=>false,
                    'hasil'=>'Petugas 1 dan Petugas 2 tidak boleh sama'
                );
            }
            else
            {
                $data1 = User::where('id',$request->petugas1_id)->first();
                $data2 = User::where('id',$request->petugas2_id)->first();
                //update data
                $data->petugas1_id = $request->petugas1_id;
                $data->petugas1_username = $data1->username;
                $data->petugas2_id = $request->petugas2_id;
                $data->petugas2_username = $data2->username;
                $data->update();
                $arr = array(
                    'status'=>true,
                    'hasil'=>'Jadwal petugas sudah diupdate'
                );
            }
        }
        return Response()->json($arr);
    }
    public function PageListTanggal(Request $request)
    {
        if (request('tahun') == NULL) {
            $tahun_filter = 0;
        }
        else {
            $tahun_filter = request('tahun');
        }
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
        $totalRecords = MTanggal::count();
        $totalRecordswithFilter = DB::table('mtanggal')
        ->leftJoin('jtanggal','mtanggal.jtgl','=','jtanggal.kode')
        ->leftJoin(DB::Raw("(select id as id_petugas1, name as nama_petugas1, username as username_petugas1 from users) as petugas1"),'mtanggal.petugas1_id','=','petugas1.id_petugas1')
        ->leftJoin(DB::Raw("(select id as id_petugas2, name as nama_petugas2, username as username_petugas2 from users) as petugas2"),'mtanggal.petugas2_id','=','petugas2.id_petugas2')
        ->when($searchValue, function ($q) use ($searchValue) {
            return $q->where('mtanggal.tanggal', 'like', '%' .$searchValue . '%')
                         ->orWhere('nama_petugas1', 'like', '%' . $searchValue . '%')
                         ->orWhere('nama_petugas2', 'like', '%' . $searchValue . '%')
                         ->orWhere('username_petugas1', 'like', '%' . $searchValue . '%')
                         ->orWhere('username_petugas2', 'like', '%' . $searchValue . '%')
                         ->orWhere('mtanggal.deskripsi', 'like', '%' . $searchValue . '%')
                         ->orWhere('mtanggal.hari', 'like', '%' . $searchValue . '%');
        })
        ->when($tahun_filter > 0, function ($query) use ($tahun_filter) {
            return $query->whereYear('mtanggal.tanggal', $tahun_filter);
        })
        ->count();

        // Fetch records
        $records = DB::table('mtanggal')
            ->leftJoin('jtanggal','mtanggal.jtgl','=','jtanggal.kode')
            ->leftJoin(DB::Raw("(select id as id_petugas1, name as nama_petugas1, username as username_petugas1 from users) as petugas1"),'mtanggal.petugas1_id','=','petugas1.id_petugas1')
            ->leftJoin(DB::Raw("(select id as id_petugas2, name as nama_petugas2, username as username_petugas2 from users) as petugas2"),'mtanggal.petugas2_id','=','petugas2.id_petugas2')
            ->when($searchValue, function ($q) use ($searchValue) {
                return $q->where('mtanggal.tanggal', 'like', '%' .$searchValue . '%')
                         ->orWhere('nama_petugas1', 'like', '%' . $searchValue . '%')
                         ->orWhere('nama_petugas2', 'like', '%' . $searchValue . '%')
                         ->orWhere('username_petugas1', 'like', '%' . $searchValue . '%')
                         ->orWhere('username_petugas2', 'like', '%' . $searchValue . '%')
                         ->orWhere('mtanggal.deskripsi', 'like', '%' . $searchValue . '%')
                         ->orWhere('mtanggal.hari', 'like', '%' . $searchValue . '%');
            })
            ->when($tahun_filter > 0, function ($query) use ($tahun_filter) {
                return $query->whereYear('mtanggal.tanggal', $tahun_filter);
            })
            ->select('mtanggal.*','petugas1.*','petugas2.*','jtanggal.nama as jtgl_nama')
            ->skip($start)
            ->take($rowperpage)
            ->orderBy($columnName,$columnSortOrder)
            ->get();

        $data_arr = array();
        $sno = $start+1;
        foreach($records as $record){
            $id = $record->id;
            $tanggal = $record->tanggal;
            $hari = $record->hari;
            $jtanggal_id = $record->jtgl_nama;
            $deskripsi = $record->deskripsi;
            $petugas1 = $record->nama_petugas1;
            $petugas2 = $record->nama_petugas2;
            if (Auth::user()->level == 20)
                {
                    if ($record->jtgl < 2)
                    {
                        $link_edit_jadwal = '<a class="dropdown-item" href="#" data-id="'.$record->id.'" data-tanggal="'.$record->tanggal.'" data-toggle="modal" data-target="#EditJadwal">Edit Jadwal</a>
                        <div class="dropdown-divider"></div>';
                    }
                    else
                    {
                        $link_edit_jadwal = '';
                    }
                    $aksi ='
                    <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ti-settings"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" data-id="'.$record->id.'" data-tanggal="'.$record->tanggal.'" data-toggle="modal" data-target="#EditTanggal">Edit Tanggal</a>
                        <div class="dropdown-divider"></div>
                        '.$link_edit_jadwal.'
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
                "petugas1"=>$petugas1,
                "petugas2"=>$petugas2,
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
    public function FormatJadwal()
    {
        $fileName = 'format-jadwal-';
        $data = [
            [
                //'tahun_matrik' => null,
                'tanggal' => 'Format : YYYY-MM-DD',
                'petugas1_id' => 'hanya angka',
                'petugas2_id' => 'hanya angka',
            ]
        ];
        $namafile = $fileName . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new FormatJadwal($data), $namafile);
    }
    public function ImportJadwalPetugas(Request $request)
    {
        $arr = array(
            'status'=>false,
            'hasil'=>'Import jadwal petugas tidak berhasil',
            'pesan_error'=>'Import jadwal petugas tidak berhasil',
        );

        if ($request->hasFile('file_import')) {
            $file = $request->file('file_import'); //GET FILE
            Excel::import(new ImportJadwalPetugas, $file); //IMPORT FILE
            $arr = array(
                'status'=>true,
                'hasil'=>'Import jadwal petugas berhasil',
                'pesan_error'=>'Import jadwal petugas berhasil',
            );
        }
        return Response()->json($arr);
        //return redirect()->back()->with(['error' => 'Please choose file before']);
    }
}
