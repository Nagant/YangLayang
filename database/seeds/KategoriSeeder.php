<?php

use Illuminate\Database\Seeder;
use App\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Kategori::create([
            'kategori_layangan'  => 'Bebean',
            'biaya' => 100000
         ]);
    }
}
