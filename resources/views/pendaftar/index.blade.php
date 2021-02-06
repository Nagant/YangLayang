@extends('base_layout.admin_layout')
@section('lokasi_kontent',"Pendaftar")
@section('kontent')
<script>
    var url = "{{ route('pendaftar.index') }}";
</script>
<section class="section">
    <div class="section-header">
        <h1>Data Pendaftar</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Pendaftar</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Pendaftar</h2>
        <p class="section-lead">
            Berisikan Data - Data Pendaftar Layang-Layang.
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pendaftar</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabel_data_pendaftar" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Seka</th>
                                        <th>E-Mail</th>
                                        <th>Alamat</th>
                                        <th>Kategori</th>
                                        <th>Jenis</th>
                                        <th>Jadwal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
