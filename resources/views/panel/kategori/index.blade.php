@extends('panel.layouts.apps')
@include('panel.kategori.submenu')
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
                <i class="kt-font-brand flaticon2-list-1"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Kategori List
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">

        <table class="table table-striped" id="t_menu">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th style="text-align:center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td width="75%">{!! $item->name !!}</td>
                    <td width="25%" style="text-align:center">
                        <a class="btn btn-primary btn-icon" href="{{ route('kategori.edit',$item->id) }}"><i
                                class="fas fa-pencil-alt"></i></a>
                        <button type="button" class="btn btn-danger destroy btn-icon deletekategori" id-kat="{{ $item->id }}"><i
                                class="fas fa-trash"></i></button>
                        <form action="{{ route('kategori.destroy',$item->id) }}" style="display:none"
                            id="destroy_{{ $item->id }}" method="POST">
                            @method('delete')
                            @csrf
                        </form>
                    <td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
    $(document).on('click', '.deletekategori', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var valuekategori = $(this).attr('id-kat');
        $modal.find(".modal-title").html("Hapus Kategori");
        $modal.find(".modal-body").html("Apakah Anda Yakin Ingin menghapus kategori ini?");
        $modal.find(".modal-footer").html(
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary yeshapuskategori" valueid="' +
            valuekategori + '">OK</button>');
        $modal.modal('show');
    });
    $(document).on('click', '.yeshapuskategori', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var id_kategori = $(this).attr('valueid');
        $('#destroy_' + id_kategori).trigger('submit');
        $modal.modal('hide');
    });
</script>
@endpush