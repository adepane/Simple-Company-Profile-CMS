@extends('panel.layouts.apps')
@include('panel.gallery.submenu')
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
                List Galeri
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <table class="table table-striped" id="t_menu">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Total Photo</th>
                    <th style="text-align:center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{$item->gallerymedias->count()}}</td>
                    <td width="20%" style="text-align:center">
                        <a class="btn btn-primary btn-icon" href="{{ route('gallery.edit',$item->id) }}"><i
                                class="fas fa-pencil-alt"></i></a>
                        <button type="button" class="btn btn-danger destroy deletegaleri btn-icon"
                            id-galeri="{{ $item->id }}"><i class="fas fa-trash"></i></button>
                        <form action="{{ route('gallery.destroy',$item->id) }}" style="display:none"
                            id="destroy_{{ $item->id }}" method="POST">
                            @method('delete')
                            @csrf
                        </form>
                        <a class="btn btn-success btn-icon" type="button"
                            href="{{ route('home.showGallery',$item->id) }}" target="_blank"><i
                                class="fa fa-share"></i></a>
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
    $(document).on('click', '.deletegaleri', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var valuegaleri = $(this).attr('id-galeri');
        $modal.find(".modal-title").html("Hapus galeri");
        $modal.find(".modal-body").html("Apakah Anda Yakin Ingin menghapus galeri ini?");
        $modal.find(".modal-footer").html(
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary yeshapusgaleri" valueid="' +
            valuegaleri + '">OK</button>');
        $modal.modal('show');
    });
    $(document).on('click', '.yeshapusgaleri', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var id_galeri = $(this).attr('valueid');
        $('#destroy_' + id_galeri).trigger('submit');
        $modal.modal('hide');
    });
</script>
@endpush