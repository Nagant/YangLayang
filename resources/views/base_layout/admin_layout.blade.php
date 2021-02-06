@extends('base_layout.layout_base')
@section('base_kontent')
<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifikasi
              </div>
              <div id="notifikasi" class="dropdown-list-content dropdown-list-icons">

              </div>
              <div class="dropdown-footer text-center">
                <a href="{{ route('pendaftar.index') }}">Lihat Semua <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('images/profile/'.Auth::user()->photo_pengguna.'') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name_pengguna }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger"onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="btn btn-default btn-flat"><i class="fas fa-sign-out-alt"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html"><span class="logo-mini"><img src="{{ asset('images/kite.svg') }}" height="26px" width="26px"></span> YangLayang</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">YL</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
                <li class="{{ request()->routeIs('dashboard') ? 'active' : ''  }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>  
              <li class="menu-header">Umum</li>
                <li class="{{ request()->routeIs('pendaftar.index') ? 'active' : ''  }}"><a class="nav-link" href="{{ route('pendaftar.index') }}"><i class="fas fa-users"></i> <span>Peserta</span></a></li>
                <li class="{{ request()->routeIs('jadwal.index') ? 'active' : ''  }}"><a class="nav-link" href="{{ route('jadwal.index') }}"><i class="fas fa-clock"></i> <span>Jadwal</span></a></li>
                <li class="{{ request()->routeIs('kategori.index') ? 'active' : ''  }}"><a class="nav-link" href="{{ route('kategori.index') }}"><i class="fas fa-object-ungroup"></i> <span>Kategori</span></a></li>
                <li class="{{ request()->routeIs('jenis.index') ? 'active' : ''  }}"><a class="nav-link" href="{{ route('jenis.index') }}"><i class="fas fa-layer-group"></i> <span>Jenis</span></a></li>
                <li class="{{ request()->routeIs('lokasi.index') ? 'active' : ''  }}"><a class="nav-link" href="{{ route('lokasi.index') }}"><i class="fas fa-map-marker-alt"></i> <span>Lokasi</span></a></li>
              <li class="menu-header">Petugas</li>
                <li class="{{ request()->routeIs('petugas.index') ? 'active' : ''  }}"><a class="nav-link" href="{{ route('petugas.index') }}"><i class="fas fa-user"></i> <span>Petugas</span></a></li>
        </aside>
      </div>
      <div class="main-content">
        @yield('kontent')
      </div>
      <footer class="main-footer">
        <div class="footer-left">
           Made with <i class="fa fa-heart"></i> & <i class="fa fa-coffee"></i>
        </div>
        <div class="footer-right">
          <strong>YangLayang &copy; 2019</strong>
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('/js/popper.min.js') }}"></script>
  <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('/js/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('/js/moment.min.js') }}"></script>
  
  <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('/js/datetime.js') }}"></script>
  <script src="{{ asset('/js/chart.min.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ asset('/js/scripts.js') }}"></script>
  <script src="{{ asset('/js/custom.js') }}"></script>

  <!-- Theme One -->
  <script src="{{ asset('/js/stisla.js') }}"></script>

  <!-- Custom One -->
  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
  <script src="https://cdn.jsdelivr.net/npm/leaflet-search@2.4.0/dist/leaflet-search.min.js"></script>
  <script src="https://unpkg.com/esri-leaflet@2.2.3/dist/esri-leaflet.js" integrity="sha512-YZ6b5bXRVwipfqul5krehD9qlbJzc6KOGXYsDjU9HHXW2gK57xmWl2gU6nAegiErAqFXhygKIsWPKbjLPXVb2g==" crossorigin=""></script>
  <script src="https://unpkg.com/esri-leaflet-geocoder@2.2.13/dist/esri-leaflet-geocoder.js" integrity="sha512-zdT4Pc2tIrc6uoYly2Wp8jh6EPEWaveqqD3sT0lf5yei19BC1WulGuh5CesB0ldBKZieKGD7Qyf/G0jdSe016A==" crossorigin=""></script>
  <script src="{{ asset('/js/pace.min.js') }}"></script>
  <script src="{{ asset('/js/jquery.chocolat.js') }}"></script>
  <script src="{{ asset('/js/view/logicView.js') }}"></script>
  <script>
  $(function () {
    $('#table').DataTable({
      'paging'      : true,
      'responsive'  : true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
  </script>
  <script>
  $(document).ready(function(){
    function notifikasi(){
    $.ajax({
      url: '{{url('notifikasi')}}',    
      dataType:"json",    
      success: function(data) {
        var datanotif = $.parseJSON(JSON.stringify(data));
        $("#notifikasi").empty();
        if(datanotif.length == 0){
         
        }else{
          $.each(datanotif, function(key, value) {
            var link = '{{route('pendaftar.show', ':id')}}';
            link = link.replace(":id",datanotif[key].id);
            var bentuknotif = '<a href="'+ link +'" class="dropdown-item"><div class="dropdown-item-icon bg-info text-white"><i class="fas fa-users"></i></div><div class="dropdown-item-desc">' + datanotif[key].nama_seka_pendaftar + '<div class="time">'+ datanotif[key].created_at +'</div></div></a>';
            $("#notifikasi").append(bentuknotif);
          })
        }
      }
    });
  }
  notifikasi();
  var jeda = 15000;
  setInterval(function(){ notifikasi(); }, jeda);
  });
  </script>
  @include('sweetalert::alert')
  @section('javascript')

  @show
</body>
@endsection