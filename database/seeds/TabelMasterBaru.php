<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TabelMasterBaru extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //tambah master level user
        DB::table('mlevel')->insert([
            ['id'=>1,'kode' => 1, 'nama' => 'Pengunjung'],
            ['id'=>2,'kode' => 10, 'nama' => 'Operator'],
            ['id'=>3,'kode' => 15, 'nama' => 'Admin'],
            ['id'=>4,'kode' => 20, 'nama' => 'Super Admin'],
        ]);
        DB::table('msaluran')->insert([
            ['id'=>1,'kode' => 1, 'nama' => 'Kantor'],
            ['id'=>2,'kode' => 2, 'nama' => 'PST'],
            ['id'=>3,'kode' => 3, 'nama' => 'Pojok Statistik'],
            ['id'=>4,'kode' => 4, 'nama' => 'E-Mail'],
            ['id'=>5,'kode' => 5, 'nama' => 'Whatsapp'],
            ['id'=>6,'kode' => 6, 'nama' => 'Telepon'],
        ]);
        DB::table('mf_kunjungan')->insert([
            ['id'=>1,'kode' => 1, 'nama' => 'Terjadwal'],
            ['id'=>2,'kode' => 2, 'nama' => 'Datang'],
            ['id'=>3,'kode' => 3, 'nama' => 'Batal'],
        ]);
        DB::table('m_akses')->insert([
            ['id'=>1,'ip' => '127.0.0.1', 'flag' => '1','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id'=>2,'ip' => '::1', 'flag' => '1','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id'=>3,'ip' => '10.52.6.31', 'flag' => '1','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id'=>4,'ip' => '36.95.114.173', 'flag' => '1','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id'=>5,'ip' => '36.95.114.170', 'flag' => '1','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ]);
        DB::table('jtanggal')->insert([
            ['id'=>1,'kode' => 1, 'nama' => 'Kerja'],
            ['id'=>2,'kode' => 2, 'nama' => 'Sabtu/Minggu'],
            ['id'=>3,'kode' => 3, 'nama' => 'Libur'],
        ]);
        DB::table('mlayanan_utama')->insert([
            ['id'=>1,'kode' => 0, 'inisial'=> 'KT', 'nama' => 'Kantor'],
            ['id'=>2,'kode' => 1, 'inisial'=> 'PS', 'nama' => 'Perpustakaan'],
            ['id'=>3,'kode' => 2, 'inisial'=> 'PJ', 'nama' => 'Penjualan'],
            ['id'=>4,'kode' => 3, 'inisial'=> 'KS', 'nama' => 'Konsultasi'],
            ['id'=>5,'kode' => 4, 'inisial'=> 'RS', 'nama' => 'Rekomendasi'],
        ]);
        DB::table('mf_antrian')->insert([
            ['id'=>1,'kode' => 1, 'nama' => 'Ruang Tunggu'],
            ['id'=>2,'kode' => 2, 'nama' => 'Dalam Layanan'],
            ['id'=>3,'kode' => 3, 'nama' => 'Selesai'],
        ]);
        DB::table('users')->insert([
            ['name' => 'I Putu Dyatmika','username'=>'blimika', 'email' => 'mika@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Yati Daryati Nurmalasari','username'=>'yatidar', 'email' => 'yatidar@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Rimassatya Pawestri','username'=>'rimas', 'email' => 'rimas@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Wahyudi Septiawan','username'=>'wahyudi', 'email' => 'wahyudi@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Lalu Yuriade Mulana','username'=>'yuriade', 'email' => 'yuriade@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Shafa Rosea Surbakti ','username'=>'shafa', 'email' => 'shafa@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Indah Fitriana','username'=>'indah', 'email' => 'indah.fitriana@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Ria Kusumawati','username'=>'ria', 'email' => 'ria@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Nimas Ayu Florentyna','username'=>'nimas', 'email' => 'nimas.ayu@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Eka Marwitasari','username'=>'eka', 'email' => 'eka.marwitasari@bps.go.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Adlan Felardhi','username'=>'adlan', 'email' => 'a.felardhi@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Medhia Ratna PH','username'=>'medhia', 'email' => 'medhia.ratna@bps.go.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Isna Zuriatina','username'=>'isna', 'email' => 'isna_z@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Abdurrofi Robbani','username'=>'rofi', 'email' => 'rofi.robbani@bps.go.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Yhisty Ismayawati','username'=>'yesti', 'email' => 'yesti@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
        ]);
    }
}
