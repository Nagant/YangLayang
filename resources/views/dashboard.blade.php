@extends('base_layout.admin_layout')
@section('lokasi_kontent',"Admin")
@section('kontent')
<section class="section">
    <div class="section-header">
    <h1>Dashboard</h1>
    </div>
    <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
            <i class="fas fa-users"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Pendaftar</h4>
            </div>
            <div class="card-body">
            {{ $datapendaftar->count() }}
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
            <i class="fas fa-map-marker-alt"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Lokasi</h4>
            </div>
            <div class="card-body">
            {{ $datalokasi->count() }}
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
            <i class="fas fa-clock"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Jadwal</h4>
            </div>
            <div class="card-body">
            {{ $datajadwal->count() }}
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-success">
            <i class="fas fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Petugas</h4>
            </div>
            <div class="card-body">
            {{ $datapetugas->count() }}
            </div>
        </div>
        </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
        <div class="card-header">
            <h4>Statistik</h4>
        </div>
        <div class="card-body">
            <canvas id="chartstatistik" height="150"></canvas>
        </div>
        </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-6 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Peserta Baru</h4>
            </div>
            <div class="card-body">
                @if(count($datapendaftar) > 0)
                    <div class="table-responsive">
                        <table class="table table-condensed">
                        <tr>
                            <th style="width: 10px">No.</th>
                            <th>Nama Sekaa</th>
                            <th>Status</th>
                        </tr>
                            @foreach($datapendaftar->take(5) as $x=>$pendaftar)
                                <tr>
                                    <td>{{ $x+1 }}</td>
                                    <td>{{ $pendaftar->nama_seka_pendaftar }}</td>
                                    @if($pendaftar->status_pendaftar == "")
                                        <td><div class="badge badge-warning">Sedang Ditinjau</div></td>
                                    @elseif($pendaftar->status_pendaftar == "diterima")
                                        <td><div class="badge badge-primary">Diterima</div></td>
                                    @else
                                        <td><div class="badge badge-danger">Ditolak</div></td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="text-center pt-1 pb-1">
                        <a href="{{ route('pendaftar.index') }}" class="btn btn-primary btn-lg btn-round">
                            Lihat Semua Data
                        </a>
                    </div>
                @else
                    <div class="empty-state" data-height="300" style="height: 300px;">
                        <div class="empty-state-icon">
                        <i class="fas fa-question"></i>
                        </div>
                        <h2>Tidak Ada Data</h2>
                        <p class="lead">
                            Maaf, Sepertinya kami tidak menemukan data yang tersedia.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Jadwal</h4>
            </div>
            <div class="card-body">
            @if(count($datajadwal) > 0)
                <table class="table table-condensed">
                <tr>
                    <th style="width: 10px">No.</th>
                    <th>Hari</th>
                    <th>Tanggal</th>
                </tr>
                    @foreach($datajadwal->take(5) as $x=>$jadwal)
                    <tr>
                        <td>{{ $x+1 }}</td>
                        <td>{{ $jadwal->hari_jadwal }}</td>
                        <td>{{ date_format(date_create($jadwal->tanggal_jadwal),'j F Y') }}</td>
                    </tr>
                    @endforeach
                </table>
                <div class="text-center pt-1 pb-1">
                    <a href="{{ route('jadwal.index') }}" class="btn btn-primary btn-lg btn-round">
                        Lihat Semua Data
                    </a>
                </div>
            @else
                <div class="empty-state" data-height="300" style="height: 300px;">
                    <div class="empty-state-icon">
                    <i class="fas fa-question"></i>
                    </div>
                    <h2>Tidak Ada Data</h2>
                    <p class="lead">
                        Maaf, Sepertinya kami tidak menemukan data yang tersedia.
                    </p>
                </div>
            @endif
            </div>
        </div>
    </div>
    </div>
</section>
@section('javascript')
<script>
 function chartJumlahTransaksi() {
          $.ajax({
              url: '{{ url('statistikpendaftar') }}',
              success: function (result) {
                  var datachart = JSON.parse(JSON.stringify(result));
                  var labelchart = [];
                  var valuechart = [];
                  for (var i in datachart) {

                      labelchart.push(datachart[i].bulan);
                      valuechart.push(datachart[i].jumlah);

                  }
                var ctx = document.getElementById("chartstatistik").getContext('2d');
                var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labelchart,
                    datasets: [{
                    label: 'Pendaftar',
                    data: valuechart,
                    borderWidth: 2,
                    backgroundColor: 'rgba(254,86,83,.7)',
                    borderColor: 'rgba(254,86,83,.7)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                    }]
                },
                options: {
                    legend: {
                    display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(t, d) {
                                var xLabel = d.datasets[t.datasetIndex].label;
                                var yLabel = IDRFormatter(t.yLabel, "Rp. ");
                                return xLabel + ': ' + yLabel;
                            }
                        }
                    },
                    scales: {
                    yAxes: [{
                        gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return IDRFormatter(value, "Rp. ");
                            }
                        }
                        }],
                    xAxes: [{
                        gridLines: {
                        display: false
                        }
                    }]
                    },
                }
                });
              }
          });
      }
      $(document).ready(function() {
          chartJumlahTransaksi();
      });
</script>
@stop
@endsection