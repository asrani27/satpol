@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endpush
@section('title')
<strong>BERANDA</strong>
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-lg-12">
        <div class="card card-widget">
            <div class="card-header">
                <div class="user-block">
                    <span class="username"><a href="#">Hi, {{Auth::user()->name}}</a></span>
                    <span class="description">SELAMAT DATANG DI APLIKASI LAPORAN SATPOL PP</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">

    </div>
</div>

@endsection

@push('js')

@endpush