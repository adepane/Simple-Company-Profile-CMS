@extends('panel.layouts.apps')
@include('panel.berita.submenu')
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
                <i class="kt-font-brand flaticon2-checking"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                List Berita
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <table class="table table-striped" id="t_menu">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tag</th>
                    <th style="text-align:center">Penulis</th>
                    <th style="text-align:center">Status</th>
                    <th style="text-align:center">Dilihat</th>
                    <th style="text-align:center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->kategories->name }}</td>
                    <td width="15%">
                        {!! implode(", ",$item->tags->pluck('name','id')->all()) !!}
                    </td>
                    <td>{{ $item->authors->name }}</td>
                    <td>{{ ($item->status ==1)?"Published":"Draft" }}</td>
                    <td>{{ $item->view }}</td>
                    <td width="20%">
                        <a class="btn btn-primary btn-icon" href="{{ route('post.edit',$item->id) }}"><i
                                class="fas fa-pencil-alt"></i></a>
                        <button class="btn btn-danger destroy deleteberita btn-icon" href="#"
                            id-berita="{{ $item->id }}"><i class="fas fa-trash"></i></button>
                        <form action="{{ route('post.destroy',$item->id) }}" style="display:none"
                            id="destroy_{{ $item->id }}" method="POST">
                            @method('delete')
                            @csrf
                        </form>
                        <a class="btn btn-success btn-icon" type="button"
                            href="{{ route('home.showPost',['id'=>$item->id,'post'=>$item->slug]) }}" target="_blank"><i
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
    $(document).on('click', '.deleteberita', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var valueberita = $(this).attr('id-berita');
        $modal.find(".modal-title").html("Hapus Berita");
        $modal.find(".modal-body").html("Apakah Anda Yakin Ingin menghapus berita ini?");
        $modal.find(".modal-footer").html(
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary yeshapusberita" valueid="' +
            valueberita + '">OK</button>');
        $modal.modal('show');
    });
    $(document).on('click', '.yeshapusberita', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var id_berita = $(this).attr('valueid');
        $('#destroy_' + id_berita).trigger('submit');
        $modal.modal('hide');
    });
</script>
@endpush
