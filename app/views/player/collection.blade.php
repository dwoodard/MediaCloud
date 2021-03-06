<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Weber State University - Media Player</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link href="/bower/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet">
	<!-- <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> -->
	<link href="//vjs.zencdn.net/4.7.2/video-js.css" rel="stylesheet">

	<link href="/assets/css/player.css" rel="stylesheet">
	<style>
		.vjs-fade-in, .vjs-fade-out {
			visibility: visible !important;
			opacity: 1 !important;
			-webkit-transition-duration: 0s !important;
			transition-duration: 0s !important;
		}
	</style>

</head>
<body class="push-menu-open">
<!-- Player -->
<div id="mediaplayer-wrapper">
	<div id="player-video-wrapper">
		<video id="player-video" preload="metadata"
		       class="video-js vjs-default-skin" type='video/mp4'
		       data-setup='{ "controls": true, "autoplay": false, "preload": "auto" }'>
			Your browser does not support the video tag.
		</video>
	</div>

	<!-- caurosel slide menu -->
	<nav id="player-menu-nav">
		<div id="menu-container" class="context-menu carousel slide">
			<div class="carousel-inner">
				<!-- Main Menu -->
				<div id="player-menu" class="item active">
					<header class="row">
						<div class="title col-md-8">{{$collection->name}}</div>
						<div class="toolbar col-md-4">
							<a href="#" id="btn-settings" data-target="#menu-container" data-slide-to="1">
								Settings <i class="fa fa-cogs"></i>
							</a>
						</div>
					</header>


					<div class="panel-group" id="accordion">
						@if (count($collection->playlists) )
							<div class="menuSection">Playlists</div>
							@foreach ($collection->playlists as $key =>$playlist)
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion"
											   href="#PLAYLIST_ID_{{$key}}">
												<span class="playlist-title">{{$playlist->name}}</span>
											</a>
										</h4>
									</div>
									<div id="PLAYLIST_ID_{{$key}}" data-type="playlists"
									     class="panel-collapse collapse @if($key == 0)in@endif ">

										<div class="panel-body">
											<ul class="">
												@foreach ($playlist->assets as $key =>$asset)
													<?php $permissions = json_decode($asset->permissions); ?>
													@if($permissions->public)
														<li class="row">
															<div class="col-md-10">
																<a class="video_play"
																   data-asset-id="{{$asset->id}}">{{$asset->title}}</a>
															</div>
															<div class="toolbar col-md-2">
																@if($permissions->can_download)
																	<a class="download_asset" href=""> <i
																				class="fa fa-cloud-download"></i> </a>
																@endif

															</div>
														</li>
													@endif
												@endforeach
											</ul>
										</div>
									</div>
								</div>
							@endforeach
						@endif

						@if (count($collection->assets) )
							<div class="menuSection">Assets</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#ASSET_ID">
											Assets
										</a>
									</h4>
								</div>
								<div id="ASSET_ID" data-type="assets" class="panel-collapse collapse">
									<div class="panel-body">
										<ul class="">

											@foreach ($collection->assets as $asset)
												<li class="row">
													<div class="col-md-8">
														<a class="video_play" href=""
														   data-asset-id="{{$asset->id}}">{{$asset->title}}</a>
													</div>
													<div class="toolbar col-md-4">
														<a class="download_asset" href=""> <i
																	class="fa fa-cloud-download"></i> </a>
													</div>
												</li>
											@endforeach

										</ul>
									</div>
								</div>
							</div>
						@endif

					</div>


				</div>
				<!-- Main Menu -->

				<div id="player-settings" class="item">
					<header id="menuTitle" class="row">
						<div class="title col-md-8">Settings</div>
						<div class="toolbar col-md-4">
							<a class="back" data-target="#menu-container" data-slide-to="0"> <i
										class="fa fa-arrow-circle-o-left"></i> Back</a>
						</div>
					</header>

					<div class="menuSection">Video Settings</div>
					<div id="settings-panel">

						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label class="col-md-4 control-label">Video Playrate </label>

								<div class="col-md-6">

									<div id="playrate-slider"></div>
									<span id="video_playrate_val"></span>
								</div>
								<div class="col-md-2">
									<a id="video_playrate_reset" href=""> <i class="fa fa-reply"></i> Reset</a>
								</div>
							</div>
						</form>


					</div>
				</div>

			</div>
		</div>
	</nav>
	<!-- end caurosel -->

</div>
<!-- End Player -->

<script src="/bower/modernizr/modernizr.js"></script>
<script src="/bower/webshim/js-webshim/minified/polyfiller.js"></script>
<script src="/bower/jquery/dist/jquery.min.js"></script>
<script src="/bower/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/bower/underscore/underscore.js"></script>
<script type="text/javascript" src="/assets/js/player.js"></script>

<script src="//vjs.zencdn.net/4.7.2/video.js"></script>

<script type="text/javascript">

	$(document).ready(function () {

		$(document).bind("contextmenu", function (e) {
			e.preventDefault();
		});

		videojs("player-video").ready(function () {

			Player.init(this, {
				type: "{{$type}}",
				data: {{$collection}}
			});

		});

		$('#menu-container').carousel(0).carousel('pause');

	})
</script>

<script>
	(function (i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] || function () {
			(i[r].q = i[r].q || []).push(arguments)
		}, i[r].l = 1 * new Date();
		a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
	})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

	ga('create', 'UA-44578411-1', 'weber.edu');
	ga('send', 'pageview');

</script>


</body>
</html>