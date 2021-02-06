@extends('base_layout.admin_layout')
@section('lokasi_kontent',"Kategori")
@section('kontent')
<script>
    var url = "{{ route('kategori.index') }}";
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
        <h1>Data Kategori</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Kategori</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Kategori</h2>
        <p class="section-lead">
            Berisikan Data - Data Kategori Layang - Layang.
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Kategori</h4>
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
                            <table class="table table-striped dt-responsive" id="tabel_data_kategori" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th data-priority="1">Jenis</th>
                                        <th>Biaya</th>
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


<!--Form Tambah Kategori -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Menambahkan Data @yield('lokasi_kontent')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
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
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="kategori_layang_tambah">Kategori</label>
                                <input class="form-control" id="kategori_layang_tambah" name="kategori_layangan" value="{{ old('kategori_layangan') }}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="biaya_layang_tambah">Biaya</label>
                                <input class="form-control" id="biaya_layang_tambah" name="biaya" value="{{ old('biaya') }}" autocomplete="off" required>
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

<!--Form Edit Kategroi -->
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
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="kategori_layang_edit">Kategori</label>
                                <input class="form-control" id="jenis_layang_edit" autocomplete="off" name="kategori_layangan">
                            </div>
                        </div>
                         <div class="col col-md-6">
                            <div class="form-group">
                                <label for="biaya_layang_edit">Biaya</label>
                                <input class="form-control" id="biaya_layang_edit" autocomplete="off" name="biaya">
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
    $(document).on("click", "#btn-edit-kategori", function () {
        var id_layangan = $(this).data('id');
        var kategori_layangan = $(this).data('kategori_layangan');
        var biaya = $(this).data('biaya');
        $("#modal-data #id").val(id_layangan);
        $("#modal-data #jenis_layang_edit").val(kategori_layangan);
        $("#modal-data #biaya_layang_edit").val(biaya);
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
                url: '{{ route('kategori.update',1) }}',
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
                        $('#tabel_data_kategori').DataTable().draw(false);
                        $('#tabel_data_kategori').DataTable().ajax.reload();
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
