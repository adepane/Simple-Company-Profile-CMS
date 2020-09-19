@extends('panel.layouts.apps')
@include('panel.media.submenu')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon-photo-camera"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                List Media
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="row kt-widget">
            @foreach ($data as $item)
            <div class="col-md-3 mx-auto" style="margin-bottom:10px">
                <div class="kt-avatar kt-avatar--outline" id="kt_contacts_edit_avatar">
                    <div class="kt-avatar__holder"
                        style="background-image: url('{{ asset("files/".$item->path) }}');width:180px;height:180px">
                    </div>
                    <label class="kt-avatar__upload hapusgambar" id-gambar="{{ $item->id }}" data-toggle="kt-tooltip"
                        title="" data-original-title="Hapus Gambar">
                        <i class="fa fa-times"></i>
                    </label>
                </div>
                <form action="{{ route('media.destroy',$item->id) }}" style="display:none" id="destroy_{{ $item->id }}"
                    method="POST">
                    @method('delete')
                    @csrf
                </form>
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
@endsection
@push('script')
<script>
    $(document).on('click', '.hapusgambar', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var valuegambar = $(this).attr('id-gambar');
        $modal.find(".modal-title").html("Hapus Gambar");
        $modal.find(".modal-body").html("Apakah Anda Yakin Ingin menghapus gambar ini?");
        $modal.find(".modal-footer").html(
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary yeshapusgambar" valueid="' +
            valuegambar + '">OK</button>');
        $modal.modal('show');
    });
    $(document).on('click', '.yeshapusgambar', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var id_gambar = $(this).attr('valueid');
        $('#destroy_' + id_gambar).trigger('submit');
        $modal.modal('hide');
    });
</script>
@endpush