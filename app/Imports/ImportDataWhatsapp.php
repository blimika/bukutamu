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
use App\MasterLayananPST;
use App\MasterTipeKunjungan;
use App\MasterTujuan;
use App\NewKunjungan;
use App\Pengunjung;
use App\Helpers\Generate;
use QrCode;
use Illuminate\Support\Facades\Storage;

class ImportDataWhatsapp implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $data = Pengunjung::where('pengunjung_nomor_hp',$row['nomor_hp'])->first();
            if (!$data)
            {
                //tidak ada pengunjung
                $data = new Pengunjung();
                $data->pengunjung_uid = Generate::Kode(6);
                $data->pengunjung_nomor_hp = $row['nomor_hp'];
                $data->pengunjung_nama = $row['nama'];
                $data->pengunjung_jk = $row['jk'];
                $data->pengunjung_tahun_lahir = $row['tahun_lahir'];
                $data->pengunjung_pekerjaan = $row['pekerjaan'];
                $data->pengunjung_pendidikan = $row['pendidikan'];
                $data->pengunjung_email = $row['pekerjaan'];
                $data->pengunjung_alamat = $row['alamat'];
                $data->pengunjung_email = $row['email'];
                $data->pengunjung_total_kunjungan = 0;
                $data->pengunjung_user_id = 0;
                $data->save();

                //buat qrcode img nya
                $qrcode_foto = QrCode::format('png')
                    ->size(500)->margin(1)->errorCorrection('H')
                    ->generate($data->pengunjung_uid);
                $output_file = '/img/qrcode/' . $data->pengunjung_uid . '-' . $data->pengunjung_id . '.png';
                //$data_foto = base64_decode($qrcode_foto);
                Storage::disk('public')->put($output_file, $qrcode_foto);
            }
            //nomor antrian dulu
            $data_antrian = NewKunjungan::where([['kunjungan_tanggal', Carbon::parse($row['tanggal_kunjungan'])->format('Y-m-d')], ['kunjungan_tujuan',$row['saluran']]])->orderBy('kunjungan_nomor_antrian', 'desc')->first();
            $layanan_pst = 0;
            $data_layanan_utama = MasterTujuan::where('kode',$row['saluran'])->first();
            $nomor_antrian_inisial = $data_layanan_utama->inisial;
            if ($data_antrian) {
                //kalo sudah ada antrian
                $nomor_selanjutnya = $data_antrian->kunjungan_nomor_antrian + 1;
            }
            else {
                //belum ada sama sekali
                $nomor_selanjutnya = 1;
            }
            //cek jenis kelamin ambil dari query data diatas
            if ($data->pengunjung_jk == 1) {
                $laki = 1;
                $wanita = 0;
            } else {
                $laki = 0;
                $wanita = 1;
            }
            //simpan kunjungan
            $jam_datang = Carbon::parse($row['tanggal_kunjungan'] . ' 08:00:00')->format('Y-m-d H:i:s');
            $jam_pulang = Carbon::parse($row['tanggal_kunjungan'] . ' 10:00:00')->format('Y-m-d H:i:s');
            $petugas_id = Auth::user()->id;
            $petugas_username = Auth::user()->username;
            $loket_petugas = 3;

            $newdata = New NewKunjungan();
            $newdata->pengunjung_uid = $data->pengunjung_uid;
            $newdata->kunjungan_uid = Generate::Kode(7);
            $newdata->kunjungan_tanggal = Carbon::parse($row['tanggal_kunjungan'])->format('Y-m-d');
            $newdata->kunjungan_keperluan = $row['permintaan'];
            $newdata->kunjungan_jenis = 1;
            $newdata->kunjungan_tujuan = $row['saluran'];
            $newdata->kunjungan_pst = $layanan_pst;
            $newdata->kunjungan_jumlah_orang = 1;
            $newdata->kunjungan_jumlah_pria = $laki;
            $newdata->kunjungan_jumlah_wanita = $wanita;
            $newdata->kunjungan_nomor_antrian = $nomor_selanjutnya;
            $newdata->kunjungan_teks_antrian = $nomor_antrian_inisial . '-' . sprintf("%03d", $nomor_selanjutnya);
            $newdata->kunjungan_petugas_id = $petugas_id;
            $newdata->kunjungan_petugas_username = $petugas_username;
            $newdata->kunjungan_jam_datang = $jam_datang;
            $newdata->kunjungan_jam_pulang = $jam_pulang;
            $newdata->kunjungan_loket_petugas = $loket_petugas;
            $newdata->kunjungan_flag_antrian = 3;
            $newdata->kunjungan_flag_feedback = 2;
            $newdata->save();
            //tambah total kunjungan di tabel pengunjung

            $total_kunjungan = $data->pengunjung_total_kunjungan;
            $data->pengunjung_total_kunjungan = $total_kunjungan + 1;
            $data->update();
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
