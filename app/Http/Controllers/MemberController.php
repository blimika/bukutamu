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
use App\User;
use App\MasterLevel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    //
    public function ListMember()
    {
        if (Auth::User()->level==10)
        {
            $m_level = MasterLevel::where('kode','10')->get();
        }
        else
        {
            $m_level = MasterLevel::where('kode','>','1')->get();
        }
        $data_users = User::get();
        return view('member.list',['mlevel'=>$m_level,'dataUser'=>$data_users]);
    }
    public function PageListMember(Request $request)
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
        $totalRecords = User::select('count(*) as allcount')->where('level','<=',Auth::User()->level)->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->where('level','<=',Auth::User()->level)->count();

        // Fetch records
        $records = User::orderBy($columnName,$columnSortOrder)
            ->where('users.name', 'like', '%' .$searchValue . '%')
            ->where('level','<=',Auth::User()->level)
            ->select('users.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start+1;
        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $username = $record->username;
            $user_foto = $record->user_foto;
            $level = $record->level;
            $level_nama = $record->mLevel->nama;
            $email = $record->email;
            $telepon = $record->telepon;
            $flag = $record->flag;
            $email_kodever = $record->email_kodever;
            $tamu_id = $record->tamu_id;
            $lastlogin = $record->lastlogin;
            $lastip = $record->lastip;
            if ($record->user_foto != NULL)
            {
                if (Storage::disk('public')->exists($record->user_foto))
                {
                    $user_foto = '<a class="image-popup" href="'.asset('storage/'.$record->user_foto).'" title="Nama : '.$record->name.'">
                <img src="'.asset('storage/'.$record->user_foto).'" class="img-circle" width="60" height="60" class="img-responsive" />
            </a>';
                }
                else
                {
                    $user_foto = '<a class="image-popup" href="https://via.placeholder.com/480x360/0022FF/FFFFFF/?text=photo+tidak+ada" title="Nama : '.$record->name.'">
                    <img src="https://via.placeholder.com/480x360/0022FF/FFFFFF/?text=photo+tidak+ada" alt="image"  class="img-circle" width="60" height="60" />
                    </a>';
                }
            }
            else
            {
                $user_foto = '<a class="image-popup" href="https://via.placeholder.com/480x360/0022FF/FFFFFF/?text=photo+tidak+ada" title="Nama : '.$record->name.'">
                <img src="https://via.placeholder.com/480x360/0022FF/FFFFFF/?text=photo+tidak+ada" alt="image"  class="img-circle" width="60" height="60" />
                </a>';
            }

            $aksi ='
                <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti-settings"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" data-id="'.$record->id.'" data-toggle="modal" data-target="#ViewMemberModal">View</a>
                    <a class="dropdown-item" href="#" data-id="'.$record->id.'" data-toggle="modal" data-target="#EditMemberModal">Edit</a>
                    <a class="dropdown-item" href="#" data-id="'.$record->id.'" data-toggle="modal" data-target="#GantiPasswdModal">Ganti Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item hapusmember" href="#" data-id="'.$record->id.'" data-nama="'.$record->name.'">Hapus</a>

                </div>
            </div>
            ';
            $data_arr[] = array(
                "id" => $id,
                "name"=>$name,
                "username"=> $username,
                "email"=>$email,
                "level"=>$level,
                "level_nama"=>$level_nama,
                "telepon"=>$telepon,
                "flag"=>$flag,
                "tamu_id"=>$tamu_id,
                "lastlogin"=>$lastlogin,
                "lastip"=>$lastip,
                "user_foto"=>$user_foto,
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
    public function HapusMember(Request $request)
    {
        if (Auth::User()->level < 10) {
            $arr = array(
                'status'=>false,
                'hasil'=>'Anda tidak memiliki akses untuk menghapus'
            );
            return Response()->json($arr);
        }
        $data = User::where('id',$request->id)->first();
        $arr = array(
            'status'=>false,
            'hasil'=>'Data member tidak tersedia'
        );
        if ($data)
        {
            if ($data->username == 'admin')
            {
                $arr = array(
                    'status'=>false,
                    'hasil'=>'Superadmin tidak bisa dihapus'
                );
            }
            elseif (Auth::User()->username == $data->username)
            {
                $arr = array(
                    'status'=>false,
                    'hasil'=>'Tidak bisa menghapus username sendiri'
                );
            }
            elseif (Auth::User()->level < $data->level)
            {
                $arr = array(
                    'status'=>false,
                    'hasil'=>'Operator tidak bisa menghapus admin'
                );
            }
            else
            {
                $nama = $data->name;
                $namafile_photo = $data->user_foto;
                $data->delete();
                if ($data->user_foto != NULL)
                {
                    Storage::disk('public')->delete($namafile_photo);
                }
                $arr = array(
                    'status'=>true,
                    'hasil'=>'Data member an. '.$nama.' berhasil dihapus'
                );
            }

        }
        return Response()->json($arr);
    }
    public function SimpanMember(Request $request)
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
            $data->level = $request->level;
            $data->name = trim($request->name);
            $data->username = trim($request->username);
            $data->email = trim($request->email);
            $data->telepon = trim($request->telepon);
            $data->password = bcrypt($request->passwd);
            $data->email_kodever = Str::random(10);
            $data->flag = 0;
            $data->tamu_id = 0;
            $data->save();
            $arr = array(
                'status'=>true,
                'hasil'=>'Data member an. '.$request->username.' berhasil ditambahkan'
            );
        }
        #dd($request->all());
        return Response()->json($arr);
    }
    public function CariMember($id)
    {
        $dataCek = User::where('id',$id)->first();
        $arr = array('hasil' => 'Data member tidak tersedia', 'status' => false);
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
            */
            //cek member/users
            $arr_pengunjung = array('hasil'=>'Data pengujung tidak tersedia','status'=>false);
            if ($dataCek->tamu_id > 0)
            {
                //dd($dataCek->mtamu);
                if ($dataCek->mtamu)
                {
                    $cek_kunjungan = Kunjungan::where('tamu_id',$dataCek->tamu_id)->count();
                    $arr_kunjungan = array('hasil'=>'Data Kunjungan Kosong','status'=>false);
                    if ($cek_kunjungan > 0)
                    {
                        //ada kunjungan
                        $dataKunjungan = Kunjungan::with('tamu','pLayanan','pManfaat')->where('tamu_id',$dataCek->tamu_id)->orderBy('created_at','desc')->take(10)->get();
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
                    $arr_pengunjung = array(
                        'hasil' => array(
                            'tamu_id'=>$dataCek->mtamu->id,
                            'id_identitas'=>$dataCek->mtamu->id_midentitas,
                            'id_identitas_nama'=>$dataCek->mtamu->identitas->nama,
                            'nomor_identitas'=>$dataCek->mtamu->nomor_identitas,
                            'nama_lengkap'=>$dataCek->mtamu->nama_lengkap,
                            'tgl_lahir'=>$dataCek->mtamu->tgl_lahir,
                            'tgl_lahir_nama'=>Carbon::parse($dataCek->mtamu->tgl_lahir)->isoFormat('D MMMM Y'),
                            'umur'=>Carbon::parse($dataCek->mtamu->tgl_lahir)->age,
                            'id_jk'=>$dataCek->mtamu->id_jk,
                            'nama_jk'=>$dataCek->mtamu->jk->nama,
                            'inisial_jk'=>$dataCek->mtamu->jk->inisial,
                            'id_kerja'=>$dataCek->mtamu->id_mkerja,
                            'nama_kerja'=>$dataCek->mtamu->pekerjaan->nama,
                            'kat_kerja'=>$dataCek->mtamu->id_mkat_kerja,
                            'kat_kerja_nama'=>$dataCek->mtamu->kategoripekerjaan->nama,
                            'kerja_detil'=>$dataCek->mtamu->kerja_detil,
                            'id_mdidik'=>$dataCek->mtamu->id_mdidik,
                            'nama_mdidik'=>$dataCek->mtamu->pendidikan->nama ,
                            'id_mwarga'=>$dataCek->mtamu->id_mwarga,
                            'nama_mwarga'=>$dataCek->mtamu->warga->nama,
                            'email'=>$dataCek->mtamu->email,
                            'telepon'=>$dataCek->mtamu->telepon ,
                            'alamat'=>$dataCek->mtamu->alamat,
                            'kode_qr'=>$dataCek->mtamu->kode_qr,
                            'created_at'=>$dataCek->mtamu->created_at,
                            'created_at_nama'=>Carbon::parse($dataCek->mtamu->created_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                            'updated_at'=>$dataCek->mtamu->updated_at,
                            'updated_at_nama'=>Carbon::parse($dataCek->mtamu->updated_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                            'url_foto'=>$dataCek->mtamu->tamu_foto,
                            'kunjungan'=>$arr_kunjungan,
                        ),
                        'status' => true
                    );
                }
            }

            $arr = array(
                'hasil' => array(
                    'id'=> $dataCek->id,
                    'name' => $dataCek->name,
                    'username' => $dataCek->username,
                    'level' => $dataCek->level,
                    'level_nama' => $dataCek->mLevel->nama,
                    'lastlogin' => $dataCek->lastlogin,
                    'lastlogin_nama'=>Carbon::parse($dataCek->lastlogin)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                    'lastip' => $dataCek->lastip,
                    'user_foto' => $dataCek->user_foto,
                    'tamu_id'=>$dataCek->tamu_id,
                    'created_at'=>$dataCek->created_at,
                    'created_at_nama'=>Carbon::parse($dataCek->created_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                    'updated_at'=>$dataCek->updated_at,
                    'updated_at_nama'=>Carbon::parse($dataCek->updated_at)->isoFormat('dddd, D MMMM Y H:mm:ss'),
                    'pengunjung'=>$arr_pengunjung,
                ),
                'status'=>true
            );
        }
        return Response()->json($arr);
    }
}
