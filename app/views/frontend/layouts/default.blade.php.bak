<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>MediaCloud</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

   <!-- BEGIN GLOBAL MANDATORY STYLES -->
   <link href="/_frontend/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="/_frontend/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->

   <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
   <link href="/_frontend/assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
   <link rel="stylesheet" href="/_frontend/assets/plugins/revolution_slider/css/rs-style.css" media="screen">
   <link rel="stylesheet" href="/_frontend/assets/plugins/revolution_slider/rs-plugin/css/settings.css" media="screen">
   <link href="/_frontend/assets/plugins/bxslider/jquery.bxslider.css" rel="stylesheet" />
   <!-- END PAGE LEVEL PLUGIN STYLES -->

   <!-- BEGIN THEME STYLES -->
   <link href="/_frontend/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="/_frontend/assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="/_frontend/assets/css/themes/blue.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="/_frontend/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="/_frontend/assets/css/custom.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->

   <!-- BEGIN CUSTOM STYLES -->
   <link href="/assets/css/frontend-style.css" rel="stylesheet" type="text/css"/>
   <!-- END CUSTOM STYLES -->

   <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body>


	  <!-- BEGIN HEADER -->
	<div class="header navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<button class="navbar-toggle btn navbar-btn" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN LOGO (you can use logo image instead of text)-->
				<a class="navbar-brand" href="/">
					<img src="/assets/img/WSU.jpg" id="logoimg" alt="">Media Cloud
				</a>
				<!-- END LOGO -->
			</div>


			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">




					@if (Sentry::check())
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">
							Welcome {{Sentry::getUser()->username}}! <i class="icon-angle-down"></i></a>
							<ul class="dropdown-menu">
								<!-- <li class="active"><a href="index.html">Home Default</a></li> -->
								@if (Sentry::getUser()->hasAccess('admin'))
									<li><a href="{{URL::to('/admin')}}">Admin</a></li>
								@endif


								<li><a href="{{URL::to('logout')}}">Logout</a></li>
							</ul>
						</li>
					@else
						<li><a id="login" href="{{URL::to('login')}}" target="">Login</a></li>
					@endif




				</ul>
			</div>
			<!-- BEGIN TOP NAVIGATION MENU -->
		</div>


	</div>
	<!-- END HEADER -->

	<!-- BEGIN ALERTS -->
	<div id="alerts">
		@if(Session::has('message'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<p>{{Session::get('message')}}</p>
		</div>
		@endif

		@if(Session::has('info'))
		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<p>{{Session::get('info')}}</p>
		</div>
		@endif

		@if(Session::has('error'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<p>{{Session::get('error')}}</p>
		</div>
		@endif

		@if($errors->has())
		<div class="alert alert-danger error">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h2>Error</h2>
			@foreach($errors->all('<p>:message</p>') as $error)
			{{$error}}
			@endforeach
		</div>
		@endif
	</div>
	<!-- END ALERTS -->



@yield('content')

	<!-- BEGIN COPYRIGHT -->
	<div class="container">
		<div class="navbar navbar-fixed-bottom copyright">
			<div class="row">
				<div class="col-md-8 col-sm-8">
					<p>
						<span class="margin-right-10">2013 © Media Cloud. ALL Rights Reserved.</span>
						<a href="/privacy-policy">Privacy Policy</a> | <a href="/terms-of-services">Terms of Service</a> | <a href="/faq">FAQ</a>
					</p>
				</div>
				<div class="col-md-4 col-sm-4">
					<ul class="social-footer">
						<li><a href="#"><i class="icon-facebook"></i></a></li>
						<li><a href="#"><i class="icon-google-plus"></i></a></li>
						<li><a href="#"><i class="icon-dribbble"></i></a></li>
						<li><a href="#"><i class="icon-linkedin"></i></a></li>
						<li><a href="#"><i class="icon-twitter"></i></a></li>
						<li><a href="#"><i class="icon-skype"></i></a></li>
						<li><a href="#"><i class="icon-github"></i></a></li>
						<li><a href="#"><i class="icon-youtube"></i></a></li>
						<li><a href="#"><i class="icon-dropbox"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- END COPYRIGHT -->

	<!-- Load javascripts at bottom, this will reduce page load time -->
	<!-- BEGIN CORE PLUGINS(REQUIRED FOR ALL PAGES) -->
	<!--[if lt IE 9]>
	<script src="/_frontend/assets/plugins/respond.min.js"></script>
	<![endif]-->
	<script src="/_frontend/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="/_frontend/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<script src="/_frontend/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/_frontend/assets/plugins/hover-dropdown.js"></script>
	<script type="text/javascript" src="/_frontend/assets/plugins/back-to-top.js"></script>
	<!-- END CORE PLUGINS -->

	<!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
	<script type="text/javascript" src="/_frontend/assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="/_frontend/assets/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
	<script type="text/javascript" src="/_frontend/assets/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script type="text/javascript" src="/_frontend/assets/plugins/bxslider/jquery.bxslider.min.js"></script>
	<script src="/_frontend/assets/scripts/app.js"></script>
	<script src="/_frontend/assets/scripts/index.js"></script>
	<script src="/assets/js/main.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			App.init();
			App.initBxSlider();
			Index.initRevolutionSlider();
		});
	</script>

	 @yield('scripts')


</body>
<!-- END BODY -->


</html>