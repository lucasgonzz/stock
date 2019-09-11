<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Control de Stock</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- app.css -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	
	<!-- toastr.css -->
	<link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
</head>
<body>
	@include('app.nav')
	<div class="container">
		@yield('content')
	</div>
	<script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="https://kit.fontawesome.com/6a9cf36c74.js"></script>
	@yield('scripts')
</body>
</html>