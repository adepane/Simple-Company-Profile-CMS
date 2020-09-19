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
          <form id="contact_us" name="contact_us" action="{!!route('home.kirimPesan')!!}" method="post"
            enctype="multipart/form-data" novalidate="novalidate">
            @csrf
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Full Name <small>*</small></label>
                  <input name="form_name" type="text" placeholder="Enter Name" required="" class="form-control"
                    aria-required="true">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Email <small>*</small></label>
                  <input name="form_email" class="form-control required email" type="email" placeholder="Enter Email"
                    aria-required="true">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Phone <small>*</small></label>
                  <input name="form_phone" class="form-control required phone" type="text"
                    placeholder="Enter Phone Number" aria-required="true">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Subject <small>*</small></label>
                  <input name="form_subject" class="form-control required subject" type="text"
                    placeholder="Enter Subject" aria-required="true">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Message <small>*</small></label>
              <textarea name="form_message" class="form-control required" rows="5" placeholder="Enter your message"
                aria-required="true"></textarea>
            </div>

            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                  <input class="form-control" id="form_x" disabled>
                </div>
              </div>
              <div class="col-sm-1">
                <input class="form-control" disabled value="+"
                  style="background: #fcfcfc;text-align:center;border:none;font-size: 30px;">
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <input class="form-control" id="form_y" disabled>
                </div>
              </div>
              <div class="col-sm-7">
                <div class="form-group">
                  <input id="form_res" name="form_res" class="form-control required answer" type="text"
                    placeholder="Enter Answer" aria-required="true">
                </div>
              </div>
            </div>

            <div class="form-group">
              <input name="form_botcheck" class="form-control" type="hidden" value="">
              <button type="submit" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10"
                data-loading-text="Please wait..." data-return-back="Send">Send</button>
            </div>
          </form>
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
<script type="text/javascript">
  let x = Math.floor(Math.random() * 1000);
  let y = Math.floor(Math.random() * 1000);
  $("#form_x").val(x);
  $("#form_y").val(y);
  $("#contact_us").validate({
    submitHandler: function(form) {
      var x = parseInt($("#form_x").val());
      var y = parseInt($("#form_y").val());
      var z = x + y;
      var resBot = parseInt($('#form_res').val());
      var form_btn = $(form).find('button[type="submit"]');
      var form_result_div = '#form-result';
      $(form_result_div).remove();
      form_btn.before(
        '<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
      var form_btn_old_msg = form_btn.html();
      form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
      if (z === resBot) {
        $(form).ajaxSubmit({
          dataType: 'json',
          success: function(data) {
            if (data.status == 'true') {
              $(form).find('.form-control').val('');
            }
            form_btn.prop('disabled', false).html(form_btn_old_msg);
            $(form_result_div).html(data.message).fadeIn('slow');
            $(form).find('.form-control').css('display', 'none');
            $('label').css('dispay', 'none');
            // setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
          }
        });
      } else {
        alert('Wrong Answer Captcha');
        form_btn.prop('disabled', false).html(form_btn_old_msg);
      }
    }
  });
</script>
@endpush