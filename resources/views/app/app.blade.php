<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Control de Stock</title>

	<!-- app.css -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	
	<!-- toastr.css -->
	<link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
</head>
<body>
	@include('app.nav')
	@yield('content')
	<script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="https://kit.fontawesome.com/6a9cf36c74.js"></script>
	@yield('scripts')
</body>
</html>