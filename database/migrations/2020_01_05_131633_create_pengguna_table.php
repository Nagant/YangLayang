<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name_pengguna');
    $table->string('email_pengguna')->unique();
    $table->string('username_pengguna', 20)->unique();
    $table->timestamp('email_tgl_verifikasi_pengguna')->nullable();
    $table->string('password');
    $table->string('photo_pengguna');
    $table->rememberToken();
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
        Schema::dropIfExists('pengguna');
    }
}
