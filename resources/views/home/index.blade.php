@extends('home._app')
@push('meta')
<title>{!! CMS::getSetting('title') !!}</title>
<meta name="description" content="{!! CMS::getSetting('description') !!}" />
<meta name="keywords" content="{!! CMS::getSetting('keywords') !!}" />
<meta name="author" content="Ade Pane" />
<meta property="og:site_name" content="{!! CMS::getSetting('title') !!}" />
<meta property="og:url" content="{!!url()->current()!!}" />
<meta property="og:image" content="{!!asset(CMS::getSetting('defaultimage'))!!}" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:title" content="{!!CMS::getSetting('title')!!} - {!!CMS::getSetting('tagline')!!}" />
<meta property="og:description" content="{!! CMS::getSetting('description') !!}" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{!!CMS::getSetting('title')!!} - {{CMS::getSetting('tagline')}}" />
<meta name="twitter:description" content="{!! CMS::getSetting('description') !!}" />
<meta name="twitter:image:src" content="{!!asset(CMS::getSetting('defaultimage'))!!}" />
<style>
    .portfolio-view {
        left: 42% !important;
        right: 0px !important;
        top: 50% !important;
    }

    .gallery-isotope .gallery-item .thumb {
        max-height: 230px !important;
    }
</style>
@endpush
@section('preloader')
<div id="preloader">
    <div id="spinner">
        <div class="preloader-dot-loading">
            <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
        </div>
    </div>
