<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;
use App\Pendaftar;
use App\Pengguna;
use App\Lokasi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function statistikpendaftar()
    {
        $datastatistik = array();
        foreach (range(1, 12) as $bulan) {
            $jumlah = Pendaftar::with('kategori')->where('status_pendaftar', '=', 'diterima')->whereYear('created_at', '=', Carbon::now()->year)->whereMonth('created_at', '=', $bulan)->get()->sum('kategori.biaya');
            $datastatistik[] = array('bulan' => Carbon::create()->month($bulan)->format('F'). " " .Carbon::now()->year , 'jumlah' => "$jumlah");
        }
        return response()->json($datastatistik);
    }

    public function notifikasi()
    {
        $datanotif = array();
        $datapendaftar = Pendaftar::select('id','nama_seka_pendaftar','created_at')->orderBy('created_at', 'desc')->take(5)->get();
        foreach($datapendaftar as $data){
            $datanotif[] = array('id' => $data->id, 'nama_seka_pendaftar' => $data->nama_seka_pendaftar, 'created_at' => $data->created_at->diffForHumans());
        }
        return response()->json($datanotif);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datajadwal = Jadwal::orderBy('id', 'desc')->get();
        $datapendaftar = Pendaftar::orderBy('created_at', 'desc')->get();
        $datapetugas = Pengguna::orderBy('id', 'desc')->get();
        $datalokasi = Lokasi::orderBy('id', 'desc')->get();

        return view('dashboard',compact('datajadwal','datapendaftar','datapetugas','datalokasi'));
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
