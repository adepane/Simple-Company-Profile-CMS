@extends('panel.layouts.apps')
@include('panel.menu.submenu')
@section('content')
<link rel="stylesheet" href="{!! asset('/assets/css/nestable.css') !!}">
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
                Menu
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <a href="#" class="btn btn-brand btn-elevate menubaru">
                <i class="la la-plus"></i>
                Add New Menu
            </a>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="row col-12">

            <div class="dd" id="nestable">
                {!! $menu !!}
            </div>
        </div>
        <hr>
        <form action="{{ route('dmenu.reorder') }}" method="POST">
            @csrf
            <textarea id="nestable-output" style="display:none" name="list"></textarea>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-2">
                        </div>
                        <div class="col-12">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</div>
@endsection
@push('script')
<script src="{{asset('/js/jquery.nestable.js')}}"></script>
<script>
$(document).ready(function(){
    var updateOutput = function(e){
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
            $('#nestable-output').html(window.JSON.stringify(list.nestable('serialize')));
    };

    $('#nestable').nestable({
        // group: 1,
        maxDepth:2
    }).on('change', updateOutput);
    updateOutput($('#nestable').data('output', $('#nestable-output')));
});

    $(document).on('click','.menubaru',function(e){
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            var $modal = $('#modal-normal');
            $modal.find(".modal-title").html("Tambah Menu Baru");
            $modal.find(".modal-body").html('<div class="form-group row">'+
                '<div class="col-12">'+
                    '<input class="form-control" type="text" value="" id="title" name="title" placeholder="Title">'+
                    '</div>'+
                '</div>'+
            
            '<div class="form-group row">'+
                '<div class="col-12">'+
                    '<input class="form-control" type="text" value="" id="slug" name="slug" placeholder="Link">'+
                '</div>'+
            '</div>'+
            '<input id="layout_id" type="hidden" name="layout_id" value="{!! $data->id !!}" />');
            $modal.find(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary createthismenu">OK</button>');
            $modal.modal('show');
       });
        $(document).on('click','.createthismenu',function(e){
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            var $modal = $('#modal-normal');
            var title_ = $('#title').val();
            var layout_ = $('#layout_id').val();
            var slug_ = $('#slug').val();
            
            $.ajax({
                url:"{!! route('dmenu.store') !!}",
                type:"POST",
                data:{'title':title_,'slug':slug_,"layout_id":layout_,"_token":"{!! csrf_token() !!}"},
                success:function(e){
                    if (e.status == 1) {
                        var path = $('#nestable').children('.MenuHere');
                        path.append('<li class="dd-item kt-avatar kt-avatar--outline" data-id="'+e.menuId+'">'+
                        '<div class="dd-handle col-6">'+e.menuTitle+'</div>'+
                        '<label class="kt-avatar__upload ubahmenu" id-menu="'+e.menuId+'" data-title="'+e.menuTitle+'" data-slug="'+e.menuSlug+'" id-menu="'+e.menuId+'" data-toggle="kt-tooltip" title=" data-original-title="Ubah Menu">'+
                            '<i class="fa fa-pencil-alt"></i>'+
                            '</label>'+
                        '</li>');
                        $('#nestable').nestable().trigger('change');
                        toastr.success(e.message,"Success");
                    } else {
                        toastr.error(e.message,"Failed");
                    }
                }
            });
            $modal.modal('hide');
        });



$(document).on('click','.ubahmenu',function(e){
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var $modal = $('#modal-normal');
    var valuemenu = $(this).attr('id-menu');
    var title_ = $(this).attr('data-title');
    var slug_ = $(this).attr('data-slug');
    $modal.find(".modal-title").html("Ubah Menu");
    $modal.find(".modal-body").html('<form action="{!!url("panelroom/dmenu/'+valuemenu+'")!!}" method="POST" id="edit_'+valuemenu+'">'+
        '<input type="hidden" name="_method" value="patch" />'+
        '<input type="hidden" name="_token" value="{!! csrf_token() !!}" />'+
    '<div class="form-group row">'+
        '<div class="col-12">'+
            '<input class="form-control" type="text" value="'+title_+'" id="title" name="title" placeholder="Title">'+
            '</div>'+
        '</div>'+
    
    '<div class="form-group row">'+
        '<div class="col-12">'+
            '<input class="form-control" type="text" value="'+slug_+'" id="slug" name="slug" placeholder="Link">'+
            '</div>'+
        '</div>'+
        '<div class="form-group row">'+
            '<div class="col-12">'+
                '<a class="btn btn-danger hapusmenu" id-destroy="'+valuemenu+'" href="#">HAPUS</a>'+
                '</div>'+
            '</div>'+
            '</form>'+
            '<form action="{!! url("panelroom/dmenu/'+valuemenu+'") !!}" id="destroy_'+valuemenu+'" style="display:none" method="POST">'+
                '<input type="hidden" name="_method" value="delete" />'+
                '<input type="hidden" name="_token" value="{!! csrf_token() !!}" />'+
            '</form>');
        
    $modal.find(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary submitmenu" valueid="'+valuemenu+'">OK</button>');
    $modal.modal('show');
});
$(document).on('click','.submitmenu',function(e){
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var $modal = $('#modal-normal');
    var id_menu = $(this).attr('valueid');
    $('#edit_'+id_menu).trigger('submit');
    $modal.modal('hide');

});
$(document).on('click','.hapusmenu',function(e){
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    var $modal = $('#modal-normal');
    var id_menu = $(this).attr('id-destroy');
    $('#destroy_'+id_menu).trigger('submit');
    $modal.modal('hide');
});
</script>
@endpush