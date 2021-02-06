<?php

namespace App\Http\Controllers;

use App\Jenis;
use Illuminate\Http\Request;
use Alert;

class JenisController extends Controller
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
        $datajenis = Jenis::all();
        //Ajax Untuk Menampilkan Data Dengan DataTables
        if(request()->ajax()){
            return datatables()->of($datajenis)
            ->addColumn('aksi', function ($datajenis) {
                return '<a id="btn-edit-jenis" href="#" class="btn btn-xs btn-primary btn-flat" data-toggle="modal" data-target="#edit"
                data-id="'.$datajenis->id.'"
                data-jenis_layangan="'.$datajenis->jenis_layangan.'">
                     <i class="far fa-edit"></i></a>
                <a href="#" id="btn-delete-jenis" class="btn btn-xs btn-danger btn-flat"
                data-remote="jenis/'.$datajenis->id.'"
                data-jenis_layangan="'.$datajenis->jenis_layangan.'">
                     <i class="fas fa-times"></i></a>';
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
        }
        //Menampilkan "View" Index untuk Petugas dan Mengirimkan Data
        return view('jenis.index',compact('datajenis'));
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
            'jenis_layangan' => 'required|string|unique:jenis,jenis_layangan',
        ]);


        //Memasukan Data ke Database dengan Nilai Yang Didapatkan dari Request
        Jenis::create([
            'jenis_layangan' => $request->input('jenis_layangan')
        ]);


        //Jika Berhasil Maka Akan Memunculkan Pesan Dan mengarahakn Ke 'jadwal.index'
        Alert::alert('Berhasil', 'Berhasil Menambahkan Jenis', 'success');
        return redirect()->route('jenis.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function show(Jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function edit(Jenis $jenis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Mendapatkan Data Berdasarkan ID yang didapatkan Dari Form "EDIT"
        $datajenis = Jenis::findOrFail($request->input('id'));

        //Validasi Masukan Data Dari Pengguna Apakah Memenuhi Kriteria Masukan Data
        $this->validate($request, [
            'jenis_layangan' => 'required|string|unique:jenis,jenis_layangan,'.$request->input('id'),
        ]);

        //Mengubah Data Pengguna dengan Data Baru
        $datajenis->jenis_layangan            = $request->input('jenis_layangan');

         //Melakukan Update Data
         $datajenis->update();

         //Mengirimkan Respon Jika Update Data Di Eksekusi
         if($datajenis){
             //Jika Berhaisl
             return response()->json(['status'=>'Data Jenis Berhasil Di Perbaharui.','ikon'=>'success','label'=>'Berhasil']);
         }else{
             //Jika Tidak
             return response()->json(['status'=>'Gagal Memperbaharui Data Jenis.','ikon'=>'error','label'=>'Kesalahan']);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapusdata = Jenis::find($id);
        $hapusdata->delete();
        if($hapusdata){
            //Jika Berhaisl
            return response()->json(['status'=>'Data Jenis Berhasil Di Hapus.','ikon'=>'success','label'=>'Berhasil']);
        }else{
            //Jika Tidak
            return response()->json(['status'=>'Gagal Menghapus Data Jenis.','ikon'=>'error','label'=>'Kesalahan']);
        }
    }
}
