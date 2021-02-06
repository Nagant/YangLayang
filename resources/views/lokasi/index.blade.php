@extends('base_layout.admin_layout')
@section('lokasi_kontent',"Lokasi")
@section('kontent')
<script>
    var url = "{{ route('lokasi.index') }}";
    var error;
    @if($errors -> count())
        $(document).ready(function () {
            $('#callout-informasi').addClass('alert-warning').removeClass('alert-info');
            $('#tambah').modal('show');
        });
    @endif
</script>
<section class="section">
    <div class="section-header">
        <h1>Data Lokasi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Lokasi</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Lokasi</h2>
        <p class="section-lead">
            Berisikan Data - Data Lokasi Pengadaan Layang - Layang.
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Lokasi</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <a href="#" data-toggle="modal" data-target="#tambah"><button class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped dt-responsive" id="tabel_data_lokasi" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th data-priority="1">Nama Tempat Lokasi</th>
                                        <th>Jalan Lokasi</th>
                                        <th>Kecamatan Lokasi</th>
                                        <th>Lattidue Lokasi</th>
                                        <th>Longtidue Lokasi</th>
                                        <th>Link Lokasi</th>
                                        <th data-priority="1">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>


<!--Form Tambah Lokasi -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Menambahkan Data @yield('lokasi_kontent')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="{{ route('lokasi.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div id="callout-informasi" class="alert alert-info">
                        @if ($errors->count())
                        <div class="alert-title" id="callout-pesan">Terjadi Kesalahan!</div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @else
                        <div class="alert-title">Tambah Data</div>
                        <p id="callout-pesan">Isikan Informasi @yield('lokasi_kontent') Yang Akan Di Tambahkan</p>
                        @endif
                    </div>
                    <div class="alert alert-success">
                        <p>Mencari Lokasi Secara Otomatis.? <a href="#" id="tombollokasiotomatis" data-toggle="modal" data-target="#lokasiotomatis" data-jenis="tambah"><b>Klik Disini!</b></a></p>
                    </div>
                    <div class="row">
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="tempat_lokasi_tambah">Nama Tempat Lokasi</label>
                                <input class="form-control" id="tempat_lokasi_tambah" name="tempat_lokasi" value="{{ old('tempat_lokasi') }}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="kecamatan_lokasi_tambah">Kecamatan Lokasi</label>
                                <input class="form-control" id="kecamatan_lokasi_tambah" name="kecamatan_lokasi" value="{{ old('kecamatan_lokasi') }}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="lng_lokasi_tambah">Kabupaten Lokasi</label>
                                <input class="form-control" id="kabupaten_lokasi_tambah" name="kabupaten_lokasi" value="{{ old('kabupaten_lokasi') }}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="lng_lokasi_tambah">Alamat Lokasi</label>
                                <input class="form-control" id="jalan_lokasi_tambah" name="jalan_lokasi" value="{{ old('jalan_lokasi') }}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="lat_lokasi_tambah">Lattidue Lokasi</label>
                                <input class="form-control" id="lat_lokasi_tambah" name="lat_lokasi" value="{{ old('lat_lokasi') }}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="lng_lokasi_tambah">Longtidue Lokasi</label>
                                <input class="form-control" id="lng_lokasi_tambah" name="lng_lokasi" value="{{ old('lng_lokasi') }}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="lng_lokasi_tambah">Link Lokasi</label>
                                <input class="form-control" id="link_lokasi_tambah" name="link_lokasi" value="{{ old('link_lokasi') }}" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                        <button type="submit" class="btn btn-success btn-flat" id="submit">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Form Edit Lokasi -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Memperbaharui Data @yield('lokasi_kontent')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" enctype="multipart/form-data">

                <div class="modal-body" id="modal-data">
                    <!-- Manipulasi Form Untuk Mengirim Data Menggunakan Metode "PUT" -->
                    {{ method_field('PUT') }}
                    <!-- ID Untuk Memperbaharui Data Yang Akan Di Perbaharui -->
                    <input type="hidden" name="id" id="id">
                    <div id="callout-informasi-edit" class="alert alert-info">
                        <div class="alert-title" id="callout-label-edit">Ubah Data</div>
                        <div id="callout-pesan-edit">Isikan Informasi Terbaru @yield('lokasi_kontent') Yang Akan Di Ubah</div>
                        <ul id="callout-isikesalahan-edit"></ul>
                    </div>
                    <div class="alert alert-success">
                        <p>Mencari Lokasi Secara Otomatis.? <a href="#" id="tombollokasiotomatis" data-toggle="modal" data-target="#lokasiotomatis" data-jenis="edit"><b>Klik Disini!</b></a></p>
                    </div>
                    <div class="row">
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="tempat_lokasi_edit">Nama Tempat Lokasi</label>
                                <input class="form-control" id="tempat_lokasi_edit" name="tempat_lokasi" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="kecamatan_lokasi_edit">Kecamatan Lokasi</label>
                                <input class="form-control" id="kecamatan_lokasi_edit" name="kecamatan_lokasi" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="lng_lokasi_edit">Kabupaten Lokasi</label>
                                <input class="form-control" id="kabupaten_lokasi_edit" name="kabupaten_lokasi" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="lng_lokasi_edit">Alamat Lokasi</label>
                                <input class="form-control" id="jalan_lokasi_edit" name="jalan_lokasi" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="lat_lokasi_edit">Lattidue Lokasi</label>
                                <input class="form-control" id="lat_lokasi_edit" name="lat_lokasi" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="lng_lokasi_edit">Longtidue Lokasi</label>
                                <input class="form-control" id="lng_lokasi_edit" name="lng_lokasi" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="lng_lokasi_edit">Link Lokasi</label>
                                <input class="form-control" id="link_lokasi_edit" name="link_lokasi" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat" id="submit">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!--Form Lokasi Otomatis -->
