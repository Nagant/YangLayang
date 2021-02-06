<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hari_jadwal');
            $table->date('tanggal_jadwal');
            $table->time('waktu_jadwal');
            $table->integer('id_lokasi')->unsigned();
            $table->timestamps();
            $table->foreign('id_lokasi')->references('id')->on('lokasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
}
