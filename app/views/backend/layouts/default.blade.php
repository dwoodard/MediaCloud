<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			Administration
			@show
		</title>
		<meta name="keywords" content="Media Cloud" />
		<meta name="author" content="Dustin Woodard" />
		<meta name="description" content="" />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
		<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/bootstrap-responsive.css') }}" rel="stylesheet">

		<style>
		@section('styles')
		body {
			padding: 60px 0;
		}
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" href="{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}">
		<link rel="shortcut icon" href="{{ asset('assets/ico/favicon.png') }}">
	</head>

	<body>

		<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">Media Cloud</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li{{ (Request::is('admin') ? ' class="active"' : '') }}><a href="{{ URL::to('admin') }}"><i class="icon-home icon-white"></i> Dashboard</a></li>
				<li{{ (Request::is('admin/assets') ? ' class="active"' : '') }}><a href="{{ URL::to('admin/assets') }}"><i class="icon-home icon-white"></i> Assets</a></li>

				<li class="dropdown{{ (Request::is('admin/users*|admin/groups*') ? ' active' : '') }}">
					<a class="dropdown-toggle" data-toggle="dropdown" href="{{ URL::to('admin/users') }}">
						<i class="icon-user icon-white"></i> Users <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li{{ (Request::is('admin/users*') ? ' class="active"' : '') }}><a href="{{ URL::to('admin/users') }}"><i class="icon-user"></i> Users</a></li>
						<li{{ (Request::is('admin/groups*') ? ' class="active"' : '') }}><a href="{{ URL::to('admin/groups') }}"><i class="icon-user"></i> Groups</a></li>
					</ul>
				</li>
			</ul>

			<ul class="nav navbar-nav pull-right">
				<li><a href="{{ URL::to('logout') }}">Logout</a></li>
			</ul>
			</div><!-- /.navbar-collapse -->
			</nav>


		<!-- Container -->
		<div class="container">


			<!-- Notifications -->
			@include('frontend/_partials/notifications')

			<!-- Content -->
			@yield('content')
		</div>

		<!-- Javascripts ================================================== -->
		<script src="{{ asset('assets/js/jquery.1.10.2.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
	</body>
</html>
