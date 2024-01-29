<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Auth;
use App\MTanggal;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\JTanggal;
use App\User;

class ImportJadwalPetugas implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $cek_user1 = User::where('id',$row['petugas1_id'])->first();
            $cek_user2 = User::where('id',$row['petugas2_id'])->first();
            $data = MTanggal::where([['tanggal',$row['tanggal']],['jtgl','1']])->first();
            if ($data)
            {
                if ($cek_user1)
                {
                    if ($cek_user2)
                    {
                        $petugas2_id = $cek_user2->id;
                        $petugas2_username = $cek_user2->username;
                    }
                    else
                    {
                        $petugas2_id = 0;
                        $petugas2_username = NULL;
                    }
                    $petugas1_id = $cek_user1->id;
                    $petugas1_username = $cek_user1->username;
                }
                else
                {
                    if ($cek_user2)
                    {
                        $petugas2_id = $cek_user2->id;
                        $petugas2_username = $cek_user2->username;
                    }
                    else
                    {
                        $petugas2_id = 0;
                        $petugas2_username = NULL;
                    }
                    $petugas1_id = 0;
                    $petugas1_username = NULL;
                }
                $data->petugas1_id = $petugas1_id;
                $data->petugas1_username = $petugas1_username;
                $data->petugas2_id = $petugas2_id;
                $data->petugas2_username = $petugas2_username;
                $data->update();
            }
        }
    }
    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
