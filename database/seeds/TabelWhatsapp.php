<?php

use Illuminate\Database\Seeder;

class TabelWhatsapp extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_wa_flag')->insert([
            ['id'=>1,'kode' => 1, 'nama' => 'Antrian'],
            ['id'=>2,'kode' => 2, 'nama' => 'Terkirim'],
            ['id'=>3,'kode' => 3, 'nama' => 'Gagal'],
        ]);
    }
}
