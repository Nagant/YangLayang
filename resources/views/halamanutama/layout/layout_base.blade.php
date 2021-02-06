<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>YangLayang - @yield('lokasi_kontent')</title>
  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="{{ asset('/css/customlanding.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link href="{{ asset('/css/landing-page.min.css') }}" rel="stylesheet">
  <script src="{{ asset('/js/jquery.min.js') }}"></script>
  @include('sweetalert::alert')
</head>
<body>

    @yield('kontent')

  <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>