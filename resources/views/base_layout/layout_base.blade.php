<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="expires" content="0">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>YangLayang | @yield('lokasi_kontent')</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('/css/pace.min.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
  
  <link rel="stylesheet" href="{{ asset('/css/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/responsive.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/datepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/chocolat.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.13/dist/esri-leaflet-geocoder.css" integrity="sha512-v5YmWLm8KqAAmg5808pETiccEohtt8rPVMGQ1jA6jqkWVydV5Cuz3nJ9fQ7ittSxvuqsvI9RSGfVoKPaAJZ/AQ==" crossorigin="">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-search@2.4.0/dist/leaflet-search.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="" />
  <!-- Global JQuery -->
  <script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>

</head>
    @yield('base_kontent')
</html>
