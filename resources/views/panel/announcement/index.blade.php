@extends('panel.layouts.apps')
@include('panel.announcement.submenu')
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
                List pengumuman
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <table class="table table-striped" id="t_menu">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Dokumen</th>
                    <th>Status</th>
                    <th>Dilihat</th>
                    <th style="text-align:center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td><a href="{{ CMS::getPdf($item->document_id) }}" target="_blank">{{$item->document->name}}</a> </td>

                    <td>{{ ($item->status ==1)?"Published":"Draft" }}</td>
                    <td>{{ $item->view }}</td>
                    <td width="20%" style="text-align:center">
                        <a class="btn btn-primary btn-icon" href="{{ route('announcement.edit',$item->id) }}"><i class="fas fa-pencil-alt"></i></a>
                        <button type="button" class="btn btn-danger destroy deleteannouncement btn-icon" id-announcement="{{ $item->id }}"><i class="fas fa-trash"></i></button>
                        <form action="{{ route('announcement.destroy',$item->id) }}" style="display:none" id="destroy_{{ $item->id }}"
                            method="POST">
                            @method('delete')
                            @csrf
                        </form>
                        <a class="btn btn-success btn-icon" type="button" href="{{ route('home.showAnnouncement',[$item->id,$item->slug]) }}" target="_blank"><i class="fa fa-share"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <div class="kt-pagination  kt-pagination--brand">
            {{ $data->links() }}
            <div class="kt-pagination__toolbar">
                <span class="pagination__desc">
                    Displaying {{ ($data->total() <= 10)?$data->total():($data->currentpage()-1)*$data->perpage()+1 }}  {{ ($data->currentpage()*$data->perpage() < 10)?"to ".$data->currentpage()*$data->perpage():""}} of
                    {{$data->total()}} records
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).on('click','.deleteannouncement',function(e){
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var valueannouncement = $(this).attr('id-announcement');
        $modal.find(".modal-title").html("Hapus pengumuman");
        $modal.find(".modal-body").html("Apakah Anda Yakin Ingin menghapus pengumuman ini?");
        $modal.find(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary yeshapusannouncement" valueid="'+valueannouncement+'">OK</button>');
        $modal.modal('show');
    });
    $(document).on('click','.yeshapusannouncement',function(e){
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var $modal = $('#modal-normal');
        var id_announcement = $(this).attr('valueid');
        $('#destroy_'+id_announcement).trigger('submit');
        $modal.modal('hide');
    });
</script>
@endsection
