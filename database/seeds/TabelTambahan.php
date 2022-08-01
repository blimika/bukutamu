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
        //Insert Jenis Kunjungan
        DB::table('mjkunjungan')->insert([
            ['id' => 1, 'nama' => 'Perorangan', 'flag' => 1],
            ['id' => 2, 'nama' => 'Kelompok', 'flag' => 1],
        ]);
        DB::table('bulan')->insert([
            ['id' => 1, 'nama_bulan_pendek' => 'Jan', 'nama_bulan' => 'Januari'],
            ['id' => 2, 'nama_bulan_pendek' => 'Feb', 'nama_bulan' => 'Februari'],
            ['id' => 3, 'nama_bulan_pendek' => 'Mar', 'nama_bulan' => 'Maret'],
            ['id' => 4, 'nama_bulan_pendek' => 'Apr', 'nama_bulan' => 'April'],
            ['id' => 5, 'nama_bulan_pendek' => 'Mei', 'nama_bulan' => 'Mei'],
            ['id' => 6, 'nama_bulan_pendek' => 'Jun', 'nama_bulan' => 'Juni'],
            ['id' => 7, 'nama_bulan_pendek' => 'Jul', 'nama_bulan' => 'Juli'],
            ['id' => 8, 'nama_bulan_pendek' => 'Agu', 'nama_bulan' => 'Agustus'],
            ['id' => 9, 'nama_bulan_pendek' => 'Sep', 'nama_bulan' => 'September'],
            ['id' => 10, 'nama_bulan_pendek' => 'Okt', 'nama_bulan' => 'Oktober'],
            ['id' => 11, 'nama_bulan_pendek' => 'Nov', 'nama_bulan' => 'November'],
            ['id' => 12, 'nama_bulan_pendek' => 'Des', 'nama_bulan' => 'Desember'],
        ]);
        DB::table('mtujuan')->insert([
            ['id'=>1,'kode' => 0, 'nama_pendek' => 'Kantor', 'nama' => 'Kantor'],
            ['id'=>2,'kode' => 1, 'nama_pendek' => 'PST', 'nama' => 'Pelayanan Statistik Terpadu'],
        ]);
    }
}
