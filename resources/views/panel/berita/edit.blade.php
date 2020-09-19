@extends('panel.layouts.apps')
@include('panel.berita.submenu')
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
<form class="kt-form kt-form--label-right row" id="f_berita" action="{{ route('berita.update',$data->id) }}"
    method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    @method("patch")
    <div class="col-lg-8 col-sm-12">
        <div class="kt-portlet kt-portlet--mobile">
            <input type="hidden" name="lastState" value="{{ url()->previous() }}">
            <div id="tags_group">
                @foreach ($tags as $keyTag => $tag)
                <input type="hidden" value="{{ $keyTag }}" name="tags[]" class="settags-{{ $keyTag }}" />
                @endforeach
            </div>
            <div class="kt-portlet__body">
                <div class="form-group form-group-last">
                    <div class="alert alert-secondary" role="alert">
                        <div class="alert-icon"><i class="flaticon-edit kt-font-brand"></i></div>
                        <div class="alert-text">
                            Edit Berita
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input class="form-control" type="text" value="{{ $data->title }}" id="judul" name="title"
                        placeholder="Judul Berita">
                </div>

                <div class="form-group">
                    <textarea class="form-control" name="content" id="content">{{ $data->content }}</textarea>
                </div>

                <div class="form-group">
                    <input class="form-control" type="text" id="yt_video" name="yt_video"
                        placeholder="Youtube Video - contoh: https://www.youtube.com/watch?v=xxxxxxxxx"
                        value="{{ $data->yt_video }}">
                </div>
            </div>
        </div>
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Tags
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group">
                    <select class="form-control m-select2" id="kt_select2_11" multiple>
                        @foreach ($tags as $keyTag => $tag)
                        <option value="{{ $keyTag }}" title="{{ $tag }}" selected>{{ $tag }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Status
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group">
                    <select class="form-control select2" name="status" id="status">
                        <option value="1" {!!($data->status == 1)?"selected":""!!}>Publish</option>
                        <option value="0" {!!($data->status == 0)?"selected":""!!}>Draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Publish Date</label>
                    <input type="datetime-local" value="{{$data->publish_date->format('Y-m-d\TH:i:s')}}"
                        name="publish_date" class="form-control" />
                </div>
            </div>
        </div>
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Kategori
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group">
                    @php
                    $kategori = App\Models\Kategori::pluck('name','id')->all();
                    @endphp
                    <select class="form-control" name="kategori" id="kategori_berita">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $keyCat => $cat)
                        @if ($keyCat == $data->id_kategori)
                        <option value="{{ $keyCat }}" selected>{{ $cat }}</option>
                        @else
                        <option value="{{ $keyCat }}">{{ $cat }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
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
                    <input type="hidden" id="imageIdnews" value="{!!$data->id_media!!}" name="id_media">
                    <div class="col-12">
                        <div class="preview-pic">
                            @if (!empty($data->id_media))
                            @if (!empty($data->media->path))
                            <img src="{{ asset("files/".$data->media->path_220) }}" alt="" width="100%">
                            @else
                            Photo Telah Dihapus
                            @endif
                            @endif
                        </div>
                        <hr />
                    </div>
                    <div class="col-6 text-center">
                        <span class="btn btn-success fileinput-button col-12">
                            <span class="uploadnew {!! (!empty($data->id_media))?" d-none":"" !!}">Upload</span>
                            <span class="changeupload {!! (!empty($data->id_media))?"":" d-none" !!}">Ganti</span>
                            <input id="fileupload" type="file" name="files">
                        </span>
                    </div>
                    <div class="col-6 text-center">
                        <a href="#"
                            class="btn btn-primary fileinput-button pilihgambar col-12 {!! (!empty($data->id_media))?"
                            d-none":"" !!}">
                            Pilih
                        </a>
                        <a href="#"
                            class="btn btn-danger fileinput-button hapusgambar {!! (!empty($data->id_media))?"":"
                            d-none" !!} col-12">
                            Hapus
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="ket_gambar" id="ket_gambar" cols="30" rows="3"
                        placeholder="Keterangan Gambar"></textarea>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-12 col-sm-12">
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
        $("#f_berita").validate({
            rules: {
                title: {
                    required: !0
                },
                kategori: {
                    required: !0
                }
            },
            errorPlacement: function(e, r) {
                let i = r.closest(".input-group");
                i.length ? i.after(e.addClass("invalid-feedback")) : r.after(e.addClass(
                    "invalid-feedback"))
            },
            invalidHandler: function(e, r) {
                KTUtil.scrollTop();
            }
        });
    });
    tinymce.init({
        selector: '#content',
        height: 350,
        body_class: 'form-control',
        menubar: false,
        branding: false,
        plugins: "paste",
        paste_as_text: true,
    });
    $('#kt_select2_11').select2({
        placeholder: "Tambahkan Tag, Pisahkan dengan Koma",
        tags: true,
        tokenSeparators: [','],
        maximumSelectionLength: 3,
        minimumResultsForSearch: -1
    }).on("select2:select", function(e) {
        let tagName = e.params.data.text;
        axios({
                url: "{!! route('berita.addTags') !!}",
                method: "post",
                data: {
                    "_token": "{!! csrf_token() !!}",
                    "dataTag": tagName
                },
            })
            .then(response => {
                if (response.data.status == 1) {
                    $('#tags_group').append("<input type='hidden' name='tags[]' value='" + response.data
                        .tagId +
                        "' set-tag='" + tagName + "'/>")
                }
            });
    }).on("select2:unselect", function(e) {
        let idTag = e.params.data.id;
        $('.settags-' + idTag).remove();
    });
    $('#kt_select2_11').on("select2:unselect", function(e) {
        let tagNameUn = e.params.data.text;
        $('input[set-tag="' + tagNameUn + '"]').remove();
    });
    $('#kategori_berita').select2();
    $(function() {
        $('#fileupload').fileupload({
            url: '{!! route("media.ajaxstore") !!}',
            dataType: 'json',
            done: function(e, data) {
                console.log(data.result);
                let dataRes = data.result;
                if (dataRes.status == 1) {
                    $('.uploadnew').addClass('d-none');
                    $('.changeupload').removeClass('d-none');
                    $('.preview-pic').html('<img width="100%" src="{!! url("files") !!}/' + dataRes
                        .path + '" />');
                    $('fileinput-button').html('Ganti Gambar');
                    $('#imageIdnews').val(dataRes.imageId);
                    $('.pilihgambar').addClass('d-none');
                    $('.hapusgambar').removeClass('d-none');
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
        let $modal = $('#modal-full');
        $modal.find(".modal-title").html("Pilih Gambar");
        $modal.find(".modal-body").html("");
        axios.get("{{ route('media.modal') }}")
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
        let $modal = $('#modal-full');
        let id_gambar = $(this).attr('id-gambar');
        let path_gambar = $(this).attr('path-gambar');
        $('.preview-pic').html('<img width="100%" src="{!! url("files") !!}/' + path_gambar + '" />');
        $('#imageIdnews').val(id_gambar);
        $('.pilihgambar').addClass('d-none');
        $('.hapusgambar').removeClass('d-none');
        $modal.modal('hide');
    });
    $(document).on('click', '.hapusgambar', function(e) {
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