@extends('panel.layouts.apps')
@include('panel.iklan.submenu')
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
                <i class="kt-font-brand flaticon2-menu-2"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                List Iklan
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <table class="table table-striped" id="t_menu">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Posisi</th>
                    <th>Tautan</th>
                    <th style="text-align:center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>
                        @switch($item->position)
                        @case(1)
                        Homepage
                        @break
                        @case(2)
                        Floating
                        @break
                        @default
                        Sidebar
                        @endswitch
                    </td>
                    <td>{{ $item->tautan }}</td>
                    <td width="20%" style="text-align:center">
                        <a class="btn btn-primary btn-icon" href="{{ route('iklan.edit',$item->id) }}"><i
                                class="fas fa-pencil-alt"></i></a>
                        <button type="button" class="btn btn-danger destroy deleteiklan btn-icon" id-iklan="{{ $item->id }}"><i
                                class="fas fa-trash"></i></button>
                        <form action="{{ route('iklan.destroy',$item->id) }}" style="display:none"
                            id="destroy_{{ $item->id }}" method="POST">
                            @method('delete')
                            @csrf
                        </form>
                    </td>
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
    $(document).on('click', '.deleteiklan', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var valueiklan = $(this).attr('id-iklan');
        $modal.find(".modal-title").html("Hapus Slide");
        $modal.find(".modal-body").html("Apakah Anda Yakin Ingin menghapus iklan ini?");
        $modal.find(".modal-footer").html(
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary yeshapuiklan" valueid="' +
            valueiklan + '">OK</button>');
        $modal.modal('show');
    });
    $(document).on('click', '.yeshapuiklan', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var id_iklan = $(this).attr('valueid');
        $('#destroy_' + id_iklan).trigger('submit');
        $modal.modal('hide');
    });
</script>
@endpush