@extends('panel.layouts.apps')
@include('panel.pages.submenu')
@section('content')

<link rel="stylesheet" href={!! asset("jsUpload/css/jquery.fileupload.css") !!}>
<link rel="stylesheet" href={!! asset("jsUpload/css/jquery.fileupload-ui.css") !!}>
 @if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <ul>
            <li>{{ $error }}</li>
        </ul>
    @endforeach
</div>
@endif
<form class="kt-form kt-form--label-right row" id="f_pages" action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="col-8">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body">
                <div class="form-group form-group-last">
                    <div class="alert alert-secondary" role="alert">
                        <div class="alert-icon"><i class="flaticon-add kt-font-brand"></i></div>
                        <div class="alert-text">
                            Add Page
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <input class="form-control" type="text" value="" id="judul" name="title" placeholder="Title">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <textarea class="form-control" name="content" id="content"></textarea>
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
    </div>
    <div class="col-4">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Media
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <input type="hidden" id="imageIdnews" value="" name="id_media">
                    <div class="col-12">
                        <div class="preview-pic"></div>
                    <hr/>
                    </div>
                    <div class="col-6 text-center">
                        <span class="btn btn-success fileinput-button col-12">
                            <span class="uploadnew ">Upload</span>
                            <span class="changeupload d-none">Change</span>
                            <input id="fileupload" type="file" name="files">
                        </span>
                    </div>
                    <div class="col-6 text-center">
                        <a href="#" class="btn btn-primary fileinput-button pilihgambar col-12">
                            Select
                        </a>
                        <a href="#" class="btn btn-danger fileinput-button hapusgambar d-none col-12">
                            Delete
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="ket_gambar" id="ket_gambar" cols="30" rows="3" placeholder="Image Caption"></textarea>
                </div>
            </div>
        </div>
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Status
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <select class="form-control select2" name="status" id="status">
                    <option value="1">Publish</option>
                    <option value="0">Draft</option>
                </select>
            </div>
        </div>
    </div>
</form>
@endsection
@push('script')
<script src="{!! asset("/js/jquery-ui.js") !!}"></script>
<script src="{!! asset("/js/jquery.fileupload.js") !!}"></script>
<script>
    $(document).ready(function(){
        $("#f_pages").validate( {
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
    tinymce.init({
        selector:'#content',
        height: 400,
        body_class: 'form-control',
        menubar:false,
        branding:false,
        plugins: "paste",
        paste_as_text: true,
    });
    $(function () {
        $('#fileupload').fileupload({
            url: '{!! route("media.ajaxstore") !!}',
            dataType: 'json',
            done: function (e,data) {
                console.log(data.result);
                var dataRes = data.result;
                if (dataRes.status == 1) {
                    $('.uploadnew').addClass('d-none');
                    $('.changeupload').removeClass('d-none');
                    $('.preview-pic').html('<img width="100%" src="{!! url("files") !!}/'+dataRes.path+'" />');
                    $('fileinput-button').html('Change Image');
                    $('#imageIdnews').val(dataRes.imageId);
                    $('.pilihgambar').addClass('d-none');
                    $('.hapusgambar').removeClass('d-none');
                    toastr.success(dataRes.message,"Success");
                } else {
                    toastr.error(dataRes.message,"Failed");

                }
            }
        });
    });
    $(document).on('click','.pilihgambar',function(e){
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-full');
        $modal.find(".modal-title").html("Select Image");
        $modal.find(".modal-body").html("");
        $.ajax({
            url:"{{ route('media.modal') }}",
            type:"GET",
            data:{},
            success:function(e){
                $modal.find(".modal-body").html(e);
            }
        });
        $modal.find(".modal-footer").html('');
        $modal.modal('show');
    });
    $(document).on('click','.choosepicture',function(e){
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-full');
        var id_gambar = $(this).attr('id-gambar');
        var path_gambar = $(this).attr('path-gambar');
        $('.preview-pic').html('<img width="100%" src="{!! url("files") !!}/'+path_gambar+'" />');
        $('#imageIdnews').val(id_gambar);
        $('.pilihgambar').addClass('d-none');
        $('.hapusgambar').removeClass('d-none');
        $modal.modal('hide');

    });
    $(document).on('click','.hapusgambar',function(e){
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        $('.preview-pic').html('');
        $('#imageIdnews').val('');
        $('.pilihgambar').removeClass('d-none');
        $('.hapusgambar').addClass('d-none');
        $('.uploadnew').removeClass('d-none');
        $('.changeupload').addClass('d-none');
    });
</script>
@endpush
