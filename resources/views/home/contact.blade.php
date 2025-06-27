@extends('home._app')
@push('header')
<title>Hubungi Kami - {!! CMS::getSetting('tagline') !!}</title>
<meta name="description" content="{!! CMS::getSetting('tagline') !!}, {!!CMS::getSetting('address')!!}" />
@endpush
@section('content')
<section class="inner-header divider parallax layer-overlay layer-pattern">
  <div class="container pt-10 pb-20">
    <div class="section-content pt-10">
      <div class="row">
        <div class="col-md-12">
          <h3 class="title text-white">Hubungi Kami</h3>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container mt-30 mb-30 pt-30 pb-30">
    <div class="row">

      <div class="col-md-9">
        @if(session()->has('message'))
        <div class="alert alert-success">
          {{ session()->get('message') }}
        </div>
        @endif
        <div class="bg-lightest border-1px p-30 mb-0">
          <h3 class="text-theme-colored mt-0 pt-5"> Contact Us</h3>
          <hr>
          <p>{!!CMS::getSetting('address')!!}</p>
          <div class="alert alert-info">
            <p>Contact form functionality is currently unavailable. Please contact us through the address provided above.</p>
          </div>
          <!-- Job Form Validation-->

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
@endpush
