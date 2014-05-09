<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Weber State University - Media Player</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link href="/assets/css/player.css" rel="stylesheet">
</head>
<body>

	<nav id="player-menu-nav" class="push-menu-open">
		<div id="player-menu">
			<header id="menuTitle">menuTitle</header>
			<ul id="playlists">
				playlists
			</ul>
			<ul id="assets">
				assets
			</ul>
		</div>
	</nav>


	{{--@include('_partials/player-cpa'); --}}
	<div id="mediaplayer-wrapper">
		<div id="player-video-wrapper">
			<video id="player-video">Your browser does not support the video tag.</video>
		</div>
	</div>

	<script src="/bower/webshim/js-webshim/minified/polyfiller.js"></script>
	<script src="/bower/jquery/dist/jquery.min.js"></script>
	<script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/assets/js/player.js"></script>

	<script type="text/javascript">
		player = new Player({
			dataURL: "/collections/{{$collection->id}}/cpa",
			type: "collections"
		});

	</script>

</body>
</html>