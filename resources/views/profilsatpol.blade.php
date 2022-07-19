@extends('frontend.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endpush
@section('title')
<strong>PROFIL SATPOL</strong>
@endsection
@section('slide')

@endsection

@section('content')
<br />
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                {!!$data!!}
            </div>
        </div>

    </div>
</div>
<br />
<br />
@endsection
@push('js')
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
@endpush