<?php

use Illuminate\Database\Seeder;

class TabelBaru extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_layanan_kantor')->insert([
            ['id'=>1,'kode' => 1, 'inisial'=>'PG', 'nama' => 'Pengaduan'],
            ['id'=>2,'kode' => 2, 'inisial'=>'KL', 'nama' => 'Konsultasi'],
            ['id'=>3,'kode' => 3,  'inisial'=>'PW', 'nama' => 'Penawaran'],
            ['id'=>4,'kode' => 99, 'inisial'=>'LB', 'nama' => 'Lainnya'],
        ]);
    }
}
