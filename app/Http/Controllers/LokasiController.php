<?php

namespace App\Http\Controllers;

use App\Lokasi;
use Illuminate\Http\Request;
use Alert;

class LokasiController extends Controller
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
        $datalokasi = Lokasi::all();
        //Ajax Untuk Menampilkan Data Dengan DataTables
        if(request()->ajax()){
            return datatables()->of($datalokasi)
            ->addColumn('aksi', function ($datalokasi) {
                return '<a id="btn-edit-lokasi" href="#" class="btn btn-xs btn-primary btn-flat" data-toggle="modal" data-target="#edit"
                data-id="'.$datalokasi->id.'"
                data-jalan_lokasi="'.$datalokasi->jalan_lokasi.'"
                data-tempat_lokasi="'.$datalokasi->tempat_lokasi.'"
                data-kecamatan_lokasi="'.$datalokasi->kecamatan_lokasi.'"
                data-lat_lokasi="'.$datalokasi->lat_lokasi.'"
                data-lng_lokasi="'.$datalokasi->lng_lokasi.'"
                data-link_lokasi="'.$datalokasi->link_lokasi.'"
                data-kabupaten_lokasi="'.$datalokasi->kabupaten_lokasi.'">
                     <i class="far fa-edit"></i></a>
                <a href="#" id="btn-delete-lokasi" class="btn btn-xs btn-danger btn-flat"
                data-remote="lokasi/'.$datalokasi->id.'"
                data-tempat_lokasi="'.$datalokasi->tempat_lokasi.'">
                     <i class="fas fa-times"></i></a>';
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
        }
        //Menampilkan "View" Index untuk Petugas dan Mengirimkan Data
        return view('lokasi.index',compact('datalokasi'));
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
            'jalan_lokasi' => 'required|string|min:6|max:255',
            'tempat_lokasi' => 'required|string|min:6|unique:lokasi,tempat_lokasi',
            'kecamatan_lokasi' => 'required|string',
            'kabupaten_lokasi' => 'required|string',
            'lat_lokasi' => ['required','regex:/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/'],
            'lng_lokasi' => ['required','regex:/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,6}$/'],
            'link_lokasi' => 'required|url',
        ]);


        //Memasukan Data ke Database dengan Nilai Yang Didapatkan dari Request
        Lokasi::create([
            'jalan_lokasi' => $request->input('jalan_lokasi'),
            'tempat_lokasi' => $request->input('tempat_lokasi'),
            'kecamatan_lokasi' => $request->input('kecamatan_lokasi'),
            'kabupaten_lokasi' => $request->input('kabupaten_lokasi'),
            'lat_lokasi' => $request->input('lat_lokasi'),
            'lng_lokasi' => $request->input('lng_lokasi'),
            'link_lokasi' => $request->input('link_lokasi')
        ]);


        //Jika Berhasil Maka Akan Memunculkan Pesan Dan mengarahakn Ke 'jadwal.index'
        Alert::alert('Berhasil', 'Berhasil Menambahkan Lokasi', 'success');
        return redirect()->route('lokasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Lokasi $lokasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Mendapatkan Data Berdasarkan ID yang didapatkan Dari Form "EDIT"
        $datalokasi = Lokasi::findOrFail($request->input('id'));

        //Validasi Masukan Data Dari Pengguna Apakah Memenuhi Kriteria Masukan Data
        $this->validate($request, [
            'jalan_lokasi' => 'required|string|min:6|max:255',
            'tempat_lokasi' => 'required|string|min:6||unique:lokasi,tempat_lokasi,'.$request->input('id'),
            'kecamatan_lokasi' => 'required|string',
            'kabupaten_lokasi' => 'required|string',
            'lat_lokasi' => ['required','regex:/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/'],
            'lng_lokasi' => ['required','regex:/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,6}$/'],
            'link_lokasi' => 'required|url',
        ]);

        //Mengubah Data Pengguna dengan Data Baru
        $datalokasi->jalan_lokasi = $request->input('jalan_lokasi');
        $datalokasi->tempat_lokasi = $request->input('tempat_lokasi');
        $datalokasi->kecamatan_lokasi = $request->input('kecamatan_lokasi');
        $datalokasi->kabupaten_lokasi = $request->input('kabupaten_lokasi');
        $datalokasi->lat_lokasi = $request->input('lat_lokasi');
        $datalokasi->lng_lokasi = $request->input('lng_lokasi');
        $datalokasi->link_lokasi = $request->input('link_lokasi');



         //Melakukan Update Data
         $datalokasi->update();

         //Mengirimkan Respon Jika Update Data Di Eksekusi
         if($datalokasi){
             //Jika Berhaisl
             return response()->json(['status'=>'Data Lokasi Berhasil Di Perbaharui.','ikon'=>'success','label'=>'Berhasil']);
         }else{
             //Jika Tidak
             return response()->json(['status'=>'Gagal Memperbaharui Data Lokasi.','ikon'=>'error','label'=>'Kesalahan']);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapusdata = Lokasi::find($id);
        $hapusdata->delete();
        if($hapusdata){
            //Jika Berhaisl
            return response()->json(['status'=>'Data Lokasi Berhasil Di Hapus.','ikon'=>'success','label'=>'Berhasil']);
        }else{
            //Jika Tidak
            return response()->json(['status'=>'Gagal Menghapus Data Lokasi.','ikon'=>'error','label'=>'Kesalahan']);
        }
    }
}
