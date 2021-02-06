@extends('base_layout.layout_base')
@section('lokasi_kontent',"Login")
@section('base_kontent')
<body>
<div id="app">
<section class="section">
  <div class="d-flex flex-wrap align-items-stretch">
	<div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
	  <div class="p-4 m-3">
		<img src="{{ asset('images/kite.svg') }}" height="64px" width="64px">
		<h4 class="text-dark font-weight-normal">Selamat Datang di <span class="font-weight-bold">YangLayang</span></h4>
		<p class="text-muted">Sebelum memulai sesi, anda di wajibkan untuk login terlebih dahulu.</p>
		<form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
		{{ csrf_field() }}
		  <div class="form-group">
			<label for="email">Username</label>
			<input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" tabindex="1" required autofocus>
			<div id="email-invalid" class="invalid-feedback">
			  Harap isi Username anda.
			</div>
		  </div>

		  <div class="form-group">
			<div class="d-block">
			  <label for="password" class="control-label">Password</label>
			</div>
			<input id="password" type="password" class="form-control" name="password" tabindex="2" required>
			<div id="password-invalid" class="invalid-feedback">
			  Harap isi Password anda.
			</div>
		  </div>

		  <div class="form-group text-right">
			<button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
			  Login
			</button>
		  </div>
		</form>

		<div class="text-center mt-5 text-small">
		  Made with <i class="fa fa-heart"></i> & <i class="fa fa-coffee"></i>
		</div>
	  </div>
	</div>
	<div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{ asset('images/bg-masthead2.jpg') }}">
	  <div class="absolute-bottom-left index-2">
		<div class="text-light p-5 pb-2">
		  <div>
			<h1 class="mb-2 display-4 font-weight-bold"></h1>
			<h5 class="font-weight-normal text-muted-transparent"></h5>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</section>
</div>
	<!-- General JS Scripts -->
	<script src="{{ asset('/js/popper.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-timepicker.min.js') }}"></script>
	<script src="{{ asset('/js/jquery.nicescroll.min.js') }}"></script>

	<!-- Template JS File -->
	<script src="{{ asset('/js/scripts.js') }}"></script>
	<script src="{{ asset('/js/custom.js') }}"></script>
	@include('sweetalert::alert')
	@if($errors->has('email'))
	<script>
		$('#email').addClass('is-invalid');
		Swal.fire("Kesalahan!","{{ $errors->first('email') }}","error");
	</script>
	@else
	<script>
		$('#email').removeClass('is-invalid');
	</script>
	@endif

</body>
@endsection