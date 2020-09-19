@extends('panel.layouts.apps')
@include('panel.gallery.submenu')
@section('content')
<link rel="stylesheet" href={!! asset("/jsUpload/css/jquery.fileupload.css") !!}>
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <ul>
        <li>{{ $error }}</li>
    </ul>
    @endforeach
</div>
@endif
<form class="kt-form kt-form--label-right row" id="f_gallery" action="{{ route('gallery.update',$data->id) }}"
    method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    @method('patch')
    <div class="col-md-9">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body">
                <div class="form-group form-group-last">
                    <div class="alert alert-secondary" role="alert">
                        <div class="alert-icon"><i class="flaticon-add kt-font-brand"></i></div>
                        <div class="alert-text">
                            Tambah Galeri
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <input class="form-control" type="text" value="{{$data->title}}" id="judul" name="title"
                            placeholder="isi Judul">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Tambah Media
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-12 text-center">
                        <span class="">
                            <button type="button" class="btn btn-success fileinput-button col-12 addmore">Add
                                More</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 row">
        <div class="card-columns" id="medias">
            @foreach ($data->gallerymedias as $key => $item)
            <div class="card countmedia ">
                <div class="card-body media_party_{{$key}}">
                    <div class="form-group row">
                        <input type="hidden" id="imageIdnews_{{$key}}" value="{{$item->id}}" name="id_media[{{$key}}]">
                        <div class="col-12">
                            <div class="preview-pic_{{$key}}">
                                @if (!empty($item->path))
                                <img src="{{ asset("files/".$item->path_220) }}" alt="" width="100%">
                                @else
                                Photo Telah Dihapus
                                @endif
                            </div>
                            <hr />
                        </div>
                        <div class="col-6 text-center">
                            <span class="btn btn-success fileinput-button col-12 fileinput_{{$key}} d-none">
                                <span class="uploadnew uploadmedia_{{$key}}">Upload</span>
                                <input id="fileupload_{{$key}}" type="file" name="files" data-value-media="{{$key}}"
                                    onclick="uploadFileMedia({{$key}})">
                            </span>
                        </div>
                        <div class="col-6 text-center">

                            <button type="button"
                                class="btn btn-primary fileinput-button pilihgambar col-12 pilihmedia_{{$key}} d-none"
                                pilih-media="{{$key}}">
                                Pilih
                            </button>
                            <button type="button"
                                class="btn btn-danger fileinput-button hapusgambar col-12 hapusmedia_{{$key}}"
                                hapus-media="{{$key}}">
                                Hapus
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="ket_gambar[{{$key}}]" cols="30" rows="3"
                            placeholder="Keterangan Gambar">{{$item->pivot->photo_desc}}</textarea>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-10">
                            <button class="btn btn-success" type="submit">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('script')
<script src="{!! asset("/js/jquery-ui.js") !!}"></script>
<script src="{!! asset("/js/jquery.fileupload.js") !!}"></script>
<script>
    $(document).ready(function() {
        $("#f_gallery").validate({
            rules: {
                title: {
                    required: !0
                }
            },
            errorPlacement: function(e, r) {
                var i = r.closest(".input-group");
                i.length ? i.after(e.addClass("invalid-feedback")) : r.after(e.addClass(
                    "invalid-feedback"));
            },
            invalidHandler: function(e, r) {
                KTUtil.scrollTop();
            }
        });
    });
    $(document).on('click', '.addmore', function(e) {
        var countMedia = $('.countmedia').length;
        var newMedia = countMedia;
        $('#medias').append(`
            <div class="card countmedia">
                <div class="card-body media_party_${newMedia}">
                    <div class="form-group row">
                        <input type="hidden" id="imageIdnews_${newMedia}" value="" name="id_media[${newMedia}]">
                        <div class="col-12">
                            <div class="preview-pic_${newMedia}"></div>
                            <hr/>
                        </div>
                        <div class="col-6 text-center">
                            <span class="btn btn-success fileinput-button col-12 fileinput_${newMedia} ">
                                <span class="uploadnew uploadmedia_${newMedia}">Upload</span>
                                <input id="fileupload_${newMedia}" type="file" name="files" data-value-media="${newMedia}" onclick="uploadFileMedia(${newMedia})">
                            </span>
                        </div>
                        <div class="col-6 text-center">
                            <button type="button" class="btn btn-primary fileinput-button col-12 pilihmedia_${newMedia}" pilih-media=" ${newMedia}" onclick="pilihGambar(${newMedia})">Pilih</button>
                            <button type="button" class="btn btn-danger fileinput-button hapusgambar d-none col-12 hapusmedia_${newMedia}" hapus-media=" ${newMedia}">Hapus</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="ket_gambar[${newMedia}]" cols="30" rows="3" placeholder="Keterangan Gambar"></textarea>
                    </div>
                </div>
            </div>
            `);
    });

    function uploadFileMedia(dataMedia) {
        $('#fileupload_' + dataMedia).fileupload({
            url: '{!! route("media.ajaxstore") !!}',
            dataType: 'json',
            done: function(e, data) {
                var dataRes = data.result;
                if (dataRes.status == 1) {
                    var getMediaIds = data.valueMedia;
                    $('.preview-pic_' + getMediaIds).html('<img width="100%" src="{!! url("files") !!}/' + dataRes.path + '" />');
                    $('#imageIdnews_' + getMediaIds).val(dataRes.imageId);
                    $('.pilihmedia_' + getMediaIds).addClass('d-none');
                    $('.fileinput_' + getMediaIds).addClass('d-none');
                    $('.hapusmedia_' + getMediaIds).removeClass('d-none');
                    toastr.success(dataRes.message, "Success");
                } else {
                    toastr.error(dataRes.message, "Failed");
                }
            }
        });
    }

    function pilihGambar(datamedia) {
        var $modal = $('#modal-full');
        var mediaIds = parseInt(datamedia);
        $modal.find(".modal-title").html("Pilih Gambar");
        $modal.find(".modal-body").html("");
        axios.get("{!!route('media.modal_gallery')!!}",{
            params: {
                'mediaIds':mediaIds,
            }
        })
        .then(response => {
            $modal.find(".modal-body").html(response.data)
        });
        $modal.find(".modal-footer").html('');
        $modal.modal('show');
    }
    // });
    $(document).on('click', '.choosepicture', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-full');
        var id_gambar = $(this).attr('id-gambar');
        var path_gambar = $(this).attr('path-gambar');
        var getMediaIds = $(this).attr('value-media-ids');
        $('.preview-pic_' + getMediaIds).html('<img width="100%" src="{!! url("files") !!}/' + path_gambar +
            '" />');
        $('#imageIdnews_' + getMediaIds).val(id_gambar);
        $('.pilihmedia_' + getMediaIds).addClass('d-none');
        $('.fileinput_' + getMediaIds).addClass('d-none');
        $('.hapusmedia_' + getMediaIds).removeClass('d-none');
        $modal.modal('hide');
    });
    $(document).on('click', '.hapusgambar', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var getMediaIds = $(this).attr('hapus-media');
        $('.media_party_' + getMediaIds).remove();
    });
</script>
@endpush