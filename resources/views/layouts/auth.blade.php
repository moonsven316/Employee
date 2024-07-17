<!DOCTYPE html>
<html
	lang="en"
	class="light-style customizer-hide"
	dir="ltr"
	data-theme="theme-default"
	data-assets-path="{{ asset('assets/') }}"
	data-template="vertical-menu-template-free"
>
	<head>
		<meta charset="utf-8" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
		/>

		<title>{{ env('APP_NAME') }}</title>

		<meta name="description" content="" />

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Gentelella Alela! | </title>
		<!-- Bootstrap -->
		<link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
		<!-- NProgress -->
		<link href="{{ asset('assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
		<!-- Animate.css -->
		<link href="{{ asset('assets/vendors/animate.css/animate.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

		<!-- Custom Theme Style -->
		<link href="{{ asset('assets/build/css/custom.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/build/css/custom.css') }}" rel="stylesheet">
		

	</head>

	<body class="login">
		@yield('content')
	</body>
	<script src="{{ asset('assets/build/js/clock.js') }}"></script>
	<!-- jQuery -->
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('assets/vendors/fastclick/lib/fastclick.js') }}"></script>
	<!-- NProgress -->
	<script src="{{ asset('assets/vendors/nprogress/nprogress.js') }}"></script>
	<!-- bootstrap-progressbar -->
	<script src="{{ asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
	<!-- iCheck -->
	<script src="{{ asset('assets/vendors/iCheck/icheck.min.js') }}"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="{{ asset('assets/vendors/moment/min/moment.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
	<!-- bootstrap-wysiwyg -->
	<script src="{{ asset('assets/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
	<script src="{{ asset('assets/vendors/google-code-prettify/src/prettify.js') }}"></script>
	<!-- jQuery Tags Input -->
	<script src="{{ asset('assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
	<!-- Switchery -->
	<script src="{{ asset('assets/vendors/switchery/dist/switchery.min.js') }}"></script>
	<!-- Select2 -->
	<script src="{{ asset('assets/vendors/select2/dist/js/select2.full.min.js') }}"></script>
	<!-- Parsley -->
	<script src="{{ asset('assets/vendors/parsleyjs/dist/parsley.min.js') }}"></script>
	<!-- Autosize -->
	<script src="{{ asset('assets/vendors/autosize/dist/autosize.min.js') }}"></script>
	<!-- jQuery autocomplete -->
	<script src="{{ asset('assets/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
	<!-- starrr -->
	<script src="{{ asset('assets/vendors/starrr/dist/starrr.js') }}"></script>
	<!-- Custom Theme Scripts -->
	<script src="{{ asset('assets/build/js/custom.min.js') }}"></script>
	@yield('script')
</html>
