<?php

namespace App\Console\Commands;
use App\MTanggal;
use Illuminate\Console\Command;
use App\LogWhatsapp;
use App\WaFlag;
use Carbon\Carbon;
use App\Services\FonnteService;
use App\Services\WhatsAppService;
use App\Helpers\Generate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;

class InfoPetugas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $fonnteService;
    protected $WAservice;
    protected $cek_nomor_hp;
    protected $link_skd;

    protected $signature = 'info:petugas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifikasi ke WA Petugas Jaga';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FonnteService $fonnteService, WhatsAppService $WAservice)
    {
        parent::__construct();
        $this->fonnteService = $fonnteService;
        $this->WAservice = $WAservice;
        $this->link_skd = env('APP_LINK_SKD');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    private function cek_nomor_hp($nomor)
    {
        // Mengecek apakah nomor diawali dengan '0'
        if (substr($nomor, 0, 1) === '0') {
            // Jika ya, kembalikan nomor tanpa awalan '0'
            $nomorhp = "62".substr($nomor, 1);

        }
        // Mengecek apakah nomor diawali dengan '+'
        elseif (substr($nomor, 0, 1) === '+') {
            // Jika ya, abaikan nomor ini dengan mengembalikan null
            // Anda bisa mengubahnya untuk menampilkan pesan error atau lainnya
            $nomorhp = substr($nomor, 1);
        }
        // Jika tidak diawali '0' atau '+'
        else {
            $nomorhp = $nomor;
        }
        return $nomorhp;
    }
    public function handle()
    {
        //ambil jadwal dulu
        $data = MTanggal::where('tanggal',Carbon::today()->format('Y-m-d'))->first();
        if ($data)
        {
            if ($data->jtgl == 1)
            {
                if ($data->petugas1_id > 0)
                {
                    //$data1 = User::where('id',$data->petugas1_id)->first();
                    $hp_petugas1 = $data->Petugas1->telepon;
                    $hp_petugas2 = $data->Petugas2->telepon;
                    //dd($hp_petugas1);
                    $recipients1 = $this->cek_nomor_hp($hp_petugas1);
                    $recipients2 = $this->cek_nomor_hp($hp_petugas2);
                    $message1 = '#Hai *'.$data->Petugas1->name.'*'.chr(10).chr(10)
                    .'Selamat pagi,'.chr(10)
                    .'Pengingat tugas jaga PST hari ini,'.chr(10)
                    .'*'.\Carbon\Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y').'*'.chr(10).chr(10)
                    .'Terimakasih dan selamat bertugas'.chr(10).chr(10)
                    .'Aplikasi Bukutamu '.chr(10).'BPS Provinsi Nusa Tenggara Barat'.chr(10).'Jl. Dr. Soedjono No. 74 Mataram NTB 83116';
                    $message2 = '#Hai *'.$data->Petugas2->name.'*'.chr(10).chr(10)
                    .'Selamat pagi,'.chr(10)
                    .'Pengingat tugas jaga PST hari ini,'.chr(10)
                    .'*'.\Carbon\Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y').'*'.chr(10).chr(10)
                    .'Terimakasih dan selamat bertugas'.chr(10).chr(10)
                    .'Aplikasi Bukutamu '.chr(10).'BPS Provinsi Nusa Tenggara Barat'.chr(10).'Jl. Dr. Soedjono No. 74 Mataram NTB 83116';
                    //simpan log dulu
                     //input ke log pesan
                    $new_wa1 = new LogWhatsapp();
                    $new_wa1->wa_tanggal = Carbon::today()->format('Y-m-d');
                    $new_wa1->wa_uid = Generate::Kode(8);
                    $new_wa1->wa_target = $recipients1;
                    $new_wa1->wa_message = $message1;
                    $new_wa1->save();

                    $new_wa2 = new LogWhatsapp();
                    $new_wa2->wa_tanggal = Carbon::today()->format('Y-m-d');
                    $new_wa2->wa_uid = Generate::Kode(8);
                    $new_wa2->wa_pengunjung_uid = $data->Petugas2->pengunjung_uid;
                    $new_wa2->wa_target = $recipients2;
                    $new_wa2->wa_message = $message2;
                    $new_wa2->save();

                    if (ENV('APP_WA_LOKAL_MODE') == true) {
                        try {
                            $result1 = $this->WAservice->sendMessage($recipients1, $message1);
                            if ($result1)
                            {
                                $new_wa1->wa_message_id = $result1['results']['message_id'];
                                $new_wa1->wa_status = $result1['results']['status'];
                                $new_wa1->wa_flag = 2;
                                $new_wa1->update();
                            }

                        } catch (\Throwable $e) {
                            $error1 = Log::error('WA LOKAL 1: ' . $e->getMessage());
                            //return response()->json(['error' => 'Internal Server Error'],500);
                            $new_wa1->wa_status = $error1 ;
                            $new_wa1->wa_flag = 3;
                            $new_wa1->update();
                        }
                    }
                    sleep(1);
                    if (ENV('APP_WA_LOKAL_MODE') == true) {
                        try {
                            $result2 = $this->WAservice->sendMessage($recipients2, $message2);
                            if ($result2)
                            {
                                $new_wa2->wa_message_id = $result2['results']['message_id'];
                                $new_wa2->wa_status = $result2['results']['status'];
                                $new_wa2->wa_flag = 2;
                                $new_wa2->update();
                            }

                        } catch (\Throwable $e) {
                            $error2 = Log::error('WA LOKAL 2: ' . $e->getMessage());
                            //return response()->json(['error' => 'Internal Server Error'],500);
                            $new_wa2->wa_status = $error2 ;
                            $new_wa2->wa_flag = 3;
                            $new_wa2->update();
                        }
                    }

                    $error = "Notifikasi sudah dikirimkan ke petugas jaga";
                }
                else
                {
                     $error = "Data petugas jaga masih kosong, belum ada jadwal";
                }
            }
            else
            {
                $error = "Hari libur : ".$data->deskripsi;
            }

        }
        else
        {
            $error = "Data petugas belum tersedia";
        }
        $this->info($error);
    }
}
