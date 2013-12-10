<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			Phone Home
			@show
		</title>
		<meta name="keywords" content="phone, home, cheap, easy" />
		<meta name="author" content="Hereward Fenton" />
		<meta name="description" content="A convenient, cheap and flexible way to keep in touch with your contacts while overseas." />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
        {{ Basset::show('public.css') }}

        <link href="/assets/css/custom.css" type="text/css" rel="stylesheet">

		<style>
		@section('styles')
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
		<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon2.png') }}}">
	</head>

	<body>
		<!-- To make sticky footer need to wrap in a div -->
		<div id="wrap">
		<!-- Navbar -->
        @include('site/navigation')
		<!-- ./ navbar -->

		<!-- Container -->
		<div class="container">

            <div class="row">
			<!-- Notifications -->
			@include('notifications')
			<!-- ./ notifications -->
            </div>

            <div class="row">
			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
            </div>
		</div>
		<!-- ./ container -->

		<!-- the following div is needed to make a sticky footer -->
		<div id="push"></div>
		</div>
		<!-- ./wrap -->


	    <div id="footer">
	      <div class="container">
	        <p class="muted credit ph_footer">PhoneHome.asia - all rights reserved.</p>
	      </div>
	    </div>

		<!-- Javascripts
		================================================== -->
        {{ Basset::show('public.js') }}
	</body>
</html>
