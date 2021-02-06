<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Jadwal;
use App\Pendaftar;

class Lokasi extends Model
{
    protected $table = "lokasi";

    protected $fillable = [
        'jalan_lokasi', 'tempat_lokasi', 'kecamatan_lokasi', 'kabupaten_lokasi', 'lat_lokasi', 'lng_lokasi', 'link_lokasi'
    ];

    public function jadwal(){
        return $this->belongsTo(Jadwal::class);
    }

    public function pendaftar(){
        return $this->belongsTo(Pendaftar::class);
    }
}
