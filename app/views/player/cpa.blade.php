<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Weber State University - Media Player</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<!-- <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> -->
	<link href="/assets/css/player.css" rel="stylesheet">

	<style>
		.vjs-control.vjs-vidMenu-button:before {
			font-family: verdana;
			content: "MENU";
		}
	</style>

</head>
<body class="push-menu-open">
	<!-- Player -->
	<div id="mediaplayer-wrapper">
		<div id="player-video-wrapper">
			<video id="player-video" controls src="http://localhost:8080/asset/5"class="video-js vjs-default-skin"data-setup='{ "controls": true, "autoplay": false, "preload": "auto" }'>
				Your browser does not support the video tag.
			</video>
		</div>

		<!-- caurosel slide menu -->

		<!-- end caurosel -->


		<nav id="player-menu-nav">
			<div id="menu-container" class="context-menu carousel slide">
				<div class="carousel-inner">
					<!-- Main Menu -->
					<div id="player-menu" class="item active">
						<header id="menuTitle" class="row">
							<div class="title col-md-8">menuTitle</div>
							<div class="toolbar col-md-4">
								<a href="#" id="btn-settings" data-target="#menu-container" data-slide-to="1">
									Settings <i class="fa fa-cogs"></i>
								</a>
							</div>
						</header>

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
											<li class="row">
												<div class="col-md-8"><a href="">Video 4</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 5</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 6</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 7</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 8</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 9</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 10</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 11</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 12</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 13</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 14</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 15</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 16</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 17</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 18</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 19</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 20</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 21</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
										</ul>
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
											<li class="row">
												<div class="col-md-8"><a href="">Video 4</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 5</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 6</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 7</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 8</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 9</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
											<li class="row">
												<div class="col-md-8"><a href="">Video 10</a></div>
												<div class="toolbar col-md-4">
													<a href=""> <i class="fa fa-info-circle"></i> </a>
													<a href=""> <i class="fa fa-cloud-download"></i> </a>
												</div>
											</li>
										</ul>

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
					<!-- Main Menu -->

					<div id="player-settings" class="item">
						<header>
							<a class="back" data-target="#menu-container" data-slide-to="0"> <i class="fa fa-arrow-circle-o-left"></i> Back</a>
						</header>
						<div class="menuSection">Video Settings</div>
						<div id="settings-panel">
							<p>Put settings here</p>

						</div>
					</div>

				</div>
			</div>
		</nav>

	</div>
	<!-- End Player -->

	<script src="/bower/webshim/js-webshim/minified/polyfiller.js"></script>
	<script src="/bower/jquery/dist/jquery.min.js"></script>
	<script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/assets/js/player.js"></script>

	<link href="http://vjs.zencdn.net/4.1.0/video-js.css" rel="stylesheet">
	<script src="http://vjs.zencdn.net/4.1.0/video.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			player = new Player({
				dataURL: "/{{$type}}/{{$collection->id}}/cpa",
				type: "{{$type}}"
			});


			$('#menu-container').carousel(0).carousel('pause');
		})


		videojs.Menu = videojs.Button.extend({
			init: function(player, options){
				videojs.Button.call(this, player, options);
				this.on('click', this.onClick);
			}
		});

		videojs.Menu.prototype.onClick = function() {
			$("body").toggleClass('push-menu-open')
			console.log("Menu!");
		};

		var createMenuButton = function() {
			var props = {
				className: 'vjs-vidMenu-button vjs-control',
				innerHTML: '<div class="vjs-control-content"><span class="vjs-control-text">' + ('Menu') + '</span></div>',
				role: 'button',
				'aria-live': 'polite',
				tabIndex: 0
			};
			return videojs.Component.prototype.createEl(null, props);
		};

		var vidMenu;
		videojs.plugin('vidMenu', function() {
			var options = { 'el' : createMenuButton() };
			vidMenu = new videojs.Menu(this, options);
			this.controlBar.el().appendChild(vidMenu.el());
		});

		var vid = videojs("player-video", {
			plugins : { vidMenu : {} }
		});
	</script>



</body>
</html>



















<!--

<div id="menu-container" class="context-menu carousel slide">
	<div class="carousel-inner">

		<div class="item active">
			<ul id="menu-collection">
				<li><a href="#" id="play">Play</a></li>
				<li class="slide-submenu">
					<a href="#" id="settings" data-target="menu-container" data-slide-to="2">
						Add to...
					</a>
				</li>
				<li><a href="#" id="publish">Make public</a></li>
				<li class="slide-submenu">
					<a href="#" data-target="menu-container" data-slide-to="1">Remove...</a>
				</li>
			</ul>
		</div>

		<div class="item">
			<header>
				<a class="back" data-target="menu-container" data-slide-to="0"> <i class="fa fa-arrow-circle-o-left"></i> Back</a>
			</header>

			<div>
				<p>Put settings here</p>
				<p>
					<a href="#" id="delete-item" class="btn btn-danger"> <i class="fa fa-trash-o"></i> Remove<span class="delete-check"></span></a>
				</p>
			</div>
		</div>
	</div>
</div> -->