@extends('panel.layouts.apps')
@include('panel.menu.submenu')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Menu
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">

        <form class="kt-form kt-form--label-right" id="addmenu" action="{{ route('menu.store') }}" method="POST">
            {{csrf_field()}}
            <div class="kt-portlet__body">
                <div class="form-group form-group-last">
                    <div class="alert alert-secondary" role="alert">
                        <div class="alert-icon"><i class="flaticon-add kt-font-brand"></i></div>
                        <div class="alert-text">
                            Tambah Menu
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-2">Nama Layout</label>
                    <div class="col-8">
                        <input class="form-control" type="text" value="" id="judul_tags" name="name"
                            placeholder="Nama Layout">
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
        </form>
    </div>
</div>
@endsection
@section('script')

@endsection