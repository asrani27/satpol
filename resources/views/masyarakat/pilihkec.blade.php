@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')

@endsection
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <form method="get" action="/masyarakat/keluhan/kecamatan">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-center">PILIH KECAMATAN</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="kecamatan_id" required>
                                        <option value="">-pilih-</option>
                                        @foreach ($data as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-block bg-gradient-primary"><strong><i class="fa fa-save"></i>
                        SELANJUTNYA</strong></button>
                <a href="/masyarakat" type="button" class="btn bg-gradient-secondary btn-block">
                    <i class="fa fa-arrow-left"></i> KEMBALI</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('js')

@endpush