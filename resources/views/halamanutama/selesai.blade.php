@extends('halamanutama.layout.base')
@section('lokasi_kontent',"Selesai")
@section('kontent')
<div class="card card-primary">
    <div class="card-header"><h4>Selesai</h4></div>
    <div class="card-body text-center">
        <h3>Terima Kasih</h3>
        <p>Data sudah dikirim untuk ditinjau, anda akan mendapatkan notifikasi jika data anda diterima.</p>
        <a href="{{ route("index") }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-arrow-left"></i> Kembali Ke Halaman Utama</a>
    </div>
</div>
@endsection