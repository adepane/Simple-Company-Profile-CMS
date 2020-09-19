@extends('panel.layouts.apps')
@include('panel.kategori.submenu')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <label>Kategori Sudah Ada</label>
</div>
@endif
<form class="kt-form kt-form--label-right" id="f_kategori" action="{{ route('kategori.update',$data->id) }}" method="POST">
    @method("patch")
    @csrf
    <div class="kt-portlet kt-portlet--mobile">
        <input type="hidden" name="lastState" value="{{ url()->previous() }}">
        <div class="kt-portlet__body">
            <div class="form-group form-group-last">
                <div class="alert alert-secondary" role="alert">
                    <div class="alert-icon"><i class="flaticon-edit kt-font-brand"></i></div>
                    <div class="alert-text">
                        Edit Kategori
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-2">Nama Kategori</label>
                <div class="col-8">
                    <input class="form-control" type="text" value="{{ $data->name }}" id="judul_kategori" name="name"
                        placeholder="Nama Kategori">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-2">Slug</label>
                <div class="col-8">
                    <input class="form-control" type="text" value="{{ $data->slug }}" id="slug_kategori" name="slug">
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
<script>
    $(document).ready(function(){
        $("#f_kategori").validate( {
            rules: {
                title: {
                    required: !0
                }
            },
            errorPlacement:function(e, r) {
                var i=r.closest(".input-group");
                i.length?i.after(e.addClass("invalid-feedback")): r.after(e.addClass("invalid-feedback"));
            },
            invalidHandler:function(e, r) {
                KTUtil.scrollTop();
            }
        });
    });
</script>
@endsection