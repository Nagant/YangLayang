<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;
use App\Lokasi;
use Alert;

class JadwalController extends Controller
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
        $datajadwal = Jadwal::with('lokasi')->get();

        //Menampilkan Data Dari Table Lokasi
        $datalokasi = Lokasi::all();


        //Ajax Untuk Menampilkan Data Dengan DataTables
        if(request()->ajax()){
            return datatables()->of($datajadwal)
            ->addColumn('aksi', function ($datajadwal) {
                return '<a id="btn-edit-jadwal" href="#" class="btn btn-xs btn-primary btn-flat" data-toggle="modal" data-target="#edit"
                data-id="'.$datajadwal->id.'"
                data-hari_jadwal="'.$datajadwal->hari_jadwal.'"
                data-tanggal_jadwal="'.$datajadwal->tanggal_jadwal.'"
                data-waktu_jadwal="'.$datajadwal->waktu_jadwal.'"
                data-id_lokasi="'.$datajadwal->id_lokasi.'">
                    <i class="far fa-edit"></i></a> 
                <a href="#" id="btn-delete-jadwal" class="btn btn-xs btn-danger btn-flat"
                data-remote="jadwal/'.$datajadwal->id.'"
                data-tanggal_jadwal="'.$datajadwal->tanggal_jadwal.'">
                    <i class="fas fa-times"></i></a>';
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
        }
        //Menampilkan "View" Index untuk Petugas dan Mengirimkan Data
        return view('jadwal.index',compact('datajadwal','datalokasi'));
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
            'hari_jadwal' => 'required',
            'tanggal_jadwal' => 'required|date|',
            'waktu_jadwal' => 'required',
            'id_lokasi' => 'required',
        ]);


        //Memasukan Data ke Database dengan Nilai Yang Didapatkan dari Request
        Jadwal::create([
            'hari_jadwal' => $request->input('hari_jadwal'),
            'tanggal_jadwal' => date('Y-m-d', strtotime($request->input('tanggal_jadwal'))),
            'waktu_jadwal' => $request->input('waktu_jadwal'),
            'id_lokasi' => $request->input('id_lokasi')
        ]);


        //Jika Berhasil Maka Akan Memunculkan Pesan Dan mengarahakn Ke 'jadwal.index'
        Alert::alert('Berhasil', 'Berhasil Menambahkan Jadwal', 'success');
        return redirect()->route('jadwal.index');
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
    public function update(Request $request)
    {
        //Mendapatkan Data Berdasarkan ID yang didapatkan Dari Form "EDIT"
        $datajadwal = Jadwal::findOrFail($request->input('id'));

        //Validasi Masukan Data Dari Pengguna Apakah Memenuhi Kriteria Masukan Data
        $this->validate($request, [
            'hari_jadwal' => 'required',
            'tanggal_jadwal' => 'required|date',
            'waktu_jadwal' => 'required',
            'id_lokasi' => 'required',
        ]);


        //Mengubah Data Pengguna dengan Data Baru
        $datajadwal->hari_jadwal            = $request->input('hari_jadwal');
        $datajadwal->tanggal_jadwal         = date('Y-m-d', strtotime($request->input('tanggal_jadwal')));
        $datajadwal->waktu_jadwal           = $request->input('waktu_jadwal');
        $datajadwal->id_lokasi              = $request->input('id_lokasi');

         //Melakukan Update Data
         $datajadwal->update();

         //Mengirimkan Respon Jika Update Data Di Eksekusi
         if($datajadwal){
             //Jika Berhaisl
             return response()->json(['status'=>'Data Jadwal Berhasil Di Perbaharui.','ikon'=>'success','label'=>'Berhasil']);
         }else{
             //Jika Tidak
             return response()->json(['status'=>'Gagal Memperbaharui Data Jadwal.','ikon'=>'error','label'=>'Kesalahan']);
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
        $hapusdata = Jadwal::find($id);
        $hapusdata->delete();
        if($hapusdata){
            //Jika Berhaisl
            return response()->json(['status'=>'Data Jadwal Berhasil Di Hapus.','ikon'=>'success','label'=>'Berhasil']);
        }else{
            //Jika Tidak
            return response()->json(['status'=>'Gagal Menghapus Data Jadwal.','ikon'=>'error','label'=>'Kesalahan']);
        }
    }
}
