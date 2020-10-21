<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //Insert User
        DB::table('users')->insert([
            ['name' => 'Admin Bukutamu','username'=>'admin', 'email' => 'admin@bpsntb.id', 'password' => bcrypt('1'), 'level' => '20'],
        ]);
        //Insert layanan
        DB::table('mlayanan')->insert([
            ['id' => 1, 'nama' => 'Pustaka Tercetak', 'flag' => 1],
            ['id' => 2, 'nama' => 'Pustaka Digital', 'flag' => 1],
            ['id' => 4, 'nama' => 'Penjualan Publikasi', 'flag' => 1],
            ['id' => 8, 'nama' => 'Data Mikro', 'flag' => 1],
            ['id' => 16, 'nama' => 'Konsultasi Statistik', 'flag' => 1],
            ['id' => 32, 'nama' => 'Rekomendasi Kegiatan Statistik', 'flag' => 1],
        ]);
        
        //jenis kelamin
        DB::table('mjk')->insert([
            ['id' => 1, 'nama' => 'Laki-Laki', 'inisial'=>'L', 'flag' => 1],
            ['id' => 2, 'nama' => 'Perempuan', 'inisial'=>'P', 'flag' => 1],
        ]);
        
        //Insert Pendidikan
        DB::table('mpendidikan')->insert([
            ['id' => 1, 'nama' => '<= SLTA', 'flag' => 1],
            ['id' => 2, 'nama' => 'D1/D2/D3', 'flag' => 1],
            ['id' => 3, 'nama' => 'D4/S1', 'flag' => 1],
            ['id' => 4, 'nama' => 'S2', 'flag' => 1],
            ['id' => 5, 'nama' => 'S3', 'flag' => 1],
        ]);

        //Insert Pekerjaan
        DB::table('mpekerjaan')->insert([
            ['id' => 1, 'nama' => 'Pelajar/Mahasiswa', 'flag' => 1],
            ['id' => 2, 'nama' => 'Peneliti/Dosen', 'flag' => 1],
            ['id' => 3, 'nama' => 'PNS/TNI/POLRI', 'flag' => 1],
            ['id' => 4, 'nama' => 'Pegawai BUMN/D', 'flag' => 1],
            ['id' => 5, 'nama' => 'Pegawai Swasta', 'flag' => 1],
            ['id' => 6, 'nama' => 'Wiraswasta', 'flag' => 1],
            ['id' => 7, 'nama' => 'Lainnya', 'flag' => 1],
        ]);

        //Insert Kategori Pekerjaan
        DB::table('mkat_pekerjaan')->insert([
            ['id' => 1, 'nama' => 'Lembaga Pendidikan & Penelitian Dalam Negeri', 'flag' => 1],
            ['id' => 2, 'nama' => 'Lembaga Pendidikan & Penelitian Luar Negeri', 'flag' => 1],
            ['id' => 3, 'nama' => 'Kementerian & Lembaga Pemerintah', 'flag' => 1],
            ['id' => 4, 'nama' => 'Lembaga Internasional', 'flag' => 1],
            ['id' => 5, 'nama' => 'Media Massa', 'flag' => 1],
            ['id' => 6, 'nama' => 'Pemerintah Daerah', 'flag' => 1],
            ['id' => 7, 'nama' => 'Perbankan', 'flag' => 1],
            ['id' => 8, 'nama' => 'BUMN/BUMD', 'flag' => 1],
            ['id' => 9, 'nama' => 'Swasta Lainnya', 'flag' => 1],
            ['id' => 10, 'nama' => 'Lainnya', 'flag' => 1],
        ]);

        //Insert Kewarganegaraan
        DB::table('mwarga')->insert([
            ['id' => 1, 'nama' => 'Indonesia', 'flag' => 1],
            ['id' => 2, 'nama' => 'Jepang', 'flag' => 1],
            ['id' => 3, 'nama' => 'Amerika Serikat', 'flag' => 1],
            ['id' => 4, 'nama' => 'Malaysia', 'flag' => 1],
            ['id' => 5, 'nama' => 'Australia', 'flag' => 1],
            ['id' => 6, 'nama' => 'Cina', 'flag' => 1],
            ['id' => 7, 'nama' => 'India', 'flag' => 1],
            ['id' => 8, 'nama' => 'Lainnya', 'flag' => 1],
        ]);

        //Insert Manfaat Kunjungan
        DB::table('mkunjungan')->insert([
            ['id' => 1, 'nama' => 'Tugas Sekolah/Kuliah', 'flag' => 1],
            ['id' => 2, 'nama' => 'Skripsi/Tesis/Disertasi', 'flag' => 1],
            ['id' => 4, 'nama' => 'Penelitian', 'flag' => 1],
            ['id' => 8, 'nama' => 'Perencanaan', 'flag' => 1],
            ['id' => 16, 'nama' => 'Evaluasi', 'flag' => 1],
            ['id' => 32, 'nama' => 'Lainnya', 'flag' => 1],
        ]);
        //Insert Master Identitas
        DB::table('midentitas')->insert([
            ['id' => 1, 'nama' => 'Kartu Pelajar/Mahasiswa', 'flag' => 1],
            ['id' => 2, 'nama' => 'KTP', 'flag' => 1],
            ['id' => 3, 'nama' => 'SIM', 'flag' => 1],
            ['id' => 4, 'nama' => 'Paspor', 'flag' => 1],
            ['id' => 99, 'nama' => 'Lainnya', 'flag' => 1],
        ]);
        //Insert Master Fasilitas Utama
        DB::table('mfasilitas')->insert([
            ['id' => 1, 'nama' => 'Website BPS', 'flag' => 1],
            ['id' => 2, 'nama' => 'Allstats BPS (aplikasi android dan iOS)', 'flag' => 1],
            ['id' => 3, 'nama' => 'Silastik (silastik.bps.go.id)', 'flag' => 1],
            ['id' => 4, 'nama' => 'Sirusa (sirusa.bps.go.id)', 'flag' => 1],
            ['id' => 5, 'nama' => 'Romantik Online (romantik.bps.go.id)', 'flag' => 1],
            ['id' => 6, 'nama' => 'Telepon/Faksimile', 'flag' => 1],
            ['id' => 7, 'nama' => 'E-mail/Surat', 'flag' => 1],
            ['id' => 8, 'nama' => 'Data langsung ke PST', 'flag' => 1],
            ['id' => 9, 'nama' => 'Lainnya', 'flag' => 1],
        ]);
    }
}
