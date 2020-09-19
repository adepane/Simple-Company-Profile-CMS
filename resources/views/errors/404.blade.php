@extends('home._app')
@section('preloader')
@endsection
@section('header')
    <title>NOT FOUND 404  - {!! CMS::getSetting('title') !!}</title>
    <meta name="author" content="DigitalCreative" />
    <style>
        .portfolio-view {
            left:42%!important;
            right:0px!important;
            top:50%!important;
        }
        .gallery-isotope .gallery-item .thumb {
            max-height:230px!important;
        }
    </style>
@endsection
@section('content')
<section id="home" class="divider fullscreen bg-lightest">
      <div class="display-table text-center">
        <div class="display-table-cell">
          <div class="container pt-0 pb-0">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <h1 class="font-150 text-theme-colored mt-0 mb-0"><i class="fa fa-map-signs text-gray-silver"></i>404!</h1>
                <h2 class="mt-0">Oops! Page Not Found</h2>
                <p>The page you were looking for could not be found.</p>
                <a class="btn btn-border btn-gray btn-transparent btn-circled" href="{{url('/')}}">Return Home</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection