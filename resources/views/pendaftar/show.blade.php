@extends('base_layout.admin_layout')
@section('lokasi_kontent',"Pendaftar")
@section('kontent')
<script>
    var url = "{{ route('pendaftar.index') }}";
</script>
<section class="section">
    <div class="section-header">
        <h1>Pratinjau Pendaftar</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Pendaftar</div>
            <div class="breadcrumb-item">Pratinjau</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Pratinjau</h2>
        <p class="section-lead">
            Pratinjau Peserta Pendaftar Layang - Layang Yang Akan Mengikuti Event.
        </p>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pratinjau </h4>
                    </div>
                    <div class="card-body">
                        <div class="tickets">
                      
                      <div class="ticket-content">
                        <div class="ticket-header">
                          
                          <div class="ticket-detail">
                            <div class="ticket-title">
                              <h3 style="display: inline-block;">{{ $datapendaftar->nama_seka_pendaftar }}</h3>
                                @if($datapendaftar->status_pendaftar == "")
                                    <div id="status" style="display: inline-block; margin-bottom: .5rem;" class="badge badge-warning">Sedang Ditinjau</div>
                                @elseif($datapendaftar->status_pendaftar == "diterima")
                                    <div id="status" style="display: inline-block; margin-bottom: .5rem;" class="badge badge-primary">Diterima</div>
                                @else
                                    <div id="status" style="display: inline-block; margin-bottom: .5rem;" class="badge badge-danger">Ditolak</div>
                                @endif
                            </div>
                            <div class="ticket-info">
                              <div class="font-weight-600">{{ $datapendaftar->email_pendaftar }}</div>
                              <div class="bullet"></div>
                              <div class="text-primary font-weight-600">{{ $datapendaftar->created_at->diffForHumans()}}</div>
                            </div>
                          </div>
                        </div>
                        <div class="ticket-description">
                          <div class="row">
                            <div class="col-6">
                                <h6>Alamat Pendaftar</h6>
                                <p>{{ $datapendaftar->alamat_pendaftar }}</p>
                            </div>
                            <div class="col-6">
                                <h6>Kategori Layangan</h6>
                                <p>{{ $datapendaftar->kategori->kategori_layangan }}</p>
                            </div>
                            <div class="col-6">
                                <h6>Jenis Layangan</h6>
                                <p>{{ $datapendaftar->jenis->jenis_layangan }}</p>
                            </div>
                            <div class="col-6">
                                <h6>Jadwal Layangan</h6>
                                <p>{{ $datapendaftar->jadwal->hari_jadwal. " - ".Carbon\Carbon::parse($datapendaftar->jadwal->tanggal_jadwal)->format('j F Y')  }}</p>
                            </div>
                            <div class="col-12">
                                <h5>Jumlah Pembayaran</h5>
                                <p>Rp. @konversi($datapendaftar->kategori->biaya)</p>
                            </div>
                          </div>

                          <div class="gallery">
                            @foreach(explode('|', $datapendaftar->gambar_layangan_pendaftar) as $x=>$gambar)
                          <div class="gallery-item" data-image="{{asset('images/layangan_pendaftar/'.$gambar)}}" data-title="Gambar {{ $x }}" href="{{asset('images/layangan_pendaftar/'.$gambar)}}" title="Gambar {{ $x }}" style="background-image: url(&quot;{{asset('images/layangan_pendaftar/'.$gambar)}}&quot;);"></div>
                            @endforeach  
                            </div>
                          </div>

                          <div class="ticket-divider"></div>
                          <div class="ticket-form">
                              <div class="form-group row">
                                <div class="col">
                                    <a href="{{ route('pendaftar.index') }}" class="btn btn-secondary btn-lg">
                                        <i class="fa fa-chevron-left"></i> Kembali
                                    </a>
                                </div>
                                <div class="col text-right">
                                    @if($datapendaftar->status_pendaftar == "")
                                        <button class="btn btn-danger btn-lg" id="btn-tolak" onclick="perbaharui_status(this); return false;" data-id="{{$datapendaftar->id}}" data-status="Ditolak">
                                            <i class="fa fa-times"></i> Ditolak
                                        </button>
                                        <button class="btn btn-primary btn-lg" id="btn-terima" onclick="perbaharui_status(this); return false;" data-id="{{$datapendaftar->id}}" data-status="Diterima">
                                            <i class="fa fa-check"></i> Diterima
                                        </button>
                                    @endif
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@section('javascript')
<script>
function perbaharui_status(data) {
        var id = $(data).data('id');
        var status = $(data).data('status');
        var peserta = '{{ $datapendaftar->nama_seka_pendaftar }}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        Swal.fire({
            title: 'Anda Yakin?',
            text: "Apakah Anda Yakin Ingin Memperbaharui Status Untuk " + peserta + ".?",
            type: 'warning',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '{{ route('pendaftar.update',1) }}',
                    type: 'POST',
                    dataType: 'json',
                    data: { _method: 'PUT', id: id, status_pendaftar: status.toLowerCase() },
                }).always(function (data) {
                    Swal.fire(
                        data.label,
                        data.status,
                        data.ikon)
                    $("#btn-tolak").hide();
                    $("#btn-terima").hide();
                    $("#status").html(status)
                    if(status == "Diterima"){
                        $("#status").removeClass("badge-warning").addClass("badge-primary");
                    }else{
                        $("#status").removeClass("badge-warning").addClass("badge-danger");
                    }
                });
            }
        })
}
</script>
@stop
@endsection
