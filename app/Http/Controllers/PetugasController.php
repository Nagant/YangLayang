<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengguna;
use Alert;
use File;
use Hash;
use Auth;

class PetugasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        //Menampilkan Data Dari Table Pengguna
        $datapetugas = Pengguna::whereNotIn('name_pengguna',['nama_pengguna' => $user->name_pengguna])->get();
        //Ajax Untuk Menampilkan Data Dengan DataTables
        if(request()->ajax()){
            return datatables()->of($datapetugas)
            ->addColumn('photo', function($datapetugas) {
                return '
                <figure class="avatar mr-2 avatar">
                    <img src='.asset('images/profile/'.$datapetugas->photo_pengguna).'>
                </figure>';
            })
            ->addColumn('aksi', function ($datapetugas) {
                return '<a id="btn-edit-petugas" href="#" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#edit"
                data-id="'.$datapetugas->id.'"
                data-name_pengguna="'.$datapetugas->name_pengguna.'"
                data-email_pengguna="'.$datapetugas->email_pengguna.'"
                data-username_pengguna="'.$datapetugas->username_pengguna.'"
                data-photo_pengguna="'.$datapetugas->photo_pengguna.'">
                    <i class="far fa-edit"></i></a> 
                <a href="#" id="btn-delete-petugas" class="btn btn-icon btn-danger"
                data-remote="petugas/'.$datapetugas->id.'"
                data-nama="'.$datapetugas->name_pengguna.'">
                    <i class="fas fa-times"></i></a>';
            })
            ->rawColumns(['aksi','photo'])
            ->addIndexColumn()
            ->make(true);
        }
        //Menampilkan "View" Index untuk Petugas dan Mengirimkan Data
        return view('petugas.index',compact('datapetugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        //Validasi Masukan Data Dari Pengguna Apakah Memenuhi Kriteria Masukan Data
        $this->validate($request, [
            'name_pengguna' => 'required|string|min:5|max:255|unique:pengguna,name_pengguna,'.$request->input('id'),
            'username_pengguna' => 'required|string|max:20|unique:pengguna,username_pengguna,'.$request->input('id'),
            'email_pengguna' => 'required|string|email|max:255|unique:pengguna,email_pengguna,'.$request->input('id'),
            'password' => 'required|confirmed|string|min:6',
            'password_confirmation' => 'required|min:6',
            'photo_pengguna' => 'image|max:3000',
        ]);


        //Perkondisian Jika Pengguna Menambahkan Foto
        if($request->file('photo_pengguna') == '') {
            $gambar = 'user-1570769297.jpg'; //Set Gambar Default, Jika Pengguna Tidak Mengupload Gambar
        } elseif($request->file('photo_pengguna')->getClientOriginalExtension() != 'jpg') {
            //Kondisi Jika Foto Tidak Berformat JPG
            Alert::alert('Kesalahan', 'Hanya Gambar Dengan Format ".jpg" Yang Di Perbolehkan', 'error');
            return redirect()->route('petugas.index');
        }else{
            //Memindahkan File Photo Dan Mengganti Nama Sesuai Dengan Username yang Dimasukan
            $file = $request->file('photo_pengguna');
            $ekstensi  = $file->getClientOriginalExtension();
            $namafile = $request->input('username_pengguna').'.'.$ekstensi; 
            $request->file('photo_pengguna')->storeAs("images/profile", $namafile);
            $gambar = $namafile;
        }


        //Memasukan Data ke Database dengan Nilai Yang Didapatkan dari Request
        Pengguna::create([
            'name_pengguna' => $request->input('name_pengguna'),
            'username_pengguna' => $request->input('username_pengguna'),
            'email_pengguna' => $request->input('email_pengguna'),
            'password' => bcrypt(($request->input('password'))),
            'photo_pengguna' => $gambar
        ]);


        //Jika Berhasil Maka Akan Memunculkan Pesan Dan mengarahakn Ke 'petugas.index'
        Alert::alert('Berhasil', 'Berhasil Menambahkan Petugas', 'success');
        return redirect()->route('petugas.index');
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        //Mendapatkan Data Berdasarkan ID yang didapatkan Dari Form "EDIT"
        $datapengguna = Pengguna::findOrFail($request->input('id'));

        if(!Hash::check($request->input('konfirmasi_pengubahan'),$datapengguna->password)){
            return response()->json(['status'=>'Password Konfrimasi Yang Di Masukan Salah!','ikon'=>'error','label'=>'Kesalahan Password Konfirmasi']);
        }

        //Validasi Masukan Data Dari Pengguna Apakah Memenuhi Kriteria Masukan Data
        $this->validate($request, [
            'name_pengguna' => 'required|string|min:5|max:255|unique:pengguna,name_pengguna,'.$request->input('id'),
            'username_pengguna' => 'required|string|max:20|unique:pengguna,username_pengguna,'.$request->input('id'),
            'email_pengguna' => 'required|string|email|max:255|unique:pengguna,email_pengguna,'.$request->input('id'),
            'photo_pengguna' => 'image|max:3000',
        ]);


        //Jika User Memasukan Gambar, Photo Lama Akan Diganti
        if($request->file('photo_pengguna')->getClientOriginalExtension() != 'jpg') {
            //Kondisi Jika Foto Tidak Berformat JPG
            return response()->json(['status' => 'Hanya Gambar Dengan Format ".jpg" Yang Di Perbolehkan.', 'ikon' => 'error', 'label' => 'Kesalahan']);
        }elseif($request->file('photo_pengguna')){
            File::delete('images/profile/'.$request->file('photo_pengguna')); //Menghapus Photo Lama Dan Mengganti Dengan Yang Baru
            $file = $request->file('photo_pengguna'); //Mendapatkan Dan Menyimpan File Photo Dan disimpan pada variable $file
            $ekstensi  = $file->getClientOriginalExtension(); //Mendapatkan Ekstensi file data dari variable $file
            $namafile = $request->input('username_pengguna').'.'.$ekstensi; //Merubah Nama file original dengan yang baru dengan username yang dimasukan (username.extensi,contoh made.jpg)
            $request->file('photo_pengguna')->storeAs("images/profile", $namafile); //Memindahakan file ke lokasi folder public/images/profile
            $datapengguna->photo_pengguna = $namafile; //Update Photo pengguna dengan nama file yang sudah dibuat diatas
        }

        //Mengubah Data Pengguna dengan Data Baru
        $datapengguna->name_pengguna        = $request->input('name_pengguna');
        $datapengguna->email_pengguna       = $request->input('email_pengguna');
        $datapengguna->username_pengguna    = $request->input('username_pengguna');
        

        //Perkondisian Jika Pengguna Mengubah Password dan akan Dienkripsi Menggunakan "BCrypt"
        if($request->input('password')) {
            $datapengguna->password = bcrypt($request->input('password'));
        }
    
        //Melakukan Update Data
        $datapengguna->update();

        //Mengirimkan Respon Jika Update Data Di Eksekusi
        if($datapengguna){
            //Jika Berhaisl
            return response()->json(['status'=>'Data Petugas Berhasil Di Perbaharui.','ikon'=>'success','label'=>'Berhasil']);
        }else{
            //Jika Tidak
            return response()->json(['status'=>'Gagal Memperbaharui Data Petugas.','ikon'=>'error','label'=>'Kesalahan']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $hapusdata = Pengguna::find($id);

        if(!Hash::check($request->input('password'),$hapusdata->password)){
            return response()->json(['status'=>'Password Konfrimasi Yang Di Masukan Salah!','ikon'=>'error','label'=>'Kesalahan']);
        }else{
            File::delete('images/profile/' . $hapusdata->photo_pengguna);

            $hapusdata->delete();
            if($hapusdata){
                //Jika Berhaisl
                return response()->json(['status'=>'Data Petugas Berhasil Di Hapus.','ikon'=>'success','label'=>'Berhasil']);
            }else{
                //Jika Tidak
                return response()->json(['status'=>'Gagal Menghapus Data Petugas.','ikon'=>'error','label'=>'Kesalahan']);
            }
        }
    }
}
