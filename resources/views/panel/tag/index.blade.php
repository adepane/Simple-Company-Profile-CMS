@extends('panel.layouts.apps')
@include('panel.tag.submenu')
@section('content')
<div class="kt-portlet kt-portlet--mobile">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-list-1"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Tag List
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">

        <table class="table table-striped" id="t_menu">
            <thead>
                <tr>
                    <th>Tag</th>
                    <th style="text-align:center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td width="75%">{!! $item->name !!}</td>
                    <td width="25%" style="text-align:center">
                        <a class="btn btn-primary btn-icon" href="{{ route('tag.edit',$item->id) }}"><i
                                class="fas fa-pencil-alt"></i></a>
                        <button type="button" class="btn btn-danger btn-icon deletetags" href="#"
                            id-tag="{{ $item->id }}"><i class="fas fa-trash"></i></button>
                        <form action="{{ route('tag.destroy',$item->id) }}" style="display:none"
                            id="destroy_{{ $item->id }}" method="POST">
                            @method('delete')
                            @csrf
                        </form>
                    <td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
    $(document).on('click', '.deletetags', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var valuekategori = $(this).attr('id-tag');
        $modal.find(".modal-title").html("Hapus Tag");
        $modal.find(".modal-body").html("Apakah Anda Yakin Ingin menghapus tag ini?");
        $modal.find(".modal-footer").html(
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary yeshapustag" valueid="' +
            valuekategori + '">OK</button>');
        $modal.modal('show');
    });
    $(document).on('click', '.yeshapustag', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var id_tags = $(this).attr('valueid');
        $('#destroy_' + id_tags).trigger('submit');
        $modal.modal('hide');
    });
</script>
@endpush