<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jalan_lokasi');
            $table->string('tempat_lokasi')->unique();
            $table->string('kecamatan_lokasi');
            $table->string('kabupaten_lokasi');
            $table->string('lat_lokasi');
            $table->string('lng_lokasi');
            $table->string('link_lokasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lokasi');
    }
}
