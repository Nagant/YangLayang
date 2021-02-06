@extends('base_layout.admin_layout',$datapetugas)
@section('lokasi_kontent',"Petugas")
@section('kontent')
<script>
    var url = "{{ route('petugas.index') }}";
    @if ($errors->count())
        $(document).ready(function() {
            $('#callout-informasi').addClass('alert-warning').removeClass('alert-info');
            $('#tambah').modal('show');
        });
    @endif
</script>
<section class="section">
    <div class="section-header">
        <h1>Data Petugas</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Petugas</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Petugas</h2>
        <p class="section-lead">
            Berisikan Data - Data Petugas Administrasi Layang-Layang.
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Petugas</h4>
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
                            <table id="tabel_data_petugas" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
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


<!--Form Tambah Petugas -->
<div id="tambah" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Menambahkan Data @yield('lokasi_kontent')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="{{ route('petugas.store') }}" enctype="multipart/form-data">
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
                                <label for="name_pengguna">Nama Petugas</label>
                            <input type="text" class="form-control" id="name_pengguna" name="name_pengguna" value="{{ old('name_pengguna') }}" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="form-group">
                                <label for="username_pengguna">Username Petugas</label>
                                <input type="text" class="form-control" id="username_pengguna"
                                    name="username_pengguna" value="{{ old('username_pengguna') }}" required>
                            </div>
                        </div>
                        <div class="col col-md-12">
                                <div class="form-group">
                                    <label for="email_pengguna">Email Petugas</label>
                                    <input type="email" class="form-control" id="email_pengguna"
                                        name="email_pengguna" value="{{ old('email_pengguna') }}" required>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="colcol-6 col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password"
                                    name="password" value="{{ old('password') }}" required>
                            </div>
                        </div>
                        <div class="colcol-6 col-md-6">
                            <div class="form-group">
                                <label for="password">Ulangi Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" value="{{ old('password') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-12">
                            <div class="form-group">
                                <label for="photo_pengguna">Photo Petugas</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="photo_pengguna"
                                    name="photo_pengguna" accept="image/jpg, image/jpeg">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
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
<div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Memperbaharui Data @yield('lokasi_kontent')</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
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
                                    <label for="name_pengguna">Nama Petugas</label>
                                    <input type="text" class="form-control" id="name_pengguna" name="name_pengguna" >
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="form-group">
                                    <label for="username_pengguna">Username Petugas</label>
                                    <input type="text" class="form-control" id="username_pengguna"
                                        name="username_pengguna" >
                                </div>
                            </div>
                            <div class="col col-md-12">
                                    <div class="form-group">
                                        <label for="email_pengguna">Email Petugas</label>
                                        <input type="email" class="form-control" id="email_pengguna"
                                            name="email_pengguna" required>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="colcol-6 col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password"
                                        name="password">
                                </div>
                            </div>
                            <div class="colcol-6 col-md-6">
                                <div class="form-group">
                                    <label for="ulangi_password">Ulangi Password</label>
                                    <input type="password" class="form-control" id="ulangi_password"
                                        name="ulangi_password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="photo_pengguna">Photo Petugas</label>
                                    <div style="padding-bottom: 5px">
                                        <img src="" width="80px" id="pict">
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="photo_pengguna" class="custom-file-input" accept="image/jpg, image/jpeg" id="photo_pengguna"></input>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-12">
                                <div class="form-group">
                                        <label for="ulangi_password">Konfirmasi Pengubahan</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="konfirmasi_pengubahan"
                                                name="konfirmasi_pengubahan">
                                                <div class="input-group-append" data-toggle="tooltip" data-placement="right" title="Anda harus memasukan password dari username yang anda ubah saat ini sebagai konfirmasi pengubahan data petugas!">
                                                    <div class="input-group-text" style="background: #e9ecef;"><i class="fa fa-exclamation-triangle"></i></div>
                                                </div>
                                        </div>
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
    $(document).on("click", "#btn-edit-petugas", function () {
        var id_pengguna = $(this).data('id');
        var name_pengguna = $(this).data('name_pengguna');
        var email_pengguna = $(this).data('email_pengguna');
        var username_pengguna = $(this).data('username_pengguna');
        var photo_pengguna = $(this).data('photo_pengguna');

        $("#modal-data #id").val(id_pengguna);
        $("#modal-data #name_pengguna").val(name_pengguna);
        $("#modal-data #email_pengguna").val(email_pengguna);
        $("#modal-data #username_pengguna").val(username_pengguna);
        $("#modal-data #pict").attr("src", "{{ asset('images/profile') }}"+"/"+photo_pengguna);


    })

    $(document).ready(function(e) {
        $('#callout-isikesalahan').hide();
        $('#callout-isikesalahan-edit').hide();

        $("#form").on("submit", (function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url : '{{ route('petugas.update',1) }}',
                data : new FormData(this),
                type : 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                success : function(msg) {
                    swal.fire(
                        msg.label,
                        msg.status,
                        msg.ikon);
                    switch(msg.label){
                        case 'Berhasil':
                            $('#form').find('input').removeClass('is-invalid');
                            $("#form").trigger("reset");
                            $('#callout-informasi-edit').addClass('alert-info').removeClass('alert-warning');
                            $('#callout-pesan-edit').html("Isikan Informasi Terbaru @yield('lokasi_kontent') Yang Akan Di Ubah");
                            $('#callout-label-edit').show();
                            $('#callout-pesan-edit').removeClass("alert-title");
                            $('#callout-isikesalahan-edit').hide();
                            $('#callout-isikesalahan-edit').empty();
                            $('#konfirmasi_pengubahan').removeClass('is-invalid');
                            $("#edit").modal('hide');
                            $('#tabel_data_petugas').DataTable().draw(false);
                            $('#tabel_data_petugas').DataTable().ajax.reload();
                        break;
                        case 'Kesalahan Password Konfirmasi':
                            $('#konfirmasi_pengubahan').addClass('is-invalid');
                        break;
                    }
                },
                error : function(data) {
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
