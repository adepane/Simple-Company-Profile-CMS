@extends('panel.layouts.apps')
@include('panel.post.submenu')
@section('content')
    <link rel="stylesheet" href="{!! asset("/jsUpload/css/jquery.fileupload.css") !!}">
    <link rel="stylesheet" href="{!! asset("/jsUpload/css/jquery.fileupload-ui.css") !!}">
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <ul>
                    <li>{{ $error }}</li>
                </ul>
            @endforeach
        </div>
    @endif
    <form class="kt-form kt-form--label-right row parsley-validated" id="f_berita" action="{{ route('post.store') }}"
          method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="col-lg-8 col-sm-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div id="tags_group"></div>
                <div class="kt-portlet__body">
                    <div class="form-group form-group-last">
                        <div class="alert alert-secondary" role="alert">
                            <div class="alert-icon"><i class="flaticon-add kt-font-brand"></i></div>
                            <div class="alert-text">
                                Tambah Berita
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="text" value="" id="judul" name="title"
                               placeholder="Judul Berita"
                               required>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" name="content" id="content" required></textarea>
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="url" value="" id="yt_video" name="yt_video"
                               placeholder="Youtube Video - contoh: https://www.youtube.com/watch?v=xxxxxxxxx">
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
                            <option></option>
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
                            <option value="1">Publish</option>
                            <option value="0">Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Publish Date</label>
                        <input type="datetime-local" name="publish_date" class="form-control"/>
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
                        <?php
                        $kategori = App\Models\Category::pluck('name', 'id')->all();
                        ?>
                        <select class="form-control" name="kategori" id="kategori_berita" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $keyCat => $cat)
                                <option value="{{ $keyCat }}">{{ $cat }}</option>
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
                        <input type="hidden" id="imageIdnews" value="" name="id_media">
                        <div class="col-12">
                            <div class="preview-pic"></div>
                            <hr/>
                        </div>
                        <div class="col-6 text-center">
                        <span class="btn btn-success fileinput-button col-12">
                            <span class="uploadnew ">Upload</span>
                            <span class="changeupload d-none">Ganti</span>
                            <input id="fileupload" type="file" name="files">
                        </span>
                        </div>
                        <div class="col-6 text-center">
                            <a href="#" class="btn btn-primary fileinput-button pilihgambar col-12">
                                Pilih
                            </a>
                            <a href="#" class="btn btn-danger fileinput-button hapusgambar d-none col-12">
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
        $(document).ready(function () {
            Date.prototype.addHours = function (h) {
                this.setTime(this.getTime() + (h * 60 * 60 * 1000));
                return this;
            }
            $("input[name='publish_date']").val(new Date().addHours(7).toJSON().slice(0, 19));
            $("#f_berita").validate({
                rules: {
                    title: {
                        required: !0
                    },
                    kategori: {
                        required: !0
                    }
                },
                errorPlacement: function (e, r) {
                    var i = r.closest(".input-group");
                    i.length ? i.after(e.addClass("invalid-feedback")) : r.after(e.addClass(
                        "invalid-feedback"));
                },
                invalidHandler: function (e, r) {
                    KTUtil.scrollTop();
                }
            });
        });
        tinymce.init({
            selector: '#content',
            height: 300,
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
            minimumResultsForSearch: -1
        }).on("select2:select", function (e) {
            let tagName = e.params.data.text;
            axios({
                url: "{!! route('post.addTags') !!}",
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
        }).on("select2:unselect", function (e) {
            let tagNameUn = e.params.data.text;
            $('input[set-tag="' + tagNameUn + '"]').remove();
        });
        $('#kategori_berita').select2();
        $(function () {
            $('#fileupload').fileupload({
                url: '{!! route("media.ajaxstore") !!}',
                dataType: 'json',
                done: function (e, data) {
                    var dataRes = data.result;
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
        $(document).on('click', '.pilihgambar', function (e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            var $modal = $('#modal-full');
            $modal.find(".modal-title").html("Pilih Gambar");
            $modal.find(".modal-body").html("");
            axios.get("{{ route('media.modal') }}")
                .then(response => {
                    $modal.find(".modal-body").html(response.data);
                });
            $modal.find(".modal-footer").html('');
            $modal.modal('show');
        });
        $(document).on('click', '.choosepicture', function (e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            var $modal = $('#modal-full');
            var id_gambar = $(this).attr('id-gambar');
            var path_gambar = $(this).attr('path-gambar');
            $('.preview-pic').html('<img width="100%" src="{!! url("files") !!}/' + path_gambar + '" />');
            $('#imageIdnews').val(id_gambar);
            $('.pilihgambar').addClass('d-none');
            $('.hapusgambar').removeClass('d-none');
            $modal.modal('hide');
        });
        $(document).on('click', '.hapusgambar', function (e) {
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
