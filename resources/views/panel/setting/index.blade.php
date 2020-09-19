@extends('panel.layouts.apps')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <ul>
        <li>{!! $error !!}</li>
    </ul>
    @endforeach
</div>
@endif
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-gear"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Settings
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <form action="{{ route('setting.store') }}" id="f_setting" class="parsley-validated form-horizontal"
            method="POST" enctype="multipart/form-data" parsley-validated="true">
            {{csrf_field()}}
            @foreach ($data as $key => $item)
            <div class="form-group row">
                <label class="control-label col-sm-2">{!!$item['name']!!}</label>
                <div class="col-sm-10">
                    <div class="col-sm-12 {!! (!empty($dataSetting[$key]))?'value-'.$dataSetting[$key]['id']:'' !!}"
                        data-name="{!!$item['value']!!}" data-type="{!!$item['type']!!}">
                        @switch($item['type'])
                        @case('textarea')
                        <textarea name="sets[text][{!!$item['value']!!}]" id="" rows="4"
                            class="form-control">{!!(!empty($dataSetting[$key])?$dataSetting[$key]['val']:"")!!}</textarea>
                        @break
                        @case('file')
                        @if (!empty($dataSetting[$key]))
                        <img class="img-fluid" alt="" id="preview_{!!$item['value']!!}"
                            src="{!!asset('files/'.$dataSetting[$key]['val'])!!}" width="145">
                        <button type="button" value-id="{!!$dataSetting[$key]['id']!!}" value-set="{!!$item['value']!!}"
                            class="btn btn-secondary delete_photo" id="btn_{!!$item['value']!!}">Delete</button>
                        @else
                        <input name="sets[file][{!!$item['value']!!}]" type="{!!$item['type']!!}" value=""
                            class="filestyle parsley-validated" data-buttonname="btn-secondary"
                            parsley-filetype-message="File type not allowed" parsley-filetype="jpg|JPG|png|PNG"
                            parsley-error-container="#{!!$item['value']!!}" />
                        <span id="{!!$item['value']!!}"></span>
                        @endif
                        @break
                        @case('select')
                        <select name="sets[text][{!!$item['value']!!}]" id="" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach ($item['options'] as $keyOpt => $option)
                            <option value="{!!$keyOpt!!}" {!!(!empty($dataSetting[$key]) &&
                                $dataSetting[$key]['val']==$keyOpt)?'selected':""!!}>{!!$option!!}
                            </option>
                            @endforeach
                        </select>

                        @break
                        @case('hr')
                        <hr>
                        <h4>{!!$item['name']!!}</h4>
                        @break
                        @default
                        <input name="sets[text][{!!$item['value']!!}]" type="{!!$item['type']!!}"
                            value="{!!(!empty($dataSetting[$key])?$dataSetting[$key]['val']:"")!!}"
                            class="form-control" />
                        @endswitch
                    </div>
                </div>
            </div>
            @endforeach
            <button class="btn btn-info" type="submit">Submit</button>
        </form>

    </div>
</div>
@endsection
@push('script')
<script src="{!!asset('/js/parsley.min.js')!!}"></script>
<script>
    $(function() {
        $('#f_setting').parsley({
            validators: {
                filemaxsize: function() {
                    return {
                        validate: function(val, max_megabytes, parsleyField) {
                            if (!Modernizr.fileapi) {
                                return true;
                            }
                            var file_input = $(parsleyField.element);
                            if (file_input.is(':not(input[type="file"])')) {
                                console.log(
                                    "Validation on max file size only works on file input types"
                                );
                                return true;
                            }
                            var max_bytes = max_megabytes * BYTES_PER_MEGABYTE,
                                files = file_input.get(0).files;
                            if (files.length == 0) {
                                return true;
                            }
                            return files.length == 1 && files[0].size <= max_bytes;
                        },
                        priority: 3
                    };
                },
                filetype: function() {
                    return {
                        validate: function(val, requirement) {
                            var fileExtension = val.split('.').pop();
                            var fileExtensionExplode = requirement.split('|');
                            var checkExt = fileExtensionExplode.indexOf(fileExtension);
                            return fileExtension === fileExtensionExplode[checkExt];
                        },
                        priority: 2
                    };
                }
            },
            messages: {
                filetype: "The File Type not Allowed.",
                requiredfile: "File Required"
            },
            excluded: 'input[type=hidden], :disabled'
        });
    });
    $(document).on('click', '.delete_photo', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        let idValue = $(this).attr('value-id');
        $('.value-' + idValue).empty();
        axios({
            url: `{!!route('setting.deleted')!!}`,
            data: {
                'data': idValue
            },
            method: "delete"
        }).then(response => {
            if (response.data.status == 1) {
                toastr.success(response.data.message, 'Success :)');
                location.replace("{!!route('setting.index')!!}");
            } else {
                toastr.error(error.data.message, 'Error :(');
            }
        })
    });
</script>
@endpush