<!DOCTYPE html> 
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			{{ config('app.name', 'Upstage') . ": " .$title }}
		</title>

		<meta property="og:title" content="{{$title}}">
		<meta property="og:description" content="{{$desc ?? 'Welcome to upstage'}}">
		<meta property="og:image" content="{{ $imgurl ?? asset('/img/logo.png') }}">
		<meta property="og:url" content="{{$linkurl}}">
		<meta name="twitter:card" content="summary_large_image">

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
		<link rel="shortcut icon" href="{{ asset('img/icon.png') }}" />

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
			.md-none .sm-none {}
			.profile-head-dllinks a { text-decoration: none; }
			.pubprofile-header img {
				width: 100px;
				border-radius: 50%;
				border: 5px solid #fff;
			}
			.listing-box, .listing-wrap {position: relative;}
			.listing-name { position: absolute; bottom: 0px; left: 0px; background: rgba(0,0,0,0.3); }
			video:focus { outline: none; }

			/*.responsive visibility */
			@media (max-width: 1600px) {
			     
			}
			@media (max-width: 1200px) {
			    .lg-none {display: none !important;}
			}
			@media (max-width: 992px) {
			    .md-none {display: none !important;}
			}
			@media (max-width: 768px) {
			    .sm-none {display: none !important;}
			}
			@media (max-width: 480px) {
			    .xs-none {display: none !important;}
			}
		</style>
	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile "  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- BEGIN: Header -->
			@include('layouts.metronic.profile.header')
			<!-- END: Header -->
			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<!-- BEGIN: Left Aside --> 
				<!-- END: Left Aside -->
				<div id="app" class="m-grid__item m-grid__item--fluid m-wrapper"> 
					@yield('content') 
				</div>
			</div>
			<!-- end:: Body -->
			<!-- begin::Footer -->
			@include('layouts.metronic.profile.footer')
			<!-- end::Footer -->
		</div>

		<script src="{{ mix('js/app.js') }}"></script>
		<script src="{{ mix('metronic/vendors/vendors.bundle.js') }}"></script>
		<script src="{{ mix('metronic/base/scripts.bundle.js') }}"></script>

		<script>
			console.log('listinng js')
			// pause video when closing modal
			$('.modal').on('hidden.bs.modal', function (e) {
				let elVideo = $(this).find('video.video-item-player');
				
				if(elVideo && elVideo.length) { 
					elVideo.get(0).pause();
				}
			})
		</script>	
	 
	</body>
	<!-- end::Body -->
</html>
