<?php

use Illuminate\Database\Seeder;
use App\Pendaftar;

class PendaftarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pendaftar::insert([
            [
                'nama_seka_pendaftar'  => 'STT. Maju Kena Mundur Eits',
                'email_pendaftar'  => 'wkakwa@gmail.com',
                'alamat_pendaftar' => 'Br.Kulon',
                'kategori_layangan_pendaftar' => '1',
                'jenis_layangan_pendaftar'  => '1',
                'jadwal_pendaftar' => '1',
                'status_pendaftar' => '',
                'gambar_layangan_pendaftar' => 'gambar1.jpg|gambar2.jpg',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'nama_seka_pendaftar'  => 'STT. Maju Kena Mundur',
                'email_pendaftar'  => 'wkakwa2@gmail.com',
                'alamat_pendaftar' => 'Br.Kulon2',
                'kategori_layangan_pendaftar' => '1',
                'jenis_layangan_pendaftar'  => '1',
                'jadwal_pendaftar' => '1',
                'status_pendaftar' => 'ditolak',
                'gambar_layangan_pendaftar' => 'gambar1.jpg|gambar2.jpg',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'nama_seka_pendaftar'  => 'STT. Maju Kena',
                'email_pendaftar'  => 'wkakwa1@gmail.com',
                'alamat_pendaftar' => 'Br.Kulon1',
                'kategori_layangan_pendaftar' => '1',
                'jenis_layangan_pendaftar'  => '1',
                'jadwal_pendaftar' => '1',
                'status_pendaftar' => 'diterima',
                'gambar_layangan_pendaftar' => 'gambar1.jpg|gambar2.jpg',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
