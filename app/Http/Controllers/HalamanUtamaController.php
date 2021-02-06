<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pendaftar;
use App\Jadwal;
use App\Kategori;
use App\Jenis;

class HalamanUtamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("halamanutama.halamanutama");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datajadwal = Jadwal::all();
        $datakategori = Kategori::all();
        $datajenis = Jenis::all();
        return view("halamanutama.pendaftaran",compact("datajadwal","datakategori","datajenis"));
    }

    public function selesai()
    {
        return view("halamanutama.selesai");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gambar = array();
        if ($files = $request->file('gambar_layangan_pendaftar')) {
            foreach($files as $x=>$file) {
                $ekstensi = $file->getClientOriginalExtension();
                $namafile = $request->input('nama_seka_pendaftar'). $x . '.' . $ekstensi;
                $file->storeAs('images/layangan_pendaftar', $namafile);
                $gambar[] = $namafile;
            }
        }


        //Validasi Masukan Data Dari Pengguna Apakah Memenuhi Kriteria Masukan Data
        $this->validate($request, [
            'nama_seka_pendaftar' => 'required|string|min:6|max:255|unique:pendaftar,nama_seka_pendaftar',
            'email_pendaftar' => 'required|email|unique:pendaftar,email_pendaftar',
            'alamat_pendaftar' => 'required|string',
            'kategori_layangan_pendaftar' => 'required',
            'jenis_layangan_pendaftar' => 'required',
            'jadwal_pendaftar' => 'required',
            'gambar_layangan_pendaftar' => 'required',
            'gambar_layangan_pendaftar.*' => 'image|mimes:jpeg,jpg|max:2048'
        ]);


        //Memasukan Data ke Database dengan Nilai Yang Didapatkan dari Request
        Pendaftar::create([
            'nama_seka_pendaftar' => $request->input('nama_seka_pendaftar'),
            'email_pendaftar' => $request->input('email_pendaftar'),
            'alamat_pendaftar' => $request->input('alamat_pendaftar'),
            'kategori_layangan_pendaftar' => $request->input('kategori_layangan_pendaftar'),
            'jenis_layangan_pendaftar' => $request->input('jenis_layangan_pendaftar'),
            'jadwal_pendaftar' => $request->input('jadwal_pendaftar'),
            'gambar_layangan_pendaftar' => implode("|",$gambar),
        ]);


        //Jika Berhasil Maka Akan Memunculkan Pesan Dan mengarahakn Ke 'jadwal.index'
        return redirect()->route('selesai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
