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
        <form method="post" action="/masyarakat/keluhan/kecamatan" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-center">PILIH KELURAHAN</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="kelurahan_id" required>
                                        <option value="">-pilih-</option>
                                        @foreach ($kel as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-center">PILIH KATEGORI</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="kategori_id" required>
                                        <option value="">-pilih-</option>
                                        @foreach ($kat as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-center">ALAMAT/LOKASI</label>
                                <div class="col-sm-10">
                                    <textarea name="alamat" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-center">ISI KELUHAN</label>
                                <div class="col-sm-10">
                                    <textarea name="isi" rows="4" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-center">FOTO</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block bg-gradient-primary"><strong><i class="fa fa-save"></i>
                            KIRIM</strong></button>
                    <a href="/masyarakat/keluhan" type="button" class="btn bg-gradient-secondary btn-block">
                        <i class="fa fa-arrow-left"></i> KEMBALI</a>
                </div>
        </form>
    </div>
</div>

@endsection

@push('js')

@endpush