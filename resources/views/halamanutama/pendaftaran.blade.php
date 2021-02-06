@extends('halamanutama.layout.base')
@section('lokasi_kontent',"Pendaftaran")
@section('kontent')

@if($errors -> count())
<div class="alert alert-warning alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        <div class="alert-title">Terjadi Kesalahan</div>
        Berikut beberapa informasi terjadinya kesalahan.
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div class="card card-primary">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Pendaftaran</h4>
            </div>
            <div class="card-body">
                <div class="row mt-4">
                    <div class="col-12 col-lg-12">
                        <div class="wizard-steps">
                            <div id="box-step1" class="wizard-step wizard-step-active">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Informasi Seka
                                </div>
                            </div>
                            <div id="box-step2" class="wizard-step">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Informasi Layangan
                                </div>
                            </div>
                            <div id="box-step3" class="wizard-step">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Selesai
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <form action="{{ route('store') }}" enctype="multipart/form-data" method="POST" id="wizard">
                {{ csrf_field() }}
                <h4></h4>
                <section>
                    <div id="step1" class="wizard-content mt-2">
                        <div class="wizard-pane">
                            <div class="form-group row align-items-center">
                                <label class="col">Nama Seka</label>
                                <div class="col-12">
                                    <input type="text" id="nama_seka_pendaftar" name="nama_seka_pendaftar"
                                        class="form-control @if($errors -> has('nama_seka_pendaftar')) is-invalid @endif" value="{{ old("nama_seka_pendaftar") }}" required>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col">Email</label>
                                <div class="col-12">
                                    <input type="email" id="email_pendaftar" id="email_pendaftar" name="email_pendaftar"
                                        class="form-control @if($errors -> has('email_pendaftar')) is-invalid @endif" value="{{ old("email_pendaftar") }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col">Alamat</label>
                                <div class="col-12">
                                    <textarea class="form-control @if($errors -> has('alamat_pendaftar')) is-invalid @endif" id="alamat_pendaftar"
                                        name="alamat_pendaftar" required>{{ old("alamat_pendaftar") }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col"></div>
                                <div class="col-12 text-right">
                                    <a href="javascript:void(0);" id="selanjutnya" class="btn btn-icon icon-right btn-primary" onclick="formselanjutnya();">Selanjutnya
                                        <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                    <h4></h4>
                    <section>
                    <div id="step2" class="wizard-content mt-2">
                        <div class="wizard-pane">
                            <div class="form-group row align-items-center">
                                <label class="col">Kategori Layangan</label>
                                <div class="col-12">
                                    <select class="form-control @if($errors -> has('kategori_layangan_pendaftar')) is-invalid @endif" id="kategori_layangan_pendaftar"
                                        name="kategori_layangan_pendaftar" value="{{ old("kategori_layangan_pendaftar") }}" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($datakategori as $kategori)
                                        <option data-biaya="{{ $kategori->biaya }}" value="{{ $kategori->id }}">[{{ $kategori->id }}] -
                                            {{ $kategori->kategori_layangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col">Jenis Layangan</label>
                                <div class="col-12">
                                    <select class="form-control @if($errors -> has('jenis_layangan_pendaftar')) is-invalid @endif" id="jenis_layangan_pendaftar"
                                        name="jenis_layangan_pendaftar" value="{{ old("jenis_layangan_pendaftar") }}" required>
                                        <option value="">Pilih Jenis</option>
                                        @foreach ($datajenis as $jenis)
                                        <option value="{{ $jenis->id }}">[{{ $jenis->id }}] -
                                            {{ $jenis->jenis_layangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col">Jadwal</label>
                                <div class="col-12">
                                    <select class="form-control @if($errors -> has('jadwal_pendaftar')) is-invalid @endif" id="jadwal_pendaftar" name="jadwal_pendaftar" value="{{ old("jadwal_pendaftar") }}" required>
                                        <option value="">Pilih Jadwal</option>
                                        @foreach ($datajadwal as $jadwal)
                                        <option data-lokasi="{{ $jadwal->lat_lokasi }},{{ $jadwal->lng_lokasi }}" value="{{ $jadwal->id }}">[{{ $jadwal->hari_jadwal }}] -
                                            {{ $jadwal->tanggal_jadwal }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col">Gambar</label>
                                <div class="col-12">
                                    <input class="form-control @if($errors -> has('gambar_layangan_pendaftar')) is-invalid @endif" id="gambar" type="file" name="gambar_layangan_pendaftar[]"
                                        multiple accept="image/jpg, image/jpeg" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col text-left">
                                    <a href="javascript:void(0);" class="btn btn-icon icon-left btn-primary" onclick="formsebelumnya();"><i
                                            class="fas fa-arrow-left"></i> Kembali</a>
                                </div>
                                <div class="col text-right">
                                    <a href="javascript:void(0);" class="btn btn-icon icon-right btn-primary" onclick="formselanjutnya();">Selanjutnya
                                        <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <h4></h4>
                <section>
                    <div id="step3" class="wizard-content mt-2">
                        <div class="wizard-pane">
                            <div class="row">
                                <div class="col-12">
                                    <p>Berikut merupakan detail dari informasi yang sudah diisikan.</p>
                                </div>
                                <div class="col-6">
                                    <h6>Nama Pendaftar</h6>
                                    <p id="nama_pendtfr"></p>
                                </div>
                                <div class="col-6">
                                    <h6>Email Pendaftar</h6>
                                    <p id="email_pendtfr"></p>
                                </div>
                                <div class="col-6">
                                    <h6>Alamat Pendaftar</h6>
                                    <p id="alamat_pendtfr"></p>
                                </div>
                                <div class="col-6">
                                    <h6>Kategori Layangan</h6>
                                    <p id="kategori_pendtfr"></p>
                                </div>
                                <div class="col-6">
                                    <h6>Jenis Layangan</h6>
                                    <p id="jenis_pendtfr"></p>
                                </div>
                                <div class="col-6">
                                    <h6>Jadwal Layangan</h6>
                                    <p id="jadwal_pendtfr"></p>
                                </div>
                                <div class="col-12">
                                    <h5>Jumlah Pembayaran</h5>
                                    <p id="jumlah_pendtfr"></p>
                                </div>
                                <div class="col-12">
                                    <p>Jika informasi sudah benar klik daftar untuk melakukan pendaftaran</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col text-left">
                                    <a href="javascript:void(0);" class="btn btn-icon icon-left btn-primary" onclick="formsebelumnya();"><i
                                            class="fas fa-arrow-left"></i> Kembali</a>
                                </div>
                                <div class="col text-right">
                                    <button type="submit" id="next-selesai" href="#"
                                        class="btn btn-icon icon-right btn-primary">Daftar <i
                                            class="fas fa-check"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
@section('javascript')
<script>
function formselanjutnya(){
    $("#wizard").steps('next');

}

function formsebelumnya(){
    $("#wizard").steps('previous');
}


$(document).ready(function() {
    $('ul[role="tablist"]').hide();
    setTimeout(function () {
            map.invalidateSize();
    }, 10);
    $("#gambar").on("change", function() {
    if ($("#gambar")[0].files.length > 2) {
        swal.fire(
            "Kesalahan",
            "Anda hanya diperbolehkan menggungah maksimal 2 file gambar!",
            "warning");
        $("#gambar").val('');
    }
});
});
</script>
@stop
@endsection