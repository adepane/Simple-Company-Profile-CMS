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
    <form class="kt-form kt-form--label-right parsley-validated" id="f_slider" action="{{ route('slider.update',$data->id) }}"
        method="POST" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div id="tags_group"></div>
        <div class="kt-portlet__body">
            <div class="form-group form-group-last">
                <div class="alert alert-secondary" role="alert">
                    <div class="alert-icon"><i class="flaticon-edit kt-font-brand"></i></div>
                    <div class="alert-text">
                        Edit Slide
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-2">Slide Title</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="{{ $data->title }}" id="title" name="title"
                        placeholder="Title" required>
                </div>
            </div>

            <div class="form-group row">
                <input type="hidden" id="imageIdnews" value="{{ $data->id_media }}" name="id_media">
                <div class="offset-2 col-10">
                    <div class="preview-pic">
                        @if (!empty($data->id_media))
                        @if (!empty($data->media->path))
                        <img src="{{ asset("files/".$data->media->path) }}" width="100%" alt="">
                        @else
                        Photo Telah Dihapus
                        @endif

                        @endif
                    </div>
                    <hr />
                    <div class="offset-4">
                        <span class="btn btn-success fileinput-button">
                            <i class="fa fa-upload"></i>
                            <span class="changeupload {!! (!empty($data->id_media))?"":" d-none" !!}">Ganti
                                Gambar</span>
                            <span class="uploadnew {!! (!empty($data->id_media))?" d-none":"" !!}">Unggah Gambar</span>

                            <input id="fileupload" type="file" name="files">
                        </span>
                        <a href="#" class="btn btn-primary fileinput-button pilihgambar">
                            <i class="fa fa-external-link-alt"></i>
                            Pilih Gambar
                        </a>

                    </div>

                </div>
            </div>

            @foreach (json_decode($data->desc) as $keys => $desc)
            <div class="form-group row">
                <label class="col-form-label col-2">Text {{ $keys+1 }}</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="{{ $desc }}" name="desc[]">
                </div>
            </div>
            @endforeach

            <div class="form-group row">
                <label class="col-form-label col-2">Urutan</label>
                <div class="col-10">
                    <input class="form-control" type="number" value="{{ $data->order }}" name="order" required>
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
            // type:"POST",
            dataType: 'json',
            done: function(e, data) {
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
        axios.get("{!! route('media.modal') !!}")
        .then(response => {
            $modal.find(".modal-body").html(response.data);
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