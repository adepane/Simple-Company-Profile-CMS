@extends('panel.layouts.apps')
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
                <i class="kt-font-brand flaticon-multimedia"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Pesan Masuk
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <table class="table table-striped" id="t_menu">
            <thead>
                <tr>
                    <th>Pengirim</th>
                    <th>Perihal</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th style="text-align:center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->perihal }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td width="20%" style="text-align:center">
                        <a class="btn btn-success btn-icon" href="{{ route('pesan.show',$item->id) }}"><i
                                class="fas fa-envelope"></i></a>
                        <button type="button" class="btn btn-danger destroy deletepesan btn-icon"
                            id-pesan="{{ $item->id }}"><i class="fas fa-trash"></i></button>
                        <form action="{{ route('pesan.destroy',$item->id) }}" style="display:none"
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
    $(document).on('click', '.deletepesan', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var valuepesan = $(this).attr('id-pesan');
        $modal.find(".modal-title").html("Hapus Slide");
        $modal.find(".modal-body").html("Apakah Anda Yakin Ingin menghapus pesan ini?");
        $modal.find(".modal-footer").html(
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary yeshapupesan" valueid="' +
            valuepesan + '">OK</button>');
        $modal.modal('show');
    });
    $(document).on('click', '.yeshapupesan', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var id_pesan = $(this).attr('valueid');
        $('#destroy_' + id_pesan).trigger('submit');
        $modal.modal('hide');
    });
</script>
@endpush