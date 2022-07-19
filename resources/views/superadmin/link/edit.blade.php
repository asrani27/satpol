@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
EDIT LINK
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <form method="post" action="/link/edit/{{$data->id}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">EDIT LINK</h3>
                            <div class="card-tools">
                                <a href="/link" type="button" class="btn bg-gradient-secondary btn-sm">
                                    <i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Parameter</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" value="{{$data->nama}}"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Value</label>
                                <div class="col-sm-10">
                                    <input type="text" name="link" class="form-control" value="{{$data->link}}"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-block bg-gradient-secondary"><strong><i
                                                class="fa fa-save"></i> UPLOAD</strong></button>
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