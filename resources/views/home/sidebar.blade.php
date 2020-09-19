<div class="sidebar sidebar-left mt-sm-30">
    <div class="widget">
        <h5 class="widget-title line-bottom">Cari Berita</h5>
        <div class="search-form">
            <form action="/search?" type="get">
                <div class="input-group">
                    <input type="text" placeholder="Click to Search" class="form-control search-input" value=""
                        name="q">
                    <span class="input-group-btn">
                        <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    {!! CMS::getSidebarTopAds(3)!!}
    <div class="widget">
        <h5 class="widget-title line-bottom">Kategori</h5>
        <div class="categories">
            <ul class="list list-border angle-double-right">
                {!! CMS::getCategories() !!}
            </ul>
        </div>
    </div>
    <div class="widget">
        <h5 class="widget-title line-bottom">AGENDA</h5>
        <div class="event media sm-maxwidth400 border-bottom mt-5 mb-0 pt-10 pb-15">
            @foreach (CMS::getAgenda() as $agenda)
            <div class="row mt-10 pl-5">
                <div class="col-xs-2 col-md-3 pr-0">
                    <div class="event-date text-center bg-theme-colored border-1px p-0 pt-10 pb-10 sm-custom-style">
                        <ul>
                            <li class="font-28 text-white font-weight-700">{!!$agenda->start->format('d')!!}</li>
                            <li class="font-18 text-white text-center text-uppercase">{!!$agenda->start->format('M')!!}
                            </li>
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
                            <li> <i class="fa fa-map-marker text-theme-colored"></i> {!!$agenda->lokasi!!} </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="widget">
        <h5 class="widget-title line-bottom">Latest News</h5>
        <div class="latest-posts">
            @foreach (CMS::getLastNews() as $lastNews)
            <article class="post media-post clearfix pb-0 mb-10">
                <a class="post-thumb"
                    href="{!!route('home.showPost',['id'=>$lastNews->id,'post'=>$lastNews->slug])!!}"><img
                        src="{!!CMS::getImage($lastNews->id_media,true)!!}" width="75" /></a>
                <div class="post-right">
                    <h5 class="post-title mt-0"><a
                            href="{!!route('home.showPost',['id'=>$lastNews->id,'post'=>$lastNews->slug])!!}">{!!$lastNews->title!!}</a>
                    </h5>
                    <p>{!!CMS::excerpt($lastNews->content,6)!!}</p>
                </div>
            </article>
            @endforeach
        </div>
    </div>
    {!! CMS::getSidebarTopAds(4)!!}
</div>