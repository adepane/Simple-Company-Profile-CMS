<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
        <div class="row kt-widget">
            @foreach ($data as $item)
            <div class="col-md-2 mx-auto" style="margin-bottom:10px">
                <div class="kt-avatar kt-avatar--outline" id="kt_contacts_edit_avatar">
                    <div class="kt-avatar__holder"
                        style="background-image: url('{{ asset("files/".$item->path) }}');width:100px;height:100px"></div>
                    <label class="kt-avatar__upload choosepicture" id-gambar="{{ $item->id }}" path-gambar="{{ $item->path }}" data-toggle="kt-tooltip"
                        title="" data-original-title="Pilih Gambar">
                        <i class="fas fa-check"></i>
                    </label>
                </div>
            </div>
            @endforeach
        </div>
        <hr>
        <div class="kt-pagination  kt-pagination--brand">
            {{ $data->links() }}
            <div class="kt-pagination__toolbar">
                <span class="pagination__desc">
                    Displaying {{ ($data->total() <= 10)?$data->total():($data->currentpage()-1)*$data->perpage()+1 }}
                    {{ ($data->currentpage()*$data->perpage() < 10)?"to ".$data->currentpage()*$data->perpage():""}} of
                    {{$data->total()}} records
                </span>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('ajaxComplete ajaxReady ready', function () {
        var $modal = $('#modal-full');
        $('ul.kt-pagination__links li a').off('click').on('click', function (e) {
            $modal.modal('show');
            $('.modal-body').load($(this).attr('href'));
            e.preventDefault();
        });
    });
</script>