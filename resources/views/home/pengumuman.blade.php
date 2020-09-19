@extends('home._app')
@push('header')
<title>Pengumuman - {!! CMS::getSetting('tagline') !!}</title>
<meta name="robots" content="index,follow" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="PMI Musi Banyuasin" />
<meta property="og:title" content="Pengumuman - {!! CMS::getSetting('tagline') !!}" />
<meta name="twitter:title" content="Pengumuman - {!! CMS::getSetting('tagline') !!}" />
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
                    <h3 class="title text-white">Pengumuman</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row multi-row-clearfix">
            <div class="blog-posts">
                @foreach ($data as $item)
                <div class="col-md-4">
                    <article class="post clearfix mb-30 bg-lighter">
                        <div class="entry-header">
                            <div class="post-thumb thumb">
                                <img src="{{CMS::getImage($item->id_media,true)}}" alt=""
                                    class="img-responsive img-fullwidth">
                            </div>
                        </div>
                        <div class="entry-content p-20 pr-10">
                            <div class="entry-meta media mt-0 no-bg no-border">
                                <div
                                    class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                    <ul>
                                        <li class="font-16 text-white font-weight-600">
                                            {{$item->created_at->format('d')}}</li>
                                        <li class="font-12 text-white text-uppercase">{{$item->created_at->format('M')}}
                                        </li>
                                    </ul>
                                </div>
                                <div class="media-body pl-15">
                                    <div class="event-content pull-left flip">
                                        <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a
                                                href="{{route('home.showPengumuman',[$item->id,$item->slug])}}">{{$item->judul}}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-10">{{CMS::excerpt($item->content)}}</p>
                            <a href="{{route('home.showPengumuman',[$item->id,$item->slug])}}"
                                class="btn-read-more">Selanjutnya</a>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                </div>
                @endforeach

                <div class="col-md-12">
                    <nav>
                        <ul class="pagination theme-colored">
                            {{ $data->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection