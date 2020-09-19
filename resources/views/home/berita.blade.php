@extends('home._app')
@push('header')
<title>Berita - {!! CMS::getSetting('tagline') !!}</title>
<meta name="description" content="Berita PMI Musi Banyuasin" />
<meta name="robots" content="index,nofollow" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="{!!CMS::getSetting(" title")!!}" />
<meta property="og:title" content="Berita - {!!CMS::getSetting(" title")!!} - {!! CMS::getSetting('tagline') !!}" />
<meta name="twitter:title" content="Berita - {!!CMS::getSetting(" title")!!} - {!! CMS::getSetting('tagline') !!}" />
<meta property="og:url" content="{!!url()->current()!!}" />
<meta property="og:image" content="{!!asset(CMS::getSetting('defaultimage'))!!}" />
<meta property="og:image:type" content="image/jpeg" />
<style>
    .thumb {
        max-height: 300px !important;
    }
</style>
@endpush
@section('content')
<section class="inner-header divider parallax layer-overlay layer-pattern">
    <div class="container pt-10 pb-20">
        <div class="section-content pt-10">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title text-white">Berita</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container pb-0">
        <div class="section-content">
            <div class="row">
                <div class="col-md-9">
                    @foreach ($data as $item)
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-50">
                        <div class="schedule-box maxwidth500 clearfix mb-30" data-bg-img="images/pattern/p26.png"
                            style="background-image: url(&quot;images/pattern/p26.png&quot;);">
                            <div class="col-md-5">
                                <div class="thumb">
                                    <img class="img-fullwidth" alt="" src="{{CMS::getImage($item->id_media)}}">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="schedule-details clearfix p-15 pt-30">
                                    <div class="text-center pull-left flip bg-theme-colored p-10 pt-5 pb-5 mr-10">
                                        <ul>
                                            <li class="font-24 text-white font-weight-600 border-bottom ">
                                                {{$item->publish_date->format('d')}}</li>
                                            <li class="font-18 text-white text-uppercase">
                                                {{$item->publish_date->format('M')}}</li>
                                        </ul>
                                    </div>
                                    <h3 class="title mt-0 font-20"><a
                                            href="{{route('home.showPost',[$item->id,$item->slug])}}">{{$item->judul}}</a>
                                    </h3>
                                    <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                            class="fa fa-commenting-o mr-5 text-theme-colored"></i> <span
                                            class="disqus-comment-count"
                                            data-disqus-url="{!! route('home.showPost',['id'=>$item->id,'post'=>$item->slug]) !!}">Comments</span></span>
                                    <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                            class="fa fa-tag mr-5 text-theme-colored"></i>{{$item->kategories->name}}</span>
                                    <div class="clearfix"></div>
                                    <p class="mt-10">{{CMS::excerpt($item->content)}}</p>
                                    <div class="mt-10">
                                        <a href="{{route('home.showPost',[$item->id,$item->slug])}}"
                                            class="btn btn-default btn-theme-colored mt-10 font-16 btn-sm">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-md-3">
                    @include('home.sidebar')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection