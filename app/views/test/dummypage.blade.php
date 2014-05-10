<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DUMMY Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<!-- <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> -->
	<link href="/assets/css/player.css" rel="stylesheet">


</head>
<body class="push-menu-open">
	<!-- Player -->
	<div id="mediaplayer-wrapper">
		<!-- <div id="player-video-wrapper">
			<video id="player-video" controls src="http://localhost:8080/asset/5"class="video-js vjs-default-skin"data-setup='{ "controls": true, "autoplay": false, "preload": "auto" }'>
				Your browser does not support the video tag.
			</video>
		</div> -->




		<div id="menu-container" class="carousel slide">
			<div class="carousel-inner">
				<div class="item active">
					<nav id="player-menu-nav" class="">
						<div id="player-menu">
							<header id="menuTitle" class="row">
								<div class="title col-md-8">menuTitle</div>
								<div class="toolbar col-md-4">
									<a href=""> Settings <i class="fa fa-cogs"></i> </a>
								</div>
							</header>

							<div class="row">
							</div>


							<div class="panel-group" id="accordion">
								<div class="menuSection">Playlists</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
												P1
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">

										</div>
									</div>
								</div>

								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
												P2
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">

										</div>
									</div>
								</div>
								<div class="menuSection">Assets</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
												Assets
											</a>
										</h4>
									</div>
									<div id="collapseThree" class="panel-collapse collapse">
										<div class="panel-body">


											<ul class="">
												<li class="row">
													<div class="col-md-8"><a href="">Video 1</a></div>
													<div class="toolbar col-md-4">
														<a href=""> <i class="fa fa-info-circle"></i> </a>
														<a href=""> <i class="fa fa-cloud-download"></i> </a>
													</div>
												</li>
												<li class="row">
													<div class="col-md-8"><a href="">Video 2</a></div>
													<div class="toolbar col-md-4">
														<a href=""> <i class="fa fa-info-circle"></i> </a>
														<a href=""> <i class="fa fa-cloud-download"></i> </a>
													</div>
												</li>
												<li class="row">
													<div class="col-md-8"><a href="">Video 3</a></div>
													<div class="toolbar col-md-4">
														<a href=""> <i class="fa fa-info-circle"></i> </a>
														<a href=""> <i class="fa fa-cloud-download"></i> </a>
													</div>
												</li>
											</ul>

										</div>
									</div>
								</div>
							</div>


						</div>
					</nav>
				</div>
				<div class="item">
					<header>
						<a class="back" data-target="menu-container" data-slide-to="0"> <i class="fa fa-arrow-circle-o-left"></i> Back</a>
					</header>

					<div>
						<p>Put settings here</p>
					</div>
				</div>
			</div>
		</div>










	</div>
	<!-- End Player -->

	<script src="/bower/webshim/js-webshim/minified/polyfiller.js"></script>
	<script src="/bower/jquery/dist/jquery.min.js"></script>
	<script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/assets/js/player.js"></script>


	<script type="text/javascript">

		$(document).ready(function() {
			$('#menu-container').carousel(1);
		})
	</script>




</body>
</html>





















