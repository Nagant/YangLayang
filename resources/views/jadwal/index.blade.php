@extends('base_layout.admin_layout')
@section('lokasi_kontent',"Jadwal")
@section('kontent')
<script>
    var url = "{{ route('jadwal.index') }}";
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
        <h1>Data Jadwal</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Jadwal</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Jadwal</h2>
        <p class="section-lead">
            Berisikan Data - Data Jadwal Pengadaan Lomba Layang - Layang.
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Jadwal</h4>
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
                            <table class="table table-striped dt-responsive" id="tabel_data_jadwal" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th data-priority="1">Hari</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Lokasi</th>
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


<!--Form Tambah Jadwal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Menambahkan Data @yield('lokasi_kontent')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="{{ route('jadwal.store') }}" enctype="multipart/form-data">
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
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <div class="form-group">
                                <label for="waktu_jadwal">Tanggal Jadwal</label>
                                <input class="form-control datepicker" id="tanggal_jadwal_tambah" name="tanggal_jadwal" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="form-group">
                                <label for="hari_jadwal">Hari Jadwal</label>
                                <select class="form-control" id="hari_jadwal_tambah" name="hari_jadwal" required>
                                    <option value="">Pilih Hari</option>
                                    <option value="Minggu">Minggu</option>  
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="waktu_jadwal">Waktu Jadwal</label>
                                <input type="time" class="form-control" id="waktu_jadwal_tambah" name="waktu_jadwal" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="lokasi_jadwal">Lokasi Jadwal</label>
                                <select class="form-control" id="lokasi_jadwal_tambah" name="id_lokasi" required>
                                    <option value="">Pilih Lokasi</option>
                                    @foreach ($datalokasi as $lokasi)              
                                        <option value="{{ $lokasi->id }}">[{{ $lokasi->kecamatan_lokasi }}] - {{ $lokasi->tempat_lokasi }}</option>             
                                    @endforeach   
                                </select>
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

<!--Form Edit Petugas -->
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
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <div class="form-group">
                                <label for="tanggal_jadwal">Tanggal Jadwal</label>
                                <input class="form-control datepicker" id="tanggal_jadwal_edit" autocomplete="off" name="tanggal_jadwal">
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="form-group">
                                <label for="hari_jadwal">Hari Jadwal</label>
                                <select class="form-control" id="hari_jadwal_edit" name="hari_jadwal" required>
                                    <option value="">Pilih Hari</option>
                                    <option value="Minggu">Minggu</option>  
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="waktu_jadwal">Waktu Jadwal</label>
                                <input type="time" class="form-control" id="waktu_jadwal_edit" name="waktu_jadwal">
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="lokasi_jadwal">Lokasi Jadwal</label>
                                <select class="form-control" id="lokasi_jadwal_edit" name="id_lokasi" required>
                                    <option value="">Pilih Lokasi</option>
                                    @foreach ($datalokasi as $lokasi)              
                                        <option value="{{ $lokasi->id }}">[{{ $lokasi->kecamatan_lokasi }}] - {{ $lokasi->tempat_lokasi }}</option>             
                                    @endforeach   
                                </select>
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
@section('javascript')
<script type="text/javascript">
    $(document).on("click", "#btn-edit-jadwal", function () {
        var id_jadwal = $(this).data('id');
        var hari_jadwal = $(this).data('hari_jadwal');
        var tanggal_jadwal =  new moment($(this).data('tanggal_jadwal'));
        var waktu_jadwal = $(this).data('waktu_jadwal');
        var id_lokasi = $(this).data('id_lokasi');
        $("#modal-data #id").val(id_jadwal);
        $("#modal-data #hari_jadwal_edit").val(hari_jadwal);
        $("#modal-data #tanggal_jadwal_edit").val(tanggal_jadwal.format('DD-MM-YYYY'));
        $("#modal-data #waktu_jadwal_edit").val(waktu_jadwal);
        $("#modal-data #lokasi_jadwal_edit").val(id_lokasi);
    })



    $(document).ready(function (e) {
        var tanggalsekarang = new Date();
        var tanggalkemarin = new Date();
        tanggalkemarin.setDate(tanggalsekarang.getDate()+1);
        var local = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ];
        $('#tanggal_jadwal_edit').datepicker({
            format: "dd-mm-yyyy",
            startView: "day",
            minViewMode: "day",
            startDate: tanggalkemarin
        }).on("change", function () {    
            var today = new Date($('#tanggal_jadwal_edit').datepicker('getDate'));
            $('#hari_jadwal_edit').val(local[today.getDay()]);
        });

        $('#tanggal_jadwal_tambah').datepicker({
            format: "dd-mm-yyyy",
            startView: "day",
            minViewMode: "day",
            startDate: tanggalkemarin
        }).on("change", function () {    
            var today = new Date($('#tanggal_jadwal_tambah').datepicker('getDate'));
            $('#hari_jadwal_tambah').val(local[today.getDay()]);
        });

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
                url: '{{ route('jadwal.update',1) }}',
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
                        $('#tabel_data_jadwal').DataTable().draw(false);
                        $('#tabel_data_jadwal').DataTable().ajax.reload();
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
