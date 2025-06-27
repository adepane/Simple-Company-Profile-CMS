@extends('panel.layouts.apps')
@include('panel.document.submenu')
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <ul>
        <li>{{ $error }}</li>
    </ul>
    @endforeach
</div>
@endif
<form class="kt-form kt-form--label-right" id="f_document" action="{{ route('document.store') }}" method="POST"
    enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Media Document
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="filepdf" name="filepdf[]" multiple>
                    <label class="custom-file-label" for="filepdf">Pilih file</label>
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