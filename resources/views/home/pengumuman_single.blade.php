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
<meta property="og:url" content="{!! route('home.showAnnouncement',['id'=>$data->id,'slug'=>$data->slug])!!}" />
<meta property="og:image" content="{!!CMS::getImage($data->media_id)!!}" />
<meta property="og:image:type" content="image/jpeg" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{!!$data->title!!}" />
<meta name="twitter:description" content="{!! CMS::excerpt($data->content,20) !!}" />
<meta name="twitter:image:src" content="{!!CMS::getImage($data->media_id)!!}" />
@endpush
@section('content')
<section>
    <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row">
            <div class="col-md-9">
                <div class="blog-posts single-post">
                    <article class="post clearfix mb-0">
                        <div class="entry-header mb-20">
                            <div class="post-thumb thumb mb-10"> <img src="{!!CMS::getImage($data->media_id)!!}" alt=""
                                    class="img-responsive img-fullwidth"> </div>
                            <span class="pl-10"><em>{!!$data->ket_photo!!}</em></span>
                        </div>
                        <div class="entry-content">
                            <div class="entry-meta media no-bg no-border mt-15 pb-20">
                                <div
                                    class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                    <ul>
                                        <li class="font-16 text-white font-weight-600">
                                            {!!$data->created_at->format('d')!!}</li>
                                        <li class="font-12 text-white text-uppercase">
                                            {!!$data->created_at->format('M')!!}</li>
                                    </ul>
                                </div>
                                <div class="media-body pl-15">
                                    <div class="event-content pull-left flip">
                                        <h4 class="entry-title text-black text-uppercase m-0">{{$data->title}}</h4>
                                        <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                class="fa fa-commenting-o mr-5 text-theme-colored"></i> <span
                                                class="disqus-comment-count"
                                                data-disqus-url="{!! route('home.showPost',['id'=>$data->id,'post'=>$data->slug]) !!}">Comments</span></span>
                                    </div>
                                </div>
                            </div>
                            {!!$data->content!!}
                            @if (!empty($data->document_id))
                            <div class="tagline p-0 pt-20 mt-5">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="tags">
                                            <p class="mb-10">Dokumen: </p>
                                            <a href="{{CMS::getPdf($data->document_id)}}"
                                                class="btn btn-primary">DOWNLOAD</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                    </article>
                    <div class="mt-10 mb-0">
                        <h5 class="pull-left mt-10 mr-20 text-theme-colored">Share:</h5>
                        <div class="addthis_inline_share_toolbox_35fm"></div>
                    </div>

                    <div class="comments-area">
                        <h5 class="comments-title">Comments</h5>
                        <div id="disqus_thread"></div>
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
