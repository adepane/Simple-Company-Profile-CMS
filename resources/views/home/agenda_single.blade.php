@extends('home._app')
@push('header')
<title>{!! $data->title !!} - {!! CMS::getSetting('tagline') !!}</title>
<meta name="description" content="{!! CMS::excerpt($data->content,20) !!}" />
<?php
    $keyw = explode(" ",strtolower($data->title));
?>
<meta name="keywords" content="{!! implode(" , ",$keyw) !!}" />
<meta name="robots" content="index,follow" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="PMI Musi Banyuasin" />
<meta property="og:title" content="{!!$data->title!!}" />
<meta property="og:description" content="{!! CMS::excerpt($data->content,20) !!}" />
<meta property="og:url" content="{!! route('home.showAgenda',[$data->id,$data->slug])!!}" />
<meta property="og:image" content="{!!CMS::getImage($data->id_media)!!}" />
<meta property="og:image:type" content="image/jpeg" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{!!$data->title!!}" />
<meta name="twitter:description" content="{!! CMS::excerpt($data->content,20) !!}" />
<meta name="twitter:image:src" content="{!!CMS::getImage($data->id_media)!!}" />
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
    <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-posts single-post">
                    <article class="post clearfix mb-0">
                        <div class="time" style="width:60px!important;float:left;">
                            <div class="pr-0 mb-20" style="width:100%;margin-left:1px">
                                <div class="event-date text-center bg-theme-colored border-radius-5px">
                                    <ul>
                                        <li class="font-28 text-white font-weight-700">{!!$data->start->format('d')!!}</li>
                                        <li class="font-18 text-white text-center text-uppercase">{!!$data->start->format('M')!!}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="addthis_inline_share_toolbox_wvfv"></div>
                        </div>

                        <div class="entry-content ml-lg-80">
                            <div class="entry-meta media no-bg no-border mt-15 pb-20">
                                <div class="media-body">
                                    <div class="event-content pull-left flip">
                                        <h4 class="entry-title text-black text-uppercase m-0">{{$data->title}}</h4>
                                        <h5 class="font-16">{!! (!empty($data->time_start) &&
                                            !empty($data->time_end))?'<span><i
                                                    class="fa fa-clock-o text-theme-colored"></i> '.$data->time_start.'
                                                - '.$data->time_end.'</span>':"" !!}
                                            {!! (!empty($data->time_start) && empty($data->time_end))?'<span><i
                                                    class="fa fa-clock-o text-theme-colored"></i> '.$data->time_start.'
                                                - Selesai</span>':"" !!}
                                            <i class="fa fa-map-marker text-theme-colored mr-5 ml-20"></i>
                                            {!!$data->lokasi!!}
                                        </h5>
                                    </div>
                                </div>
                                <h5 class="font-18 pt-40">Detail Acara</h5>
                                {!!$data->description!!}
                                @if ($data->start->format('Y-m-d') < date('Y-m-d')) <div class="finish pull-right font-25 text-uppercase text-black"> Agenda Selesai </div> @endif
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-md-4">
                @include('home.sidebar')
            </div>
        </div>
    </div>
</section>
@endsection
@push('footer')
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-570e568148d64f3c"></script>
<script>
    if ($.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent
            .toLowerCase()))) {
        $('.time').addClass('pt-30 pr-10 pl-10');
    }
</script>
@endpush