<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use Alert;

class KategoriController extends Controller
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
        //Menampilkan Data Dari Table Pengguna
        $datakategori = Kategori::all();
        //Ajax Untuk Menampilkan Data Dengan DataTables
        if(request()->ajax()){
            return datatables()->of($datakategori)
            ->addColumn('aksi', function ($datakategori) {
                return '<a id="btn-edit-kategori" href="#" class="btn btn-xs btn-primary btn-flat" data-toggle="modal" data-target="#edit"
                data-id="'.$datakategori->id.'"
                data-kategori_layangan="'.$datakategori->kategori_layangan.'"
                data-biaya="'.$datakategori->biaya.'">
                     <i class="far fa-edit"></i></a>
                <a href="#" id="btn-delete-kategori" class="btn btn-xs btn-danger btn-flat"
                data-remote="kategori/'.$datakategori->id.'"
                data-kategori_layangan="'.$datakategori->kategori_layangan.'">
                     <i class="fas fa-times"></i></a>';
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
        }
        //Menampilkan "View" Index untuk Petugas dan Mengirimkan Data
        return view('kategori.index',compact('datakategori'));
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
            'kategori_layangan' => 'required|string|unique:kategori,kategori_layangan',
            'biaya' => 'required|numeric',
        ]);


        //Memasukan Data ke Database dengan Nilai Yang Didapatkan dari Request
        Kategori::create([
            'kategori_layangan' => $request->input('kategori_layangan'),
            'biaya' => $request->input('biaya')
        ]);


        //Jika Berhasil Maka Akan Memunculkan Pesan Dan mengarahakn Ke 'jadwal.index'
        Alert::alert('Berhasil', 'Berhasil Menambahkan Kategori', 'success');
        return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Mendapatkan Data Berdasarkan ID yang didapatkan Dari Form "EDIT"
        $datakategori = Kategori::findOrFail($request->input('id'));

        //Validasi Masukan Data Dari Pengguna Apakah Memenuhi Kriteria Masukan Data
        $this->validate($request, [
            'biaya' => 'required|numeric',
            'kategori_layangan' => 'required|string|unique:kategori,kategori_layangan,'.$request->input('id'),
        ]);

        //Mengubah Data Pengguna dengan Data Baru
        $datakategori->kategori_layangan = $request->input('kategori_layangan');
        $datakategori->biaya = $request->input('biaya');


         //Melakukan Update Data
         $datakategori->update();

         //Mengirimkan Respon Jika Update Data Di Eksekusi
         if($datakategori){
             //Jika Berhaisl
             return response()->json(['status'=>'Data Kategori Berhasil Di Perbaharui.','ikon'=>'success','label'=>'Berhasil']);
         }else{
             //Jika Tidak
             return response()->json(['status'=>'Gagal Memperbaharui Data Kategori.','ikon'=>'error','label'=>'Kesalahan']);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapusdata = Kategori::find($id);
        $hapusdata->delete();
        if($hapusdata){
            //Jika Berhaisl
            return response()->json(['status'=>'Data Kategori Berhasil Di Hapus.','ikon'=>'success','label'=>'Berhasil']);
        }else{
            //Jika Tidak
            return response()->json(['status'=>'Gagal Menghapus Data Kategori.','ikon'=>'error','label'=>'Kesalahan']);
        }
    }
}
