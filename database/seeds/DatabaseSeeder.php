<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PenggunaSeeder::class);
        $this->call(LokasiSeeder::class);
        $this->call(JadwalSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(JenisSeeder::class);
        $this->call(PendaftarSeeder::class);
        
    }
}
