<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kategori;
use App\Jenis;
use App\Jadwal;


class Pendaftar extends Model
{
    protected $table = "pendaftar";

    protected $fillable = [
        'nama_seka_pendaftar', 'email_pendaftar', 'alamat_pendaftar', 'kategori_layangan_pendaftar', 'jenis_layangan_pendaftar','jadwal_pendaftar','status_pendaftar','gambar_layangan_pendaftar'
    ];

    public function kategori(){
        return $this->hasOne(Kategori::class,'id','kategori_layangan_pendaftar');
    }

    public function jenis(){
        return $this->hasOne(Jenis::class,'id','jenis_layangan_pendaftar');
    }

    public function jadwal(){
        return $this->hasOne(Jadwal::class,'id','jadwal_pendaftar');
    }

}
