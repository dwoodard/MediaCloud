<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0;" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="stylesheet" href="/assets/css/app.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link href="/_frontend/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>


   <!-- BEGIN THEME STYLES -->
   <link href="/_frontend/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="/_frontend/assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="/_frontend/assets/css/themes/blue.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="/_frontend/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="/_frontend/assets/css/custom.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->







</head>
<body id="manage">
	<!-- Content -->
	<div id="App" ng-app="mcApp">
		<nav id="manage_nav">
			<ul>
				<li> <a href="#"><i class="fa fa-search fa-3x"></i> <span class="nav-text">Search</span></a></li>
				<li> <a href="#"><i class="fa fa-cloud-upload  fa-3x"></i> <span class="nav-text">Upload</span></a></li>
				<li> <a href="#"><i class="fa fa-folder  fa-3x"></i> <span class="nav-text">Browse</span></a></li>
				<li> <a href="#"><i class="fa fa-th-large  fa-3x"></i> <span class="nav-text">Collections</span></a></li>
			</ul>
		</nav>

		<div id="main">
			<div id="main-header">
				<div id="notifications" class="">
					<div class="container">

						<ul class="nav navbar-nav pull-left">
							<li><a href="#" class="brand">Media Cloud</a></li>
							<li><a id="test1" href="#">test1</a></li>
							<li><a href="#">test2</a></li>
							<li><a href="#">test3</a></li>
						</ul>

						<ul class="nav navbar-nav pull-right">
							<!-- BEGIN NOTIFICATION DROPDOWN -->
							<li class="dropdown" id="header_notification_bar">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<i class="fa fa-warning"></i>
									<span class="badge">6</span>
								</a>
								<ul class="dropdown-menu extended notification">
									<li>
										<p>You have 14 new notifications</p>
									</li>
									<li>
										<ul class="dropdown-menu-list scroller">
											<li>
												<a href="#">
													<span class="label label-sm label-icon label-success"><i class="icon-plus"></i></span>
													New user registered.
													<span class="time">Just now</span>
												</a>
											</li>
											<li>
												<a href="#">
													<span class="label label-sm label-icon label-danger"><i class="icon-bolt"></i></span>
													Server #12 overloaded.
													<span class="time">15 mins</span>
												</a>
											</li>
											<li>
												<a href="#">
													<span class="label label-sm label-icon label-warning"><i class="icon-bell"></i></span>
													Server #2 not responding.
													<span class="time">22 mins</span>
												</a>
											</li>
											<li>
												<a href="#">
													<span class="label label-sm label-icon label-info"><i class="icon-bullhorn"></i></span>
													Application error.
													<span class="time">40 mins</span>
												</a>
											</li>
											<li>
												<a href="#">
													<span class="label label-sm label-icon label-danger"><i class="icon-bolt"></i></span>
													Database overloaded 68%.
													<span class="time">2 hrs</span>
												</a>
											</li>
											<li>
												<a href="#">
													<span class="label label-sm label-icon label-danger"><i class="icon-bolt"></i></span>
													2 user IP blocked.
													<span class="time">5 hrs</span>
												</a>
											</li>

										</ul>
									</li>
									<li class="external">
										<a href="#">See all notifications <i class="m-icon-swapright"></i></a>
									</li>
								</ul>
							</li>
							<!-- END NOTIFICATION DROPDOWN -->
						</ul>
					</div>
				</div>

			</div>
			<div id="main-content">
				<section id="collections" class="hide">
					<div class="root">collections root</div>
					<div class="front">collections front</div>
				</section>
				<section id="browse" class="">
					<div class="root">browse root</div>
					<div class="front">browse front [[2+2]] </div>
				</section>
			</div>

		</div>

		<div id="assets_area">
			<div id="player">myvid</div>
		</div>

	</div>


		<script src="/_frontend/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="/_frontend/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<script src="/_frontend/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.min.js"></script>
	<script src="/app/app.js"></script>

	<script type="text/javascript">
	$("#test1").click(function () {
		console.log('working');
		$("#browse .front").animate({left:"100%"})
	})
	</script>



</body>
</html>
