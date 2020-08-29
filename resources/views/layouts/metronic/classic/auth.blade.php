<!DOCTYPE html><!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Version: 5.0.3
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			{{ config('app.name', 'GroSIRI') }}
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
		<!--begin::Base Styles --> 

		<link href="{{ asset('metronic/vendors/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="{{ asset('metronic/media/img/logo/favicon.ico') }}" />

		<style>
			body { background-color: #4323AA; }
		</style>
	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-1" id="m_login" style="background-image: url({{ asset('metronic/media/img/bg/bg-1.jpg')}})">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img src="{{ asset('metronic/media/img/logos/logo-1.png')}}">
							</a>
						</div>
						
						@yield('content') 

					</div>
				</div>
			</div>
		</div>
		<!-- end:: Page -->
		<!--begin::Base Scripts --> 
		<script src="{{ mix('metronic/vendors/vendors.bundle.js') }}"></script>
		<script src="{{ mix('metronic/base/scripts.bundle.js') }}"></script>

		<!--end::Page Snippets -->
	</body>
	<!-- end::Body -->
</html>
