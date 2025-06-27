@extends('panel.layouts.apps')
@include('panel.users.submenu')
@section('content')
<div class="kt-portlet kt-portlet--mobile">
    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <ul>
            <li>{{ $error }}</li>
        </ul>
        @endforeach
    </div>
    @endif
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__body">
                <div class="kt-widget kt-widget--user-profile-3">
                    <div class="kt-widget__top">
                        <div class="kt-widget__media kt-hidden-">
                            <img src="{{ Gravatar::src($data->email) }}">
                        </div>
                        <div
                            class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">
                            JM
                        </div>
                        <div class="kt-widget__content">
                            <div class="kt-widget__head">
                                <a href="#" class="kt-widget__username">
                                    {{ $data->name }}
                                    <i class="flaticon2-correct"></i>
                                </a>
                                <div class="kt-widget__action">
                                    <button type="button"
                                        class="btn btn-label-success btn-sm btn-upper">ask</button>&nbsp;
                                    <button type="button" class="btn btn-brand btn-sm btn-upper">hire</button>
                                </div>
                            </div>
                            <div class="kt-widget__subhead">
                                <a href="#"><i class="flaticon2-new-email"></i>{{ $data->email }}</a>
                                <a href="#"><i class="flaticon2-calendar-3"></i>{{ $data->username }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
