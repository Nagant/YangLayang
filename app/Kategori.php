<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Jenis;

class Kategori extends Model
{
    protected $table = "kategori";

    protected $fillable = [
        'kategori_layangan', 'biaya'
    ];

    public function pendaftar(){
        return $this->belongsTo(Pendaftar::class);
    }
}
