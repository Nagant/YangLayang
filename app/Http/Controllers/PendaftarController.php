<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;
use App\Pendaftar;
use Alert;
use File;


class PendaftarController extends Controller
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
		 //Menampilkan Data Dari Table Pendaftar
         $datapendaftar = Pendaftar::with('kategori','jadwal','jenis')->get();

         //Ajax Untuk Menampilkan Data Dengan DataTables
         //Kondisi Jika Ada Request Melalui AJAX Tampilkan data pada DataTables
         if(request()->ajax()){
             return datatables()->of($datapendaftar)
             ->addColumn('aksi', function ($datapendaftar) {
                return '<a href="'.route('pendaftar.show', $datapendaftar->id).'" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-search"></i></a>';
                })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
         }

         //Menampilkan "View" Index untuk Pendaftar dan Mengirimkan Data
         return view('pendaftar.index',compact('datapendaftar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Menampilkan Data Dari Table Pendaftar
        $datapendaftar = Pendaftar::with('kategori', 'jadwal', 'jenis')->whereIn('id', [$id])->first();
        return view('pendaftar.show', compact('datapendaftar'));
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
    public function update(Request $request)
    {
        //Mendapatkan Data Berdasarkan ID yang didapatkan Dari Form "EDIT"
        $datapendaftar = Pendaftar::findOrFail($request->input('id'));

        $datapendaftar->status_pendaftar = $request->input('status_pendaftar');


         //Melakukan Update Data
         $datapendaftar->update();

         //Mengirimkan Respon Jika Update Data Di Eksekusi
         if($datapendaftar){
             //Jika Berhaisl
             return response()->json(['status'=>'Status Berhasil Diperbaharui.','ikon'=>'success','label'=>'Berhasil']);
         }else{
             //Jika Tidak
             return response()->json(['status'=>'Gagal Memperbaharui Status.','ikon'=>'error','label'=>'Kesalahan']);
         }

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
