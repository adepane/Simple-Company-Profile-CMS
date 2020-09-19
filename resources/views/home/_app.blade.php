<!DOCTYPE html>
<html dir="ltr" lang="id">

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link href="https://fonts.googleapis.com/css?family=Poppins|Raleway&display=swap" rel="stylesheet">
    <link href="{!! asset(CMS::getSetting('favicon')) !!}" rel="shortcut icon" type="image/png">
    <link href="{!! asset("/front/css/bootstrap.min.css") !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset("/front/css/jquery-ui.min.css") !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset("/front/css/animate.css") !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset("/front/css/css-plugin-collections.css") !!}" rel="stylesheet" />
    <link href="{!! asset("/front/css/menuzord-skins/menuzord-rounded-boxed.css") !!}" rel="stylesheet"
        id="menuzord-menu-skins" />
    <link href="{!! asset("/front/css/style-main.css") !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset("/front/css/preloader.css") !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset("/front/css/custom-bootstrap-margin-padding.css") !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset("/front/css/responsive.css") !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset("/front/js/revolution-slider/css/settings.css") !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset("/front/js/revolution-slider/css/layers.css") !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset("/front/js/revolution-slider/css/navigation.css") !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset("/front/css/colors/theme-skin-red.css") !!}" rel="stylesheet" type="text/css" />
    @stack('header')

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    {!! CMS::getSetting('googleanalytics') !!}
</head>

<body class="">
    <div id="wrapper" class="clearfix">
        @yield('preloader')

        <header class="header">
            <div class="header-top bg-theme-colored sm-text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="widget no-border m-0">
                                <ul
                                    class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm flip sm-pull-none sm-text-center mt-sm-15">
                                    <li><a href="{!! CMS::getSetting('facebook') !!}" target="_blank"><i
                                                class="fa fa-facebook text-white"></i></a></li>
                                    <li><a href="{!! CMS::getSetting('instagram') !!}" target="_blank"><i
                                                class="fa fa-instagram text-white"></i></a></li>
                                    <li><a href="{!! CMS::getSetting('twitter') !!}" target="_blank"><i
                                                class="fa fa-twitter text-white"></i></a></li>
                                    <li><a href="{!! CMS::getSetting('yt_channel') !!}" target="_blank"><i
                                                class="fa fa-youtube-play text-white"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="widget no-border m-0">
                                <ul class="list-inline pull-right sm-pull-none sm-text-center mt-5">
                                    <li class="m-0 pl-10 pr-10">
                                        <i class="fa fa-phone text-black"></i>
                                        <a href="tel:{!! CMS::getSetting('phone') !!}" class="text-black">Hotline : {!!
                                            CMS::getSetting('phone') !!}</a>
                                    </li>
                                    <li class="m-0 pl-10 pr-10">
                                        <i class="fa fa-envelope text-black"></i>
                                        <a href="mailto:{!! CMS::getSetting('email') !!}" class="text-black">{!!
                                            CMS::getSetting('email') !!}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-nav">
                <div class="header-nav-wrapper navbar-scrolltofixed bg-silver-light">
                    <div class="container">
                        <nav id="menuzord-right" class="menuzord default no-bg">
                            <a class="menuzord-brand pull-left flip" href="{!! url("") !!}"><img
                                    src="{!! asset(CMS::getSetting('logo')) !!}" alt=""></a>
                            <ul class="menuzord-menu">
                                {!! CMS::getNav(CMS::getSetting('menu_top')) !!}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <div class="main-content">
            @yield('content')
        </div>

        <footer id="footer" class="footer" data-bg-color="#25272e">
            <div class="container pt-70 pb-40">
                <div class="row border-bottom-black">
                    <div class="col-sm-12 col-md-3">
                        <div class="widget dark">
                            <img class="mt-10 mb-20" alt="" src="{!! asset(CMS::getSetting('logo_footer')) !!}">
                            <p>{!! CMS::getSetting('address') !!}</p>
                            <ul class="list-inline mt-5">
                                <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-colored mr-5"></i> <a
                                        class="text-gray" href="tel:{!! CMS::getSetting('phone') !!}">{!!
                                        CMS::getSetting('phone') !!}</a> </li>
                                <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-colored mr-5"></i> <a
                                        class="text-gray" href="mailto:{!! CMS::getSetting('email') !!}">{!!
                                        CMS::getSetting('email') !!}</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <div class="widget dark">
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
                                    </div>
                                </article>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="widget dark">
                            <h5 class="widget-title line-bottom">Navigation</h5>
                            {!! CMS::getNav(CMS::getSetting('menu_bottom')) !!}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="widget dark">
                            <h5 class="widget-title line-bottom">Useful Links</h5>
                            {!! CMS::getNav(CMS::getSetting('site_link')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom bg-black-333">
                <div class="container pt-15 pb-10">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="font-11 text-black-777 m-0">Copyright &copy;{!!date('Y')!!} {!!
                                CMS::getSetting('title') !!}. All Rights Reserved
                            </p>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="widget no-border m-0">
                                <ul class="list-inline sm-text-center mt-5 font-12">
                                    <li>
                                        Simple CMS Company Profile by
                                        <a href="{!!config('app.author')!!}" target="_blank">Ade Pane</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
    </div>

    <script src="{!! asset("/front/js/jquery.min.js") !!}"></script>
    <script src="{!! asset("/front/js/jquery-2.2.4.min.js") !!}"></script>
    <script src="{!! asset("/front/js/jquery-ui.min.js") !!}"></script>
    <script src="{!! asset("/front/js/bootstrap.min.js") !!}"></script>
    <script src="{!! asset("/front/js/jquery-plugin-collection.js") !!}"></script>
    <script src="{!! asset("/front/js/revolution-slider/js/jquery.themepunch.tools.min.js") !!}"></script>
    <script src="{!! asset("/front/js/revolution-slider/js/jquery.themepunch.revolution.min.js") !!}"></script>
    <script src="{!! asset("/front/js/custom.js") !!}"></script>
    @stack('footer')

</body>
</html>