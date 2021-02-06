<?php

use Illuminate\Database\Seeder;
use App\Jadwal;


class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jadwal::create([
            'hari_jadwal'  => 'Senin',
            'tanggal_jadwal'  => '1998-02-11',
            'waktu_jadwal' => '09:00',
            'id_lokasi' => '1'
         ]);
    }
}
