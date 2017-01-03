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
	<!-- <link href="/_frontend/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/> -->
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
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

	@yield('style')

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
					<span class="fa fa-bars"></span>
				</button>
				<!-- END RESPONSIVE MENU TOGGLER -->
					<a class="navbar-brand" href="/">
						<img src="/assets/img/WSU.jpg" id="logoimg" alt="">Media Cloud
					</a>
			</div>


			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="navbar-collapse collapse">
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
			</div>


		</div>
		<!-- END HEADER -->

	<!-- BEGIN ALERTS-->
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
						<span class="margin-right-10">2014 © MediaCloud. ALL Rights Reserved.</span>
						<a href="/privacy-policy">Privacy Policy</a> | <a href="/terms-of-services">Terms of Service</a> | <a href="/faq">FAQ</a>
					</p>
				</div>
				<div class="col-md-4 col-sm-4">
					<ul class="social-footer">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-skype"></i></a></li>
						<li><a href="#"><i class="fa fa-github"></i></a></li>
						<li><a href="#"><i class="fa fa-youtube"></i></a></li>
						<li><a href="#"><i class="fa fa-dropbox"></i></a></li>
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
	<!--
	<script src="/_frontend/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
-->
<script src="/bower/jquery/dist/jquery.js"></script>
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

<script>
		$(document).ready(function () {
			$('.popupDelete').on("click",function (e) {
				$("#Notify").remove();
			})
		});
		
		 
	</script>


<div id="Notify" class="modal show" role="dialog" style="background:rgba(0,0,0,.5)">
	<div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header" style="background: khaki">
		<h4 class="modal-title">Notice</h4>
		</div>
		<div class="modal-body">
		<h2>We are moving</h2>
		<p>Media Beta is being upgraded to the <a href="https://videos.weber.edu">Kaltura platform</a>. Uploads to media-beta.weber.edu have ended on Dec 31st. For any questions or concerns about uploading content to the new platform, please contact <a href="mailto:bronsonjanes@weber.edu?Subject=Media%20Beta">Bronson Janes</a> or <a href="mailto:dustinwoodard@weber.edu?Subject=Media%20Beta">Dustin Woodard</a>.</p>

		<p>Your links will still work and give you plenty of time to migrate, but to make the migration easier it would be best to start using <a href="https://videos.weber.edu">videos.weber.edu</a></p>

		</div>
		<div class="modal-footer">
		<button type="button" class="popupDelete btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
	</div>
</div>

</body>
<!-- END BODY -->


</html>
