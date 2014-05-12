<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Weber State University - Media Player</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<!-- <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> -->
	<link href="http://vjs.zencdn.net/4.1.0/video-js.css" rel="stylesheet">

	<link href="/assets/css/player.css" rel="stylesheet">

	<style>
		


	</style>

</head>
<body class="push-menu-open">
	<!-- Player -->
	<div id="mediaplayer-wrapper">
		<div id="player-video-wrapper">
			<video id="player-video"
			controls
			src=""
			poster=""
			class="video-js vjs-default-skin"
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
									<a data-toggle="collapse" data-parent="#accordion" href="#PLAYLIST_ID_{{$key}}">
										<span class="playlist-title">{{$playlist->name}}</span>
									</a>
								</h4>
							</div>
							<div id="PLAYLIST_ID_{{$key}}" class="panel-collapse collapse in">
								<div class="panel-body">
									<ul class="">
										@foreach ($playlist->assets as $key =>$asset)
										<li class="row">
											<div class="col-md-10"><a href="" data-asset-id="{{$asset->id}}">{{$asset->title}}</a></div>
											<div class="toolbar col-md-2">
												<a href=""> <i class="fa fa-cloud-download"></i> </a>
											</div>
										</li>
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
									<a data-toggle="collapse" data-parent="#accordion" href="#ASSET_ID_{{$key}}">
										Assets
									</a>
								</h4>
							</div>
							<div id="ASSET_ID_{{$key}}" class="panel-collapse collapse">
								<div class="panel-body">
									<ul class="">

										@foreach ($collection->assets as $asset)
										<li class="row">
											<div class="col-md-8"><a href="" data-asset-id="{{$asset->id}}">{{$asset->title}}</a></div>
											<div class="toolbar col-md-4">
												<a href=""> <i class="fa fa-cloud-download"></i> </a>
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
							<a class="back" data-target="#menu-container" data-slide-to="0"> <i class="fa fa-arrow-circle-o-left"></i> Back</a>
						</div>
					</header>

					<div class="menuSection">Video Settings</div>
					<div id="settings-panel">
						<p>Put settings here</p>


						<?php // var_dump($collection->toArray()) ?>



					</div>
				</div>

			</div>
		</div>
	</nav>
	<!-- end caurosel -->

</div>
<!-- End Player -->

<script src="/bower/webshim/js-webshim/minified/polyfiller.js"></script>
<script src="/bower/jquery/dist/jquery.min.js"></script>
<script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="/assets/js/player.js"></script>

<script src="http://vjs.zencdn.net/4.1.0/video.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		player = new Player({
			type: "{{$type}}",
			data: {{$collection}}
		});


		$('#menu-container').carousel(0).carousel('pause');
	})


	
</script>



</body>
</html>
