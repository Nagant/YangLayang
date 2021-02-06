<?php

use Illuminate\Database\Seeder;
use App\Pengguna;


class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengguna::create([
            'name_pengguna'  => 'Rai Saputra',
            'username_pengguna'  => 'raisa',
            'email_pengguna' => 'raisaputra' . '@rameses.com',
            'password'  => bcrypt('1234'),
            'photo_pengguna' => 'user-1570769297.jpg'
    ]);
    }
}
