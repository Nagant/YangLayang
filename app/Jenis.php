<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Jenis;

class Jenis extends Model
{
    protected $table = "jenis";

    protected $fillable = ['jenis_layangan'];

    public function pendaftar(){
        return $this->belongsTo(Pendaftar::class);
    }
}