<div class="modal fade" id="lokasiotomatis" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Lokasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
                    <div class="modal-body">
                        <div class="alert alert-info alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-exclamation-triangle"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Informasi</div>
                                Mungkin Penggunaan Pengisian Alamat Otomtasi Kurang Akurasi dan Tidak Lengkap, Isikan Manual Jika Alamat Yang Akan Diisi Berdasarkan Tempat Yang Tertentu.
                            </div>
                        </div>
                        <div class="modal-body" id='map-canvas' style="padding: 0;"></div>
                        <p id="infoAlamat" style="text-align:left;"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-success btn-flat">OK</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@section('javascript')
<script type="text/javascript">
    $(document).on("click", "#btn-edit-lokasi", function () {
        var id_lokasi = $(this).data('id');
        var jalan_lokasi = $(this).data('jalan_lokasi');
        var tempat_lokasi = $(this).data('tempat_lokasi');
        var kecamatan_lokasi = $(this).data('kecamatan_lokasi');
        var kabupaten_lokasi = $(this).data('kabupaten_lokasi');
        var lat_lokasi = $(this).data('lat_lokasi');
        var lng_lokasi = $(this).data('lng_lokasi');
        var link_lokasi = $(this).data('link_lokasi');
        $("#modal-data #id").val(id_lokasi);
        $("#modal-data #tempat_lokasi_edit").val(tempat_lokasi);
        $("#modal-data #kecamatan_lokasi_edit").val(kecamatan_lokasi);
        $("#modal-data #kabupaten_lokasi_edit").val(kabupaten_lokasi);
        $("#modal-data #jalan_lokasi_edit").val(jalan_lokasi);
        $("#modal-data #lat_lokasi_edit").val(lat_lokasi);
        $("#modal-data #lng_lokasi_edit").val(lng_lokasi);
        $("#modal-data #link_lokasi_edit").val(link_lokasi);
    })



    $(document).ready(function (e) {
        $('#callout-isikesalahan').hide();
        $('#callout-isikesalahan-edit').hide();

        $("#form").on("submit", (function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route('lokasi.update',1) }}',
                data: new FormData(this),
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (data) {
                    swal.fire(
                        data.label,
                        data.status,
                        data.ikon);
                    if (data.label == "Berhasil") {
                        $('#form').find('input').removeClass('is-invalid');
                        $('#callout-informasi-edit').addClass('alert-info').removeClass('alert-warning');
                        $('#callout-pesan-edit').html("Isikan Informasi Terbaru @yield('lokasi_kontent') Yang Akan Di Ubah");
                        $('#callout-isikesalahan-edit').hide();
                        $('#callout-label-edit').show();
                        $('#callout-pesan-edit').removeClass("alert-title");
                        $('#callout-isikesalahan-edit').empty();
                        $("#edit").modal('hide');
                        $('#tabel_data_lokasi').DataTable().draw(false);
                        $('#tabel_data_lokasi').DataTable().ajax.reload();
                    };
                },
                error: function (data) {
                    json = $.parseJSON(data.responseText);
                    console.log(json.errors);
                    if(data.status == "422"){
                        $('#callout-informasi-edit').addClass('alert-warning').removeClass('alert-info');
                        $('#callout-pesan-edit').html("Terjadi Kesalahan");
                        $('#callout-isikesalahan-edit').show();
                        $('#callout-label-edit').hide();
                        $('#callout-pesan-edit').addClass("alert-title");
                        $('#callout-isikesalahan-edit').empty();
                        
                        $.each(json.errors, function(key, value) {
                            $('input[name ="' + key + '"]').addClass('is-invalid');
                            $('#callout-isikesalahan-edit').append("<li>" + value + "</li>");
                        })
                    }
                    swal.fire(
                        'Kesalahan',
                        'Pesan : Terjadi Kesalahan [' + data.status + ']',
                        'warning')
                }
            });
        }));
    })
</script>
@stop
@endsection