</div>
@endsection
@section('content')
<!-- Section: home -->
<section id="home">
    <div class="container-fluid p-0">
        <div class="rev_slider_wrapper">
            <div class="rev_slider rev_slider_default" data-version="5.0">
                <ul>
                    @foreach (CMS::getSlider(CMS::getSetting('slideshow')) as $keySlide => $slide)
                    <li data-index="rs-{!! $keySlide !!}" data-transition="slidingoverlayhorizontal"
                        data-slotamount="default" data-easein="default" data-easeout="default"
                        data-masterspeed="default" data-thumb="{!! CMS::getImage($slide->id_media) !!}" data-rotate="0"
                        data-saveperformance="off" data-title="{!! $slide->title !!}" data-description="">
                        <img src="{!! CMS::getImage($slide->id_media) !!}" alt="" data-bgposition="center center"
                            data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10"
                            data-no-retina>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="about">
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <h3 class="line-bottom border-bottom mt-0">Berita</h3>
                    @foreach (CMS::getNews() as $berita)
                    <article
                        class="post clearfix mb-sm-30 border-bottom-theme-color-2px bg-silver-light sm-maxwidth400 border-bottom mt-5 mb-0 pt-10 pb-15">
                        <div class="col-md-4">
                            <div class="entry-header">
                                <div class="post-thumb thumb">
                                    <a href="{{ route('home.showPost',['id'=>$berita->id,'post'=>$berita->slug]) }}">
                                        <img src="{!! CMS::getImage($berita->id_media,true) !!}" alt=""
                                            class="img-responsive img-fullwidth">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div style="background: #f7f8fa">
                                <div class="entry-meta media mt-0 no-bg no-border">
                                    <div
                                        class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                        <ul>
                                            <li class="font-16 text-white font-weight-600 border-bottom">
                                                {!!$berita->publish_date->format('d')!!}</li>
                                            <li class="font-12 text-white text-uppercase">
                                                {!!$berita->publish_date->format('M')!!}</li>
                                        </ul>
                                    </div>
                                    <div class="media-body pl-15">
                                        <div class="event-content pull-left flip">
                                            <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a
                                                    href="{!! route('home.showPost',[$berita->id,$berita->slug]) !!}">{!!
                                                    $berita->judul !!}</a></h4>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-10">{!!CMS::excerpt($berita->content)!!}</p>
                                <a href="{!! route('home.showPost',[$berita->id,$berita->slug]) !!}"
                                    class="btn btn-default btn-sm btn-theme-colored mt-10" style="float:right">Read
                                    more</a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    <h3 class="line-bottom border-bottom mt-0">Agenda Kegiatan</h3>
                    <div class="event media sm-maxwidth400 border-bottom mt-5 mb-0 pt-10 pb-15">
                        @foreach (CMS::getAgenda() as $agenda)
                        <div class="row mt-10">
                            <div class="col-xs-2 col-md-3 pr-0">
                                <div
                                    class="event-date text-center bg-theme-colored border-1px p-0 pt-10 pb-10 sm-custom-style">
                                    <ul>
                                        <li class="font-28 text-white font-weight-700">{!!$agenda->start->format('d')!!}
                                        </li>
                                        <li class="font-18 text-white text-center text-uppercase">
                                            {!!$agenda->start->format('M')!!}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xs-9 pr-10 pl-10">
                                <div class="event-content mt-10 p-5 pb-0 pt-0">
                                    <h5 class="media-heading font-16 font-weight-600"><a
                                            href="{!! route('home.showAgenda',[$agenda->id,$agenda->slug])!!}">{!!$agenda->title!!}</a>
                                    </h5>
                                    <ul class="list-inline font-weight-600 text-gray-dimgray">
                                        {!! (!empty($agenda->time_start) && !empty($agenda->time_end))?'<li><i
                                                class="fa fa-clock-o text-theme-colored"></i> '.$agenda->time_start.' -
                                            '.$agenda->time_end.'</li>':"" !!}
                                        {!! (!empty($agenda->time_start) && empty($agenda->time_end))?'<li><i
                                                class="fa fa-clock-o text-theme-colored"></i> '.$agenda->time_start.' -
                                            Selesai</li>':"" !!}
                                        <li> <i class="fa fa-map-marker text-theme-colored"></i> {!!$agenda->lokasi!!}
                                        </li>
                                    </ul>
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

<section class="bg-silver-light">
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="owl-carousel owl-theme owl-rtl owl-loaded">
                        <div class="img-hover-border">
                            @foreach (CMS::advertisement(1) as $theAds)
                            <a href="{!! $theAds->tautan !!}" target="_blank">
                                <img class="img-fullwidth" src="{{CMS::getImage($theAds->id_media)}}" alt="">
                            </a>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="text-uppercase title line-bottom mt-0 mb-40"><i
                            class="fa fa-calendar text-gray-darkgray mr-10"></i>Informasi <span
                            class="text-theme-colored">& Pengumuman</span></h3>
                    @foreach (CMS::getAnnouncement() as $pengumuman)
                    <div class="icon-box border-bottom clearfix">
                        <a href="{!!route('home.showPengumuman',[$pengumuman->id,$pengumuman->slug])!!}">
                            <div class="ml-0 mr-sm-0">
                                <h5 class="icon-box-title mb-10 text-uppercase letter-space-1">{{$pengumuman->judul}}
                                </h5>
                                <p class="">{{CMS::excerpt($pengumuman->content,10)}}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="divider parallax layer-overlay overlay-theme-colored-8" data-bg-img="{!!asset("
    front/images/header.jpg")!!}" data-parallax-ratio="0.7">
    <div class="container pt-80 pb-80">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                <div class="funfact text-center">
                    <i class="pe-7s-smile mt-5 text-white"></i>
                    <h2 data-animation-duration="2000" data-value="754"
                        class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>
                    <h5 class="text-white text-uppercase font-weight-600">Relawan</h5>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                <div class="funfact text-center">
                    <i class="pe-7s-rocket mt-5 text-white"></i>
                    <h2 data-animation-duration="2000" data-value="675"
                        class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>
                    <h5 class="text-white text-uppercase font-weight-600">Success Mission</h5>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                <div class="funfact text-center">
                    <i class="pe-7s-add-user mt-5 text-white"></i>
                    <h2 data-animation-duration="2000" data-value="1248"
                        class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>
                    <h5 class="text-white text-uppercase font-weight-600">Volunteer Reached</h5>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                <div class="funfact text-center">
                    <i class="pe-7s-global mt-5 text-white"></i>
                    <h2 data-animation-duration="2000" data-value="24"
                        class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>
                    <h5 class="text-white text-uppercase font-weight-600">Globalization Work</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="">
    <div class="container">
        <div class="section-title text-center">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h2 class="text-uppercase line-bottom-center mt-0">Photo <span
                            class="text-theme-colored font-weight-600">Gallery</span></h2>
                    <div class="title-icon">
                        <i class="flaticon-charity-hand-holding-a-heart"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="grid" class="gallery-isotope grid-3 masonry gutter-10 clearfix">
                    @foreach (CMS::getGallery() as $gallery)
                    <div class="gallery-item breakfast">
                        <div class="thumb">
                            <img class="img-fullwidth" src="{!!CMS::getImage($gallery->gallerymedias->first()->id)!!}"
                                alt="project">
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
</section>

@endsection
@push('footer')
<script>
    $(document).ready(function(e) {
        $(".rev_slider_default").revolution({
            sliderType: "standard",
            sliderLayout: "auto",
            dottedOverlay: "none",
            delay: 5000,
            navigation: {
                keyboardNavigation: "off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                onHoverStop: "off",
                touch: {
                    touchenabled: "on",
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                },
                arrows: {
                    style: "zeus",
                    enable: true,
                    hide_onmobile: true,
                    hide_under: 600,
                    hide_onleave: true,
                    hide_delay: 200,
                    hide_delay_mobile: 1200,
                    tmp: '<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 30,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 30,
                        v_offset: 0
                    }
                },
                bullets: {
                    enable: true,
                    hide_onmobile: true,
                    hide_under: 600,
                    style: "metis",
                    hide_onleave: true,
                    hide_delay: 200,
                    hide_delay_mobile: 1200,
                    direction: "horizontal",
                    h_align: "center",
                    v_align: "bottom",
                    h_offset: 0,
                    v_offset: 30,
                    space: 5,
                    tmp: '<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">TItle</span>'
                }
            },
            responsiveLevels: [1280, 1024, 778],
            visibilityLevels: [1280, 1024, 778],
            gridwidth: [1260, 1024, 778, 480],
            gridheight: [580, 768, 960, 720],
            lazyType: "none",
            parallax: {
                origo: "slidercenter",
                speed: 1000,
                levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                type: "scroll"
            },
            shadow: 0,
            spinner: "off",
            stopLoop: "on",
            stopAfterLoops: 0,
            stopAtSlide: -1,
            shuffle: "off",
            autoHeight: "off",
            fullScreenAutoWidth: "on",
            fullScreenAlignForce: "off",
            fullScreenOffsetContainer: "",
            fullScreenOffset: "0",
            hideThumbsOnMobile: "off",
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            debugMode: false,
            fallbacks: {
                simplifyAll: "off",
                nextSlideOnWindowFocus: "off",
                disableFocusListener: false,
            }
        });
    });
</script>

@if (!empty($iklanFloat->id_media) || !empty($iklanFloat->script))
<!--Start Walldown-->
<div class="floatingads">
    <div class="mfp-bg mfp-ready"></div>
    <div class="wallfloat">
        <div class="walldown-banner">
            <span id="stopBtn" class="shbutton"><img src="/front/close.gif" /></span>
            <div class="walldownads">
                <div class="clearfix"></div>
                <div class="walldownads">
                    @if (!empty($iklanFloat->script))
                    {!!$iklanFloat->script!!}
                    @else
                    <span class="walldownimg">
                        <a href="{{$iklanFloat->tautan}}" class="clickedAds" target="blank">
                            <img src="{{CMS::getImage($iklanFloat->id_media)}}" width="100%" />
                        </a>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .walldown-banner {
        margin: auto;
        width: 80%;
        position: relative;
    }

    .shbutton {
        float: right;
    }

    .wallfloat {
        position: fixed;
        top: 10%;
        width: 100%;
        margin: auto;
        z-index: 1043
    }
</style>
<script>
    $(document).ready(function() {
        $(".shbutton").on('click', function() {
            $('.floatingads').remove();
        });
    });
    var player;

    function onYouTubePlayerAPIReady() {
        player = new YT.Player('video', {
            events: {
                'onReady': onPlayerReady
            }
        });
    }

    function onPlayerReady(event) {
        var playButton = document.getElementById("play-button");
        playButton.addEventListener("click", function() {
            player.playVideo();
        });
        var pauseButton = document.getElementById("stopBtn");
        pauseButton.addEventListener("click", function() {
            player.pauseVideo();
        });
    }
    var tag = document.createElement('script');
    tag.src = "//www.youtube.com/player_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    $(document).on('click', '.clickedAds', function() {
        $('.shbutton').trigger('click');
    });
    $(document).mouseup(function(e) {
        var container = $(".walldownads");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $('.floatingads').remove();
        }
    });
</script>
<!--Stop Walldown-->
@endif
@endpush