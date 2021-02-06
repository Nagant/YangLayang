<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Halaman Utama
Route::resource('/', 'HalamanUtamaController');
Route::get('/selesai', 'HalamanUtamaController@selesai')->name('selesai');

Auth::routes();
//Dashboard
Route::get('/admin/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/notifikasi', 'DashboardController@notifikasi')->name('notifikasi');
Route::get('/statistikpendaftar', 'DashboardController@statistikpendaftar')->name('statistikpendaftar');



Route::resource('/admin/halaman/pendaftar', 'PendaftarController');
Route::resource('/admin/halaman/petugas', 'PetugasController');
Route::resource('/admin/halaman/jadwal', 'JadwalController');
Route::resource('/admin/halaman/jenis', 'JenisController');
Route::resource('/admin/halaman/kategori', 'KategoriController');
Route::resource('/admin/halaman/lokasi', 'LokasiController');
Route::resource('/admin/halaman/pengaturanprofile', 'PengaturanProfileController');

