<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	  <!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
	<!-- Theme style -->
</head>
<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
	<div class="wrapper">
		@include('layouts.header')
		@include('layouts.sidebar')

		@yield('content')

		@include('layouts.footer')
	</div>
</body>
</html>