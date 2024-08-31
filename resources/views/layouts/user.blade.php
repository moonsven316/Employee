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
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Meta, title, CSS, favicons, etc. -->
		<link href="{{ asset('assets/img/favicon/favicon.png') }}" rel="icon">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Bootstrap -->
		<link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
		<!-- NProgress -->
		<link href="{{ asset('assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
		<!-- Animate.css -->
		<link href="{{ asset('assets/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

		<!-- Custom Theme Style -->
		<link href="{{ asset('assets/build/css/custom.min.css') }}" rel="stylesheet">
		
		<!-- iCheck -->
		<link href="{{ asset('assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
		
		<!-- bootstrap-progressbar -->
		<link href="{{ asset('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
		<!-- JQVMap -->
		<link href="{{ asset('assets/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
		<link href="{{ asset('assets/build/css/custom.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}" />
	</head>

	<body class="login">
		@yield('content')
	</body>
	<script src="{{ asset('assets/build/js/clock.js') }}"></script>
	<!-- jQuery -->
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
		@yield('script')
</html>
