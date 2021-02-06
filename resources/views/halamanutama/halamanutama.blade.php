@extends('halamanutama.layout.layout_base')
@section('lokasi_kontent','Halaman Utama')
@section('kontent')
<nav class="navbar navbar-light bg-light static-top">
<div class="container">
    <a class="navbar-brand" href="#"><img src="{{ asset('images/kite-black.svg') }}" height="32px" width="32px"> YangLayang</a>
    <a class="btn btn-primary" href="{{ route('create') }}">Daftar</a>
</div>
</nav>

<!-- Masthead -->
<header class="masthead text-white text-center mouse scroll">
<div class="overlay"></div>
<div class="container">
    <div class="row">
    <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">Tunjukan Layanganmu</h1>
    </div>
    <div class="col-xl-9 mx-auto">
        <div class='icon-scroll'><div/>
    </div>
    </div>
</div>
</header>

<section class="features-icons text-center">
<div class="container">
    <div class="row">
    <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
        <h3>Tunjukan Kekompakan</h3>
        <p class="lead mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tempor justo et sodales dictum.</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
        <h3>Menangkan</h3>
        <p class="lead mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tempor justo et sodales dictum.</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
        <h3>Jalin Persahabatan</h3>
        <p class="lead mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tempor justo et sodales dictum.</p>
        </div>
    </div>
    </div>
</div>
</section>

<section class="testimonials text-center bg-light">
<div class="container">
    <h2>Berkenalan Dengan Juri</h2>
    <hr width="20%">
    <div class="row">
    <div class="col-lg-4">
        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
        <img class="img-fluid rounded-circle mb-3" src="{{ asset('images/testimonials-1.jpg') }}" alt="">
        <h5>Biang Puri.</h5>
        <p class="font-weight-light mb-0">"Pengusaha Tiying Banjar Kauh"</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
        <img class="img-fluid rounded-circle mb-3" src="{{ asset('images/testimonials-2.jpg') }}" alt="">
        <h5>Mang Soleh.</h5>
        <p class="font-weight-light mb-0">"2x Championship Layang-Layang Bebean Tingkat Banjar"</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
        <img class="img-fluid rounded-circle mb-3" src="{{ asset('images/testimonials-3.jpg') }}" alt="">
        <h5>Mbok Desak.</h5>
        <p class="font-weight-light mb-0">"Kurenanne Mang Soleh"</p>
        </div>
    </div>
    </div>
</div>
</section>

<!-- Call to Action -->
<section class="call-to-action text-white text-center">
<div class="overlay"></div>
<div class="container">
    <div class="row">
    <div class="col-xl-9 mx-auto">
        <h2 class="mb-4">Siap Untuk Mengadu Layanganmu!</h2>
    </div>
    <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
        <form>
        <div class="form">
            <div class="col">
            <a class="btn btn-block btn-lg btn-primary" href="{{ route('create') }}">Daftarkan Layanganmu</a>
            </div>
        </div>
        </form>
    </div>
    </div>
</div>
</section>

<!-- Footer -->
<footer class="footer bg-light">
<div class="container">
    <div class="row">
    <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
        <p class="text-muted small mb-4 mb-lg-0">&copy; ST. Kawe 2019. All Rights Reserved.</p>
    </div>
    <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
        <ul class="list-inline mb-0">
        <li class="list-inline-item mr-3">
            <a href="#">
            <i class="fab fa-facebook fa-2x fa-fw"></i>
            </a>
        </li>
        <li class="list-inline-item mr-3">
            <a href="#">
            <i class="fab fa-twitter-square fa-2x fa-fw"></i>
            </a>
        </li>
        <li class="list-inline-item">
            <a href="#">
            <i class="fab fa-instagram fa-2x fa-fw"></i>
            </a>
        </li>
        </ul>
    </div>
    </div>
</div>
</footer>
@endsection