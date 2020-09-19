@extends('panel.layouts.apps')
@include('panel.menu.submenu')
@section('content')
@if(session()->has('message'))
<div class="alert alert-error">
    {{ session()->get('message') }}
</div>
@endif
<form class="kt-form kt-form--label-right" id="editMenu" action="{{ route('menu.update',$data->id) }}" method="POST">
@method("patch")
@csrf
    <div class="kt-portlet kt-portlet--mobile">
        <input type="hidden" name="lastState" value="{{ url()->previous() }}">
        <div class="kt-portlet__body">
            <div class="form-group form-group-last">
                <div class="alert alert-secondary" role="alert">
                    <div class="alert-icon"><i class="flaticon-edit kt-font-brand"></i></div>
                    <div class="alert-text">
                        Edit Menu
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-2">Nama Menu</label>
                <div class="col-8">
                    <input class="form-control" type="text" value="{{ $data->name }}" id="title" name="name"
                        placeholder="Nama Menu">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-2">Slug</label>
                <div class="col-8">
                    <input class="form-control" type="text" value="{{ $data->slug }}" id="title" name="name"
                        placeholder="Slug">
                </div>
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        <button class="btn btn-success" type="submit">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
@section('script')
@endsection