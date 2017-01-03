<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
	<title>MediaCloud</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/_frontend/assets/css/style.css">
	<link rel="stylesheet" href="/assets/css/bootstrap-editable.css">

	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<style type="text/css" media="Screen">
		@import url("/assets/css/master.css");
	</style>

	@yield('style')

</head>

<!--  -->
<body class="">

	<div id="main-nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
        <a class="navbar-brand navbar-brand-size" href="/">
        	<img id="logo-brand" src="/assets/img/WSU_InstSig_horiz1.png" alt=""> <span>Media Cloud</span>
        </a>
    </div>

    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="pull-right">
    	<ul class="nav navbar-nav">
    		@if (Sentry::check())
    		<li class="dropdown">
    			<a class="dropdown-toggle" data-toggle="dropdown" data-click="dropdown" data-delay="0" data-close-others="false" href="#">
    				Welcome {{Sentry::getUser()->username}}! <i class="fa fa-angle-down"></i></a>
    				<ul class="dropdown-menu">
    					<!-- <li class="active"><a href="index.html">Home Default</a></li> -->
    					@if (Sentry::getUser()->hasAccess('admin'))
    					<li><a href="{{URL::to('/admin')}}">Admin</a></li>
    					@endif
    					@if (Sentry::getUser()->hasAccess('manage'))
    					<li><a href="{{URL::to('/manage')}}">Manage</a></li>
    					@endif


    					<li><a href="{{URL::to('logout')}}">Logout</a></li>
    				</ul>
    			</li>
    			@else
    			<li><a id="login" href="{{URL::to('login')}}" target="">Login</a></li>
    			@endif
    		</ul>
    	</div>
    	<!-- END TOP NAVIGATION MENU -->
    	<!--/.nav-collapse -->
    </div>
</div>

@yield('content')

<div id="share-container"></div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- Manage.blade.php -->
    <script src="/bower/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="/assets/js/dropzone.js"></script>
    <script src="/bower/underscore/underscore.js"></script>
    <!-- / Manage.blade.php -->

    <!-- Page Scripts -->
    @yield('scripts')
    <!-- /Page Scripts -->

</body>
</html>
