@extends('panel.layouts.apps')
@include('panel.menu.submenu')
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
                <i class="kt-font-brand flaticon2-menu"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Menu
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <table class="table table-striped" id="t_menu">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th style="text-align:center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td width="65%">{!! $item->name !!}</td>
                    <td width="35%" style="text-align:center">
                        <a class="btn btn-success btn-icon" href="{{ route('menu.show',$item->id) }}"><i class="fas fa-external-link-alt"></i></a>
                        <a class="btn btn-primary btn-icon" href="{{ route('menu.edit',$item->id) }}"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger deletemenu btn-icon" href="#" id-hmenu="{{ $item->id }}"><i class="fas fa-trash"></i></a>
                        <form action="{{ route('menu.destroy',$item->id) }}" style="display:none" id="destroy_{{ $item->id }}"
                            method="POST">
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
@section('script')
<script>
    $(document).on('click','.newmenu',function(e){
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var valuegambar = $(this).attr('id-gambar');
        $modal.find(".modal-title").html("Tambah Menu Baru");
        $modal.find(".modal-body").html('<form action="{!! route("menu.store") !!}" method="POST">'+
            '<input type="hidden" name="_token" value="{!! csrf_token() !!}" />'+
            '<div class="form-group row">'+
                '<div class="col-12">'+
                    '<input class="form-control" type="text" id="title" name="title" placeholder="Title">'+
                    '</div>'+
                '</div>'+
            '</form>');
        $modal.find(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary createNewMenu">OK</button>');
        $modal.modal('show');
    });
    $(document).on('click','.createNewMenu',function(e){
        $('.modal-body').children('form').trigger('submit');
    });

    $(document).on('click','.deletemenu',function(e){
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var valuemenu = $(this).attr('id-hmenu');
        $modal.find(".modal-title").html("Hapus Menu");
        $modal.find(".modal-body").html("Apakah Anda Yakin Ingin menghapus Menu ini?");
        $modal.find(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary yeshapusmenu" valueid="'+valuemenu+'">OK</button>');
        $modal.modal('show');
    });
    $(document).on('click','.yeshapusmenu',function(e){
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var id_menu = $(this).attr('valueid');
        $('#destroy_'+id_menu).trigger('submit');
        $modal.modal('hide');
    });
</script>
@endsection