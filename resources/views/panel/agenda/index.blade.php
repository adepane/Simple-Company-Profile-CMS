@extends('panel.layouts.apps')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<link rel="stylesheet" href="{!! asset("/css/jquery.simplecolorpicker.css") !!}" type="text/css" media="screen" />

<div class="kt-portlet kt-portlet--mobile">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-calendar-1"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Agenda
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div id="calendar"></div>
    </div>
</div>

@endsection
@push('script')
<div id="modalAgenda" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Agenda</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-12">
                        <input class="form-control" type="text" value="" id="title" name="title"
                            placeholder="Judul Agenda">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-12">Mulai</label>
                    <div class="col-8">
                        <input class="form-control" type="date" value="" id="date_mulai" name="date_mulai"
                            placeholder="Mulai">
                    </div>
                    <div class="col-4">
                        <input class="form-control" type="time" value="" id="time_mulai" name="time_mulai"
                            placeholder="Mulai">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-12">Selesai</label>
                    <div class="col-8">
                        <input class="form-control" type="date" value="" id="date_selesai" name="date_selesai"
                            placeholder="Mulai">
                    </div>
                    <div class="col-4">
                        <input class="form-control" type="time" value="" id="time_selesai" name="time_selesai"
                            placeholder="Mulai">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-12">Lokasi</label>
                    <div class="col-12">
                        <input class="form-control" type="text" value="" id="lokasi" name="lokasi" placeholder="Lokasi">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <span class="col-form-label">Label Agenda </span>
                        <select id="colorPicker" name="label_agenda">
                            <option value="#7bd148">Green</option>
                            <option value="#5484ed">Bold blue</option>
                            <option value="#a4bdfc">Blue</option>
                            <option value="#46d6db">Turquoise</option>
                            <option value="#7ae7bf">Light green</option>
                            <option value="#51b749">Bold green</option>
                            <option value="#fbd75b">Yellow</option>
                            <option value="#ffb878">Orange</option>
                            <option value="#ff887c">Red</option>
                            <option value="#dc2127">Bold red</option>
                            <option value="#dbadff">Purple</option>
                            <option value="#e1e1e1">Gray</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <textarea rows="2" class="form-control" value="" id="deskripsi" name="deskripsi"
                            placeholder="Deskripsi"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary BuatAgendaBaru">Tambah Agenda</button>
            </div>
        </div>
    </div>
</div>
<script src="{!! asset("/js/jquery.simplecolorpicker.js") !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"
    integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script>
    $('#colorPicker').simplecolorpicker({
        picker: true
    });
    $(document).ready(function() {
        tinymce.init({
            selector: '#deskripsi',
            height: "200",
            body_class: 'form-control',
            menubar: false,
            branding: false,
            plugins: "paste",
            paste_as_text: true,
        });
        var SITEURL = "{!!url('/panelroom/agenda')!!}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var calendar = $('#calendar').fullCalendar({
            plugins: ['interaction', 'dayGrid', 'timeGrid'],
            header: {
                left: 'prev, next today',
                center: '',
                right: 'title'
            },
            editable: true,
            events: SITEURL + "/getAgenda",
            displayEventTime: true,
            editable: true,
            eventRender: function(event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                $('#modalAgenda').modal('show');
                $('#title').val("");
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                $('#date_mulai').val(start);
                $('#date_selesai').val(end);
                $('.BuatAgendaBaru').on('click', function() {
                    var title = $('#title').val();
                    var mulai = $('#date_mulai').val();
                    var selesai = $('#date_selesai').val();
                    var time_mulai = $('#time_mulai').val();
                    var time_selesai = $('#time_selesai').val();
                    var colorPicker = $('#colorPicker').val();
                    var ed = tinyMCE.get('deskripsi');
                    var description = ed.getContent();
                    var location = $('#lokasi').val();
                    if (title != "") {
                        $.ajax({
                            url: "{!! route('agenda.store') !!}",
                            data: {
                                'title': title,
                                'start': mulai,
                                'end': selesai,
                                'time_mulai': time_mulai,
                                'time_selesai': time_selesai,
                                'location': location,
                                'color': colorPicker,
                                'deskripsi': description,
                                '_token': '{!! csrf_token() !!}'
                            },
                            type: "POST",
                            success: function(data) {
                                if (data.status == 1) {
                                    toastr.success(data.message, "Success");
                                    calendar.fullCalendar('refetchEvents');
                                }
                            }
                        });
                    }
                    $('.BuatAgendaBaru').unbind('click');
                    $('#modalAgenda').modal('hide');
                });
            },
            eventDrop: function(event, delta) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                $.ajax({
                    url: SITEURL + '/' + event.id,
                    data: {
                        "id": event.id,
                        'title': event.title,
                        'start': start,
                        'end': end,
                        "_token": "{!! csrf_token() !!}",
                        "_method": "patch"
                    },
                    type: "POST",
                    success: function(data) {
                        toastr.success(data.message, "Success");
                        calendar.fullCalendar('refetchEvents');
                    }
                });
            },
            eventClick: function(event) {
                var deleteMsg = confirm("Do you really want to delete?");
                if (deleteMsg) {
                    $.ajax({
                        type: "POST",
                        url: SITEURL + '/' + event.id,
                        data: {
                            "id": event.id,
                            "_token": "{!! csrf_token() !!}",
                            "_method": "delete"
                        },
                        success: function(response) {
                            if (response.status == 1) {
                                calendar.fullCalendar('refetchEvents');
                            }
                        }
                    });
                }
            },
            eventResize: function(event) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                $.ajax({
                    url: SITEURL + '/' + event.id,
                    data: {
                        "id": event.id,
                        'title': event.title,
                        'start': start,
                        'end': end,
                        "_token": "{!! csrf_token() !!}",
                        "_method": "patch"
                    },
                    type: "PUT",
                    success: function(data) {
                        toastr.success(data.message, "Success");
                        calendar.fullCalendar('refetchEvents');
                    }
                });
            }
        });
    });
</script>

@endpush