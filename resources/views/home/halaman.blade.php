@extends('home._app')
@push('header')
<title>{!! $data->judul !!} - {!! CMS::getSetting('tagline') !!}</title>
<meta name="description" content="{!! CMS::excerpt($data->content,20) !!}" />
<?php
    $keyw = explode(" ",strtolower($data->judul));
?>
<meta name="keywords" content="{!! implode(" , ",$keyw) !!}" />
<meta name="robots" content="index,follow" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="PMI Musi Banyuasin" />
<meta property="og:title" content="{!!$data->judul!!}" />
<meta property="og:description" content="{!! CMS::excerpt($data->content,20) !!}" />
<meta property="og:url" content="{!! route('home.showPage',$data->slug)!!}" />
<meta property="og:image" content="{!!CMS::getImage($data->id_media)!!}" />
<meta property="og:image:type" content="image/jpeg" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{!!$data->judul!!}" />
<meta name="twitter:description" content="{!! CMS::excerpt($data->content,20) !!}" />
<meta name="twitter:image:src" content="{!!CMS::getImage($data->id_media)!!}" />
@endpush
@section('content')
<section class="inner-header divider parallax layer-overlay layer-pattern">
    <div class="container pt-10 pb-20">
        <div class="section-content pt-10">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title text-white">{{$data->judul}}</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row">
            <div class="col-md-9">
                <div class="blog-posts single-post">
                    <article class="post clearfix mb-0">
                        <div class="entry-header mb-20">
                            <div class="post-thumb thumb mb-10"> <img src="{!!CMS::getImage($data->id_media)!!}" alt=""
                                    class="img-responsive img-fullwidth"> </div>
                            <span class="pl-10"><em>{!!$data->ket_photo!!}</em></span>
                        </div>
                        <div class="entry-content">
                            {!!$data->content!!}
                        </div>
                    </article>
                    <div class="mt-10 mb-0">
                        <h5 class="pull-left mt-10 mr-20 text-theme-colored">Share:</h5>
                        <div class="addthis_inline_share_toolbox_35fm"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @include('home.sidebar')
            </div>
        </div>
    </div>
</section>
@endsection
@push('footer')
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-570e568148d64f3c"></script>
@endpush