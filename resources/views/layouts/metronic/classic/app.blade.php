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
		<link rel="shortcut icon" href="{{ asset('img/icon.png') }}" />

		<style>
			.ovh { overflow: hidden;  }
			.w-30 { width: 30px !important; }
			.w-50 { width: 50px !important; }
			.w-99 { width: 99px !important; }
			.w-200 { width: 200px !important; }
			.w-150 { width: 150px !important; }
			.w-101 { width: 100px !important; }
			.h-0 { height: 0px !important; }
			.p-30 { padding: 30px !important; }
			.px-10 { padding-left: 10px !important; padding-right: 10px !important; }
			.px-20 { padding-left: 20px !important; padding-right: 20px !important; }
			.px-30 { padding-left: 30px !important; padding-right: 30px !important; }
			.py-30 { padding-top: 30px !important; padding-bottom: 30px !important; }
			[v-cloak] { display: none !important; }
			.bg-metal { background-color: #c4c5d6; }
			.m-portlet--creative-buttons { position: absolute; top: -5rem; right: 0px;} 
			.super-light.m-widget4__item { border-bottom: .07rem dashed #ccc; background-color: #efefef; opacity: 0.7 }
			.m-subheader__breadcrumbs .m-nav__separator { color: #ccc !important; }
			.dash-header-logo { height: 30px; }
			.md-none .sm-none {}

			.editor-upload-box { position: relative; cursor: pointer; margin-right: 3px; }
			.editor-upload-box .upicon { position: absolute; top: 15px; left: 15px; z-index: 5; display: none; border: 1px solid #333; background: #333; color: #fff; border-radius: 2px; }
			.editor-upload-box img { position: relative; z-index: 2; border: 1px solid #333; }
			.editor-upload-box:hover .upicon { display: block;}
			.editor-upload-box:hover img { opacity: 0.5 }
			.editor-uploadform {position: relative; padding-left: 60px; }
			.editor-uploadform-preview { position: absolute; top: 5px; left: 0px; }

			.mr-40 { margin-right: 40px; }
			.ml-40 { margin-left: 40px; }

			/* chat */
			#chatWrap {

			}
			#chatBox {

			}
			#chatList {
				max-height: 500px;
				overflow-y: auto;
				margin-bottom: 20px;
			}
			#chatItem {

			}

			#chatForm textarea {
				margin-bottom: 10px;
			}

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

		@yield('scripts', '')
		<script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-app.js"></script>
		<script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-messaging.js"></script>
		<script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-analytics.js"></script>

		<script> 
			// var firebaseConfig = {
			// 	apiKey: "AIzaSyDzmCiE8xQV7bnrcfdBJi5h55DDddX56vc",
			// 	authDomain: "apertr-upstage.firebaseapp.com",
			// 	databaseURL: "https://apertr-upstage.firebaseio.com",
			// 	projectId: "apertr-upstage",
			// 	storageBucket: "apertr-upstage.appspot.com",
			// 	messagingSenderId: "77943000085",
			// 	appId: "1:77943000085:web:7bfae79c05cc665277921c",
			// 	measurementId: "G-M6248ND222"
			// };

			// // Initialize Firebase 
			// firebase.initializeApp(firebaseConfig);
			// firebase.analytics();

			// const messaging = firebase.messaging();

			// messaging.onMessage(function(payload) {
			//     console.log(payload)
			// });
		</script>
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
