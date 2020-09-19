@extends('layouts.apps')
@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
        <div class="form-group form-group-last">
            <div class="alert alert-secondary" role="alert">
                <div class="alert-icon"><i class="flaticon-email-black-circular-button kt-font-brand"></i></div>
                <div class="alert-text">
                    {{$data->perihal}}
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-2"></i>Pengirim</label>
            <div class="col-8">
                <span class="form-control">{{$data->nama}}</span>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-2"></i>Email</label>
            <div class="col-8">
                <span class="form-control">{{$data->email}}</span>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-2"></i>Phone</label>
            <div class="col-8">
                <span class="form-control">{{$data->phone}}</span>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-2"></i>Isi Pesan</label>
            <div class="col-8">
                <textarea row="5" class="form-control" disabled>{{$data->isi}}</textarea>
            </div>
        </div>
    </div>

</div>
@endsection