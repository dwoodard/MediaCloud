<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MediaCloud</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Place favicon.ico and apple-touch-icon(s) in the root directory -->

	<link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<style type="text/css" media="Screen">
		@import url("assets/css/master.css");
	</style>

	@yield('style')


</head>


<body>

    <div id="main-nav" class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">
          	<img width="45%"src="assets/img/WSU_InstSig_horiz1.png" alt=""> <span>Media Cloud</span>
          	<!-- <img width="50%"src="assets/img/WSU_InstSig_horiz1.png" alt=""> <span>Media Cloud</span> -->
          </a>
        </div>

        			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="navbar-collapse collapse pull-right">
				<ul class="nav navbar-nav">
					@if (Sentry::check())
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" data-click="dropdown" data-delay="0" data-close-others="false" href="#">
							Welcome {{Sentry::getUser()->username}}! <i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
								<!-- <li class="active"><a href="index.html">Home Default</a></li> -->
								@if (Sentry::getUser()->hasAccess('admin'))
									<li><a href="{{URL::to('/admin')}}">Admin</a></li>
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


        <!--
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>
         -->
        <!--/.nav-collapse -->
      </div>
    </div>


    @yield('content')


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


	<script src="/bower/jquery/dist/jquery.min.js"></script>
	<script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>

	@yield('scripts')


  </body>
</html>