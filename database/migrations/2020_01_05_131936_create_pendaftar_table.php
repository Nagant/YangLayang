<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_seka_pendaftar')->unique();
            $table->string('email_pendaftar')->unique();
            $table->text('alamat_pendaftar');
            $table->integer('kategori_layangan_pendaftar')->unsigned();
            $table->foreign('kategori_layangan_pendaftar')->references('id')->on('kategori')->onDelete('cascade');
            $table->integer('jenis_layangan_pendaftar')->unsigned();
            $table->foreign('jenis_layangan_pendaftar')->references('id')->on('jenis')->onDelete('cascade');
            $table->integer('jadwal_pendaftar')->unsigned();
            $table->foreign('jadwal_pendaftar')->references('id')->on('jadwal')->onDelete('cascade');
            $table->string('status_pendaftar')->default('');
            $table->string('gambar_layangan_pendaftar');
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
        Schema::dropIfExists('pendaftar');
    }
}
