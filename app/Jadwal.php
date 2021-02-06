<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lokasi;

class Jadwal extends Model
{
    protected $table = "jadwal";

    protected $fillable = [
        'hari_jadwal', 'tanggal_jadwal', 'waktu_jadwal', 'id_lokasi'
    ];

    public function lokasi(){
        return $this->hasOne(Lokasi::class,'id','id_lokasi');
    }
}
