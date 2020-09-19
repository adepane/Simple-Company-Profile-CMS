<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->

<head>
    <meta charset="utf-8" />
    <title>{!! CMS::getSetting('tagline')."- Login" !!}</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href={!! asset("assets/css/pages/login/login-3.css") !!} rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href={!! asset("assets/plugins/global/plugins.bundle.css") !!} rel="stylesheet" type="text/css" />
    <link href={!! asset("assets/css/style.bundle.css") !!} rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href={!! asset("assets/css/skins/header/base/light.css") !!} rel="stylesheet" type="text/css" />
    <link href={!! asset("assets/css/skins/header/menu/light.css") !!} rel="stylesheet" type="text/css" />
    <link href={!! asset("assets/css/skins/brand/dark.css") !!} rel="stylesheet" type="text/css" />
    <link href={!! asset("assets/css/skins/aside/dark.css") !!} rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{!! asset(CMS::getSetting('favicon')) !!}" />
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body
    class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
                style="background-image: url(assets/media/bg/bg-3.jpg);">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="#">
                                <img src="{!! asset(CMS::getSetting('logo')) !!}">
                            </a>
                        </div>
                        <div class="kt-login__signin">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">{!! CMS::getSetting('title') !!}</h3>
                            </div>
                            @if(session()->has('message'))
                            <div class="alert alert-danger">
                                {{ session()->get('message') }}
                            </div>
                            @endif
                            <form class="kt-form" method="POST" action="{{ route('login') }}">
                                @csrf
                            
                                <div class="form-group">
                                    <input placeholder="Email" id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            
                                <div class="form-group">
                                    <input placeholder="Password" id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password" required
                                        autocomplete="current-password">
                            
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            
                                <div class="row kt-login__extra">
                                    <div class="col">
                                        <label class="kt-checkbox">
                                            <input type="checkbox" name="remember"> Remember me
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="kt-login__actions">
                            
                                    <button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">
                                        {{ __('Login') }}
                                    </button>
                            
                            
                                </div>
                            </form>
                        </div>
                        <div class="kt-login__account">
                            <span class="kt-login__account-msg">
                                &copy; {!! date('Y') !!}  <a href="{!! env('APP_URL') !!}">{!! CMS::getSetting('tagline') !!}</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- tidakpakai --}}
    <!-- begin:: Page -->

    <!-- end:: Page -->

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        // document.getElementById('importSampleDataForm').elements.length;
        var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
    </script>

    <!-- end::Global Config -->

    <script src={!! asset("assets/plugins/global/plugins.bundle.js") !!} type="text/javascript"></script>
    <script src={!! asset("assets/js/scripts.bundle.js") !!} type="text/javascript"></script>
    
    <!--end::Global Theme Bundle -->
    
    <!--begin::Page Scripts(used by this page) -->
    <script src={!! asset("assets/js/pages/custom/login/login-1.js") !!} type="text/javascript"></script>

    <!--end::Global App Bundle -->
</body>

<!-- end::Body -->

</html>