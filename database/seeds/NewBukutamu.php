<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NewBukutamu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //tipe 1 = offline
        //tipe 2 = online
        DB::table('m_tujuan')->insert([
            ['id'=>1,'kode' => 1, 'tipe' => 1, 'inisial'=>'KTR', 'nama' => 'Kantor'],
            ['id'=>2,'kode' => 2, 'tipe' => 1, 'inisial'=>'PST', 'nama' => 'Pelayanan Statistik Terpadu'],
            ['id'=>3,'kode' => 3, 'tipe' => 2, 'inisial'=>'POT', 'nama' => 'Pojok Statistik'],
            ['id'=>4,'kode' => 4, 'tipe' => 2, 'inisial'=>'EML', 'nama' => 'E-Mail'],
            ['id'=>5,'kode' => 5, 'tipe' => 2, 'inisial'=>'WAP', 'nama' => 'WhatsApp'],
            ['id'=>6,'kode' => 6, 'tipe' => 2, 'inisial'=>'TEL', 'nama' => 'Telepon/Lainnya'],
        ]);

        DB::table('m_tipe_tujuan')->insert([
            ['id'=>1,'kode' => 1, 'nama' => 'Offline'],
            ['id'=>2,'kode' => 2, 'nama' => 'Online'],
        ]);

        DB::table('m_pendidikan')->insert([
            ['id'=>1,'kode' => 1, 'nama' => '<=SMA Sederajat'],
            ['id'=>2,'kode' => 2, 'nama' => 'Diploma'],
            ['id'=>3,'kode' => 3, 'nama' => 'Sarjana'],
            ['id'=>4,'kode' => 4, 'nama' => 'Magister'],
            ['id'=>5,'kode' => 5, 'nama' => 'Doktor'],
        ]);
        DB::table('m_layanan_pst')->insert([
            ['id'=>1,'kode' => 0, 'inisial'=>'LA', 'nama' => 'Lainnya'],
            ['id'=>2,'kode' => 1, 'inisial'=>'PS', 'nama' => 'Perpustakaan'],
            ['id'=>3,'kode' => 2, 'inisial'=>'PJ', 'nama' => 'Penjualan Produk Statistik'],
            ['id'=>4,'kode' => 3,  'inisial'=>'KS', 'nama' => 'Konsultasi Statistik'],
            ['id'=>5,'kode' => 4,  'inisial'=>'RS', 'nama' => 'Rekomendasi Kegiatan Statistik'],
        ]);
    }
}
