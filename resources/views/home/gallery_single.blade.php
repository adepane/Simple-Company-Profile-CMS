@extends('home._app')
@push('header')
<title>{{$galleries->title}} - {!! CMS::getSetting('tagline') !!}</title>
<meta name="description" content="{{$galleries->title}} - {!! CMS::getSetting('tagline') !!}" />
<meta name="robots" content="index,follow" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="PMI Musi Banyuasin" />
<meta property="og:title" content="{{$galleries->title}} - {!! CMS::getSetting('tagline') !!}" />
<meta name="twitter:title" content="{{$galleries->title}} - {!! CMS::getSetting('tagline') !!}" />
@endpush
@section('content')
<section class="inner-header divider parallax layer-overlay layer-pattern">
    <div class="container pt-10 pb-20">
        <div class="section-content pt-10">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title text-white">{{$galleries->title}}</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div id="grid" class="gallery-isotope grid-3 masonry gutter-10 clearfix">
                        @foreach ($galleries->gallerymedias as $gallery)
                        <div class="gallery-item breakfast">
                            <div class="thumb">
                                <div class="flexslider-wrapper">
                                    <div class="slides">
                                        <li><a href="{!!CMS::getImage($gallery->id)!!}"
                                                title="{{$gallery->pivot->photo_desc}}"><img
                                                    src="{!!CMS::getImage($gallery->id)!!}" alt=""></a></li>
                                    </div>
                                </div>
                                <div class="overlay-shade"></div>
                                <div class="icons-holder">
                                    <div class="icons-holder-inner">
                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                            <a href="#"><i class="fa fa-picture-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="clearfix"></div>
</section>

@endsection