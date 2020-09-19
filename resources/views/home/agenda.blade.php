@extends('home._app')
@push('header')
<title>Agenda - {!! CMS::getSetting('tagline') !!}</title>
<meta name="description" content="Agenda PMI Musi Banyuasin" />
<meta name="robots" content="index,nofollow" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="PMI Musi Banyuasin" />
<meta property="og:title" content="Agenda - {!! CMS::getSetting('tagline') !!}" />
<meta name="twitter:title" content="Agenda - {!! CMS::getSetting('tagline') !!}" />
<meta property="og:url" content="{!!url()->current()!!}" />
<meta property="og:image" content="{!!asset(CMS::getSetting('defaultimage'))!!}" />
<meta property="og:image:type" content="image/jpeg" />
@endpush
@section('content')
<section class="inner-header divider parallax layer-overlay layer-pattern">
    <div class="container pt-10 pb-20">
        <div class="section-content pt-10">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title text-white">Agenda</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container pb-40">
        <div class="section-content">
            <div class="row post">
                <div class="col-md-6 entry-content">
                    <h3 class="title text-black">Agenda Akan Datang</h3>
                    @foreach ($data as $item)
                    @if ($item->end >= \Carbon\Carbon::today())
                    <div class="row mt-10 pl-5">
                        <div class="col-xs-2 col-md-3 pr-0">
                            <div
                                class="event-date text-center bg-theme-colored border-1px p-0 pt-10 pb-10 sm-custom-style">
                                <ul>
                                    <li class="font-28 text-white font-weight-700">{!!$item->start->format('d')!!}</li>
                                    <li class="font-18 text-white text-center text-uppercase">
                                        {!!$item->start->format('M')!!}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-9 pr-10 pl-10">
                            <div class="event-content mt-10 p-5 pb-0 pt-0">
                                <h5 class="media-heading font-16 font-weight-600"><a
                                        href="{!! route('home.showAgenda',[$item->id,$item->slug])!!}">{!!$item->title!!}</a>
                                </h5>
                                <ul class="list-inline font-weight-600 text-gray-dimgray">
                                    {!! (!empty($item->time_start) && !empty($item->time_end))?'<li><i
                                            class="fa fa-clock-o text-theme-colored"></i> '.$item->time_start.' -
                                        '.$item->time_end.'</li>':"" !!}
                                    {!! (!empty($item->time_start) && empty($item->time_end))?'<li><i
                                            class="fa fa-clock-o text-theme-colored"></i> '.$item->time_start.' -
                                        Selesai</li>':"" !!}
                                    <li> <i class="fa fa-map-marker text-theme-colored"></i> {!!$item->lokasi!!} </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="col-md-6">
                    <h3 class="title text-black text-right">Agenda Selesai</h3>
                    @foreach ($data as $item)
                    @if ($item->end <= \Carbon\Carbon::today()) <div class="row mt-10 pl-5">
                        <div class="col-xs-2 col-md-3 pr-0">
                            <div
                                class="event-date text-center bg-theme-colored border-1px p-0 pt-10 pb-10 sm-custom-style">
                                <ul>
                                    <li class="font-28 text-white font-weight-700">{!!$item->start->format('d')!!}</li>
                                    <li class="font-18 text-white text-center text-uppercase">
                                        {!!$item->start->format('M')!!}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-9 pr-10 pl-10">
                            <div class="event-content mt-10 p-5 pb-0 pt-0">
                                <h5 class="media-heading font-16 font-weight-600"><a
                                        href="{!! route('home.showAgenda',[$item->id,$item->slug])!!}">{!!$item->title!!}</a>
                                </h5>
                                <ul class="list-inline font-weight-600 text-gray-dimgray">
                                    {!! (!empty($item->time_start) && !empty($item->time_end))?'<li><i
                                            class="fa fa-clock-o text-theme-colored"></i> '.$item->time_start.' -
                                        '.$item->time_end.'</li>':"" !!}
                                    {!! (!empty($item->time_start) && empty($item->time_end))?'<li><i
                                            class="fa fa-clock-o text-theme-colored"></i> '.$item->time_start.' -
                                        Selesai</li>':"" !!}
                                    <li> <i class="fa fa-map-marker text-theme-colored"></i> {!!$item->lokasi!!} </li>
                                </ul>
                            </div>
                        </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
@endsection