@extends('home._app')
@push('header')
<title>Galeri - {!! CMS::getSetting('tagline') !!}</title>
<meta name="description" content="Galeri - {!! CMS::getSetting('tagline') !!}" />
<meta name="robots" content="index,nofollow" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="PMI Musi Banyuasin" />
<meta property="og:title" content="Galeri - {!! CMS::getSetting('tagline') !!}" />
<meta name="twitter:title" content="Galeri - {!! CMS::getSetting('tagline') !!}" />
<meta property="og:url" content="{!!url()->current()!!}" />
<meta property="og:image" content="{!!asset(CMS::getSetting('defaultimage'))!!}" />
<meta property="og:image:type" content="image/jpeg" />
<style>
    .portfolio-view {
        left: 10% !important;
        top: 50% !important;
    }
</style>
@endpush
@section('content')
<section class="inner-header divider parallax layer-overlay layer-pattern">
    <div class="container pt-10 pb-10">
        <div class="section-content pt-10">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title text-white">Galeri</h3>
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
                        @foreach ($galleries as $gallery)
                        <div class="gallery-item breakfast">
                            <div class="thumb">
                                <img class="img-fullwidth"
                                    src="{!!CMS::getImage($gallery->gallerymedias->first()->id)!!}" alt="project">
                                <div class="overlay-shade"></div>
                                <div class="portfolio-upper-part">
                                    <h4 class="font-22 mb-0">{{$gallery->title}}</h4>
                                    <h5 class="font-14 mt-0">{{$gallery->gallerymedias->count()}} Photo</h5>
                                </div>
                                <div class="portfolio-view">
                                    <a class="" title="{{$gallery->title}}"
                                        href="{{route('home.showGallery',$gallery->id)}}">
                                        <i class="fa fa-camera font-40 text-theme-colored"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection