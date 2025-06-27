@extends('panel.layouts.apps')
@include('panel.pages.submenu')
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
                List Pages
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <table class="table table-striped" id="t_menu">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Link</th>
                    <th style="text-align:center">Status</th>
                    <th style="text-align:center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>/p/{{$item->slug}}</td>
                    <td style="text-align:center">{{ ($item->status ==1)?"Published":"Draft" }}</td>
                    <td width="20%">
                        <a class="btn btn-primary btn-icon" href="{{ route('pages.edit',$item->id) }}"><i
                                class="fas fa-pencil-alt"></i></a>
                        <button type="button" class="btn btn-danger destroy deletepage btn-icon"
                            id-page="{{ $item->id }}"><i class="fas fa-trash"></i></button>
                        <form action="{{ route('pages.destroy',$item->id) }}" style="display:none"
                            id="destroy_{{ $item->id }}" method="POST">
                            @method('delete')
                            @csrf
                        </form>
                        <a class="btn btn-success btn-icon" type="button" href="{{ route('home.showPage',$item->slug)}}"
                            target="_blank"><i class="fa fa-share"></i></a>
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
    $(document).on('click', '.deletepage', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var valuepage = $(this).attr('id-page');
        $modal.find(".modal-title").html("Delete page");
        $modal.find(".modal-body").html("Are you sure you want to delete this page?");
        $modal.find(".modal-footer").html(
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary yeshapuspage" valueid="' +
            valuepage + '">OK</button>');
        $modal.modal('show');
    });
    $(document).on('click', '.yeshapuspage', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var id_page = $(this).attr('valueid');
        $('#destroy_' + id_page).trigger('submit');
        $modal.modal('hide');
    });
</script>
@endpush
