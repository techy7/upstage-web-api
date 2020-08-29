<!DOCTYPE html> 
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
		<!--begin::Page Vendors --> 
		<!--end::Page Vendors -->
		<link href="{{ asset('metronic/vendors/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="{{ asset('metronic/media/img/logo/favicon.ico') }}" />

		<style>
			.w-30 { width: 30px !important; }
			.w-50 { width: 50px !important; }
			.w-99 { width: 99px !important; }
			.w-200 { width: 200px !important; }
			.w-150 { width: 150px !important; }
			.w-101 { width: 100px !important; }
			.h-0 { height: 0px !important; }
			.p-30 { padding: 30px !important; }
			.px-30 { padding-left: 30px !important; padding-right: 30px !important; }
			.py-30 { padding-top: 30px !important; padding-bottom: 30px !important; }
			[v-cloak] { display: none !important; }
			.bg-metal { background-color: #c4c5d6; }
			.m-portlet--creative-buttons { position: absolute; top: -5rem; right: 0px;} 
			.super-light.m-widget4__item { border-bottom: .07rem dashed #ccc; background-color: #efefef; opacity: 0.7 }
			.m-subheader__breadcrumbs .m-nav__separator { color: #ccc !important; }
			.dash-header-logo { height: 30px; }
		</style>
	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- BEGIN: Header -->
			@include('layouts.metronic.classic.header')
			<!-- END: Header -->
			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<!-- BEGIN: Left Aside -->
				@include('layouts.metronic.classic.sidebar')
				<!-- END: Left Aside -->
				<div id="app" class="m-grid__item m-grid__item--fluid m-wrapper"> 
					@yield('content') 
				</div>
			</div>
			<!-- end:: Body -->
			<!-- begin::Footer -->
			@include('layouts.metronic.classic.footer')
			<!-- end::Footer -->
		</div>
		<!-- end:: Page -->
		<!-- begin::Quick Sidebar --> 
		@include('layouts.metronic.classic.quick_sidebar')
		<!-- end::Quick Sidebar -->
		<!-- begin::Scroll Top -->
		<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end::Scroll Top -->
		 
		<!--begin::Base Scripts -->
		<script src="{{ mix('js/app.js') }}"></script>
		<script src="{{ mix('metronic/vendors/vendors.bundle.js') }}"></script>
		<script src="{{ mix('metronic/base/scripts.bundle.js') }}"></script>
		<!-- script src="{{ asset('metronic/vendors/vendors.bundle.js') }}" type="text/javascript"></script -->
		<!-- script src="{{ asset('metronic/base/scripts.bundle.js') }}" type="text/javascript"></script -->

		<script>
			if($('#city_select2')) {


		        // $('#city_select2').on('select2:clear', function (e) {
		        //     console.log(11)
		        // });	

		        // $('#city_select2').on('select2:unselect', function (e) {
		        //     console.log(22)
		        // });	

		        // $('#city_select2').on('select2:clearing', function (e) {
		        //     console.log(33)
		        // });	
			}
			
		</script>
		<!-- script src="{{ asset('metronic/widgets/select2.js') }}" type="text/javascript"></script -->
		<!--end::Base Scripts -->
		<!--begin::Page Vendors --> 
		<!--end::Page Vendors -->
		<!--begin::Page Snippets -->
		<!-- <script src="{{ asset('metronic/dashboard.js') }}" type="text/javascript"></script> -->
		<!--end::Page Snippets -->
	</body>
	<!-- end::Body -->
</html>
