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
            ['id'=>1,'kode' => 0, 'nama' => 'Kantor'],
            ['id'=>2,'kode' => 1, 'nama' => 'PST'],
            ['id'=>3,'kode' => 2, 'nama' => 'Pojok Statistik'],
            ['id'=>4,'kode' => 3, 'nama' => 'E-Mail'],
            ['id'=>5,'kode' => 4, 'nama' => 'Whatsapp'],
            ['id'=>6,'kode' => 5, 'nama' => 'Telepon'],
        ]);
        DB::table('m_akses')->insert([
            ['id'=>1,'ip' => '127.0.0.1', 'flag' => '1','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id'=>2,'ip' => '::1', 'flag' => '1','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id'=>3,'ip' => '10.52.6.31', 'flag' => '1','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id'=>4,'ip' => '202.46.65.114', 'flag' => '1','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ]);
        DB::table('jtanggal')->insert([
            ['id'=>1,'kode' => 1, 'nama' => 'Kerja'],
            ['id'=>2,'kode' => 2, 'nama' => 'Sabtu/Minggu'],
            ['id'=>3,'kode' => 3, 'nama' => 'Libur'],
        ]);
        DB::table('users')->insert([
            ['name' => 'I Putu Dyatmika','username'=>'blimika', 'email' => 'mika@bpsntb.id', 'password' => bcrypt('1'), 'level' => '15'],
            ['name' => 'Yati Daryati Nurmalasari','username'=>'yatidar', 'email' => 'yatidar@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Rimassatya Pawestri','username'=>'rimas', 'email' => 'rimas@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Wahyudi Septiawan','username'=>'wahyudi', 'email' => 'wahyudi@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Lalu Yuriade Mulana','username'=>'yuriade', 'email' => 'yuriade@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
            ['name' => 'Isti','username'=>'isti', 'email' => 'isti@bpsntb.id', 'password' => bcrypt('1'), 'level' => '10'],
        ]);
    }
}
