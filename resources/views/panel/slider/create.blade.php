@extends('panel.layouts.apps')
@include('panel.slider.submenu')
@section('content')

<link rel="stylesheet" href={!! asset("jsUpload/css/jquery.fileupload.css") !!}>
<link rel="stylesheet" href={!! asset("jsUpload/css/jquery.fileupload-ui.css") !!}>
<div class="kt-portlet kt-portlet--mobile">
    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <ul>
            <li>{{ $error }}</li>
        </ul>
        @endforeach
    </div>
    @endif
    <form class="kt-form kt-form--label-right parsley-validated" id="f_slider" action="{{ route('slider.store') }}"
        method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div id="tags_group"></div>
        <div class="kt-portlet__body">
            <div class="form-group form-group-last">
                <div class="alert alert-secondary" role="alert">
                    <div class="alert-icon"><i class="flaticon-add kt-font-brand"></i></div>
                    <div class="alert-text">
                        Tambah Slide
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-2">Slide Title</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" id="title" name="title" placeholder="Title"
                        required>
                </div>
            </div>

            <div class="form-group row">
                <input type="hidden" id="imageIdnews" value="" name="media_id">
                <div class="offset-2 col-10">
                    <div class="preview-pic"></div>
                    <hr />
                    <div class="offset-4">
                        <span class="btn btn-success fileinput-button">
                            <i class="fa fa-plus"></i>
                            <span class="uploadnew">Unggah Gambar</span>
                            <span class="changeupload d-none">Ganti Gambar</span>
                            <input id="fileupload" type="file" name="files">
                        </span>
                        <a href="#" class="btn btn-primary fileinput-button pilihgambar">
                            <i class="fa fa-external-link-alt"></i>
                            Pilih Gambar
                        </a>
                    </div>

                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-2">Text 1</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" name="desc[]">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-2">Text 2</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" name="desc[]">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-2">Text 3</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" name="desc[]">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-2">Urutan</label>
                <div class="col-10">
                    <input class="form-control" type="number" value="" name="order" required>
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
@endsection
@push('script')
<script src="{!! asset("/js/jquery-ui.js") !!}"></script>
<script src="{!! asset("/js/jquery.fileupload.js") !!}"></script>
<script>
    $(function() {
        $('#fileupload').fileupload({
            url: '{!! route("media.ajaxstore") !!}',
            dataType: 'json',
            done: function(e, data) {
                console.log(data.result);
                var dataRes = data.result;
                if (dataRes.status == 1) {
                    $('.uploadnew').addClass('d-none');
                    $('.changeupload').removeClass('d-none');
                    $('.preview-pic').html('<img width="100%" src="{!! url("files") !!}/' + dataRes
                        .path + '" />');
                    $('fileinput-button').html('Ganti Gambar');
                    $('#imageIdnews').val(dataRes.imageId);
                    toastr.success(dataRes.message, "Success");
                } else {
                    toastr.error(dataRes.message, "Failed");
                }
            }
        });
    });
    $(document).on('click', '.pilihgambar', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-full');
        $modal.find(".modal-title").html("Pilih Gambar");
        $modal.find(".modal-body").html("");
        $.ajax({
            url: "{{ route('media.modal') }}",
            type: "GET",
            data: {},
            success: function(e) {
                $modal.find(".modal-body").html(e);
            }
        });
        $modal.find(".modal-footer").html('');
        $modal.modal('show');
    });
    $(document).on('click', '.choosepicture', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-full');
        var id_gambar = $(this).attr('id-gambar');
        var path_gambar = $(this).attr('path-gambar');
        $('.preview-pic').html('<img width="100%" src="{!! url("files") !!}/' + path_gambar + '" />');
        $('#imageIdnews').val(id_gambar);
        $modal.modal('hide');
    });
</script>
@endpush
