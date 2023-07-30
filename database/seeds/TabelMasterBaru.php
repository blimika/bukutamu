<?php

use Illuminate\Database\Seeder;

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
            ['id'=>3,'kode' => 20, 'nama' => 'Admin'],
        ]);
        DB::table('msaluran')->insert([
            ['id'=>1,'kode' => 0, 'nama' => 'Kantor'],
            ['id'=>2,'kode' => 1, 'nama' => 'PST'],
            ['id'=>3,'kode' => 2, 'nama' => 'Pojok Statistik'],
            ['id'=>4,'kode' => 3, 'nama' => 'E-Mail'],
            ['id'=>5,'kode' => 4, 'nama' => 'Whatsapp'],
            ['id'=>6,'kode' => 5, 'nama' => 'Telepon'],
        ]);
    }
}
