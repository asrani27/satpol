@extends('frontend.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endpush
@section('title')
<strong>SIPADU</strong>
@endsection
@section('slide')
<div class="row">
    <div class="col-md-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="padding:0px 0px;">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                @foreach ($slide as $item)
                <div class="carousel-item {{$item->id == 1 ? 'active':''}}">
                    <img class="d-block w-100" src="/storage/slideshow/{{$item->file}}" height="170px"
                        alt="First slide">
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-custom-icon" aria-hidden="true">
                    <i class="fas fa-chevron-left"></i>
                </span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-custom-icon" aria-hidden="true">
                    <i class="fas fa-chevron-right"></i>
                </span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<br />
<div class="row">
    <div class="col-md-12 text-center">
        <a href="{{$website}}" class="btn btn-app bg-gradient-info">
            <i class="fas fa-blog"></i> WEBSITE
        </a>
        <a href="{{$jdih}}" class="btn btn-app bg-gradient-info">
            <i class="fas fa-file"></i> JDIH
        </a>
        <a href="/profilsatpol" class="btn btn-app bg-gradient-info">
            <i class="fas fa-building"></i> PROFIL
        </a>
        <a href="{{$ppid}}" class="btn btn-app bg-gradient-info">
            <i class="fas fa-newspaper"></i> PPID
        </a>
        <a href="/kontaksatpol" class="btn btn-app bg-gradient-info">
            <i class="fas fa-phone"></i> KONTAK
        </a>
        <a href="{{$elapor}}" class="btn btn-app bg-gradient-info">
            <i class="fas fa-mitten"></i> E-LAPOR
        </a>
        <a href="{{$instagram}}" class="btn btn-app bg-danger">
            <ion-icon name="logo-instagram" size="small"></ion-icon><br />INSTAGRAM
        </a>
        <a href="{{$whatsapp}}" class="btn btn-app bg-success">
            <ion-icon name="logo-whatsapp" size="small"></ion-icon><br />WHATSAPP
        </a>
        <a href="{{$facebook}}" class="btn btn-app bg-primary">
            <ion-icon name="logo-facebook" size="small"></ion-icon><br />FACEBOOK
        </a>
    </div>
</div>
<div class="row text-center">
    <div class="col-md-12">
        <strong>SEKILAS INFO</strong>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @foreach ($berita as $item)
        <div class="card card-widget widget-user">
            <div class="widget-user-header text-white"
                style="background: url('/storage/berita/{{$item->gambar}}') center center; background-size:cover">
            </div>
            <div class="card-footer p-1 text-center">
                {{$item->judul}}
            </div>
        </div>
        @endforeach

    </div>
</div>
<br />
<br />
@endsection
@push('js')
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
@endpush