<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"{{ (!empty($htmlAttribute)) ? $htmlAttribute : '' }}>
<head>
	@include('layouts.partial.head')

	@yield('styles')

</head>
<body class="{{ (!empty($bodyClass)) ? $bodyClass : '' }}">
	@yield('content')

	@include('layouts.partial.scroll-top-btn')

	@include('layouts.partial.scripts')

	@yield('scripts')


</body>


</html>
