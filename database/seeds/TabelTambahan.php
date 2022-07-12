<?php

use Illuminate\Database\Seeder;

class TabelTambahan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Insert Manfaat Kunjungan
        DB::table('mmanfaat')->insert([
            ['id' => 1, 'nama' => 'Tugas Sekolah/Tugas Kuliah', 'flag' => 1],
            ['id' => 2, 'nama' => 'Pemerintah', 'flag' => 1],
            ['id' => 3, 'nama' => 'Komersial', 'flag' => 1],
            ['id' => 4, 'nama' => 'Penelitian', 'flag' => 1],
            ['id' => 5, 'nama' => 'Lainnya', 'flag' => 1],
        ]);
        //Insert Fasilitas
        DB::table('mfas')->insert([
            ['id' => 1, 'nama' => 'Datang langsung ke Unit Pelayanan Statistik Terpadu (PST)', 'flag' => 1],
            ['id' => 2, 'nama' => 'Aplikasi Pelayanan Statistik Terpadu Online (pst.bps.go.id)', 'flag' => 1],
            ['id' => 4, 'nama' => 'Website BPS (bps.go.id) / AllStats BPS', 'flag' => 1],
            ['id' => 8, 'nama' => ' Surat / Email', 'flag' => 1],
            ['id' => 16, 'nama' => 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', 'flag' => 1],
            ['id' => 32, 'nama' => 'Lainnya', 'flag' => 1],
        ]);
        //Insert layanan
        DB::table('mlay')->insert([
            ['id' => 1, 'nama' => 'Perpustakaan', 'flag' => 1],
            ['id' => 2, 'nama' => 'Pembelian Publikasi BPS', 'flag' => 1],
            ['id' => 4, 'nama' => 'Pembelian Data Mikro/Peta Wilayah Kerja Statistik', 'flag' => 1],
            ['id' => 8, 'nama' => 'Akses Produk Statistik Pada Website BPS', 'flag' => 1],
            ['id' => 16, 'nama' => 'Konsultasi Statistik', 'flag' => 1],
            ['id' => 32, 'nama' => 'Rekomendasi Kegiatan Statistik', 'flag' => 1],
        ]);
    }
}
