@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
TAMBAH SATUAN
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <form method="post" action="/data/keluhanwa/kepetugas/{{$data->id}}/kirim">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">DATA PETUGAS</h3>
                            <div class="card-tools">
                                <a href="/data/keluhanwa" type="button" class="btn bg-gradient-secondary btn-sm">
                                    <i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Petugas</label>
                            <div class="col-sm-10">
                            <select name="pegawai_id" class="form-control select2">
                                @foreach ($pegawai as $item)
                                    <option value="{{$item->id}}" {{$data->pegawai_id}}>{{$item->nama}}</option>
                                @endforeach
                            </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-block bg-gradient-secondary"><strong><i
                                            class="fa fa-send"></i> KIRIM PESAN</strong></button>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('js')

@endpush
