<?php

use Illuminate\Database\Seeder;
use App\Lokasi;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Lokasi::create([
            'jalan_lokasi'  => 'Jl. Raya Denpasar',
            'tempat_lokasi' => 'Denpasar Kite Festival',
            'kecamatan_lokasi' => 'Abiansemal',
            'kabupaten_lokasi' => 'Badung',
            'lat_lokasi' => '0',
            'lng_lokasi' => '0',
            'link_lokasi' => 'https: //www.google.com.sg/maps/place/Jl.+Raya+Denpasar,+Abiansemal,+Kec.+Abiansemal,+Kabupaten+Badung,+Bali+80352/data=!4m2!3m1!1s0x2dd23c5e1c18958b:0x7d1079d88a2f2ca?sa=X&ved=2ahUKEwjSkP-Y1uzmAhVRIbcAHVdtD7QQ8gEwAHoECAsQAQ'
         ]);
    }
}
