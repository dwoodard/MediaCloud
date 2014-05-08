<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Weber State University - Media Player</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
</head>
<body>


	<div id="mediaplayer-wrapper">
		<div id="player-video-wrapper">
			<video id="player-video">Your browser does not support the video tag.</video>
		</div>
		<div id="player-menu"></div>
	</div>




	<script src="/bower/webshim/js-webshim/minified/polyfiller.js"></script>
	<script src="/bower/jquery/dist/jquery.min.js"></script>
	<script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/assets/js/player.js"></script>

	<script type="text/javascript">
		player = new Player({
			dataURL: "/playlists/{{$playlist->id}}/cpa",
			type: "playlists"
 		});
	</script>

</body>
</html>

<!--
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Weber State University - Media Player</title>

	<link href="/assets/js/video-js/video-js.min.css" rel="stylesheet">
	<link href="/assets/css/player.css" rel="stylesheet">

	<script src="/assets/js/video-js/video.js"></script>

<script src="/bower/webshim/js-webshim/minified/polyfiller.js"></script>



</head>
<body>




	<div  id="player-menu">
		<div id="toggle-menu">
			<a id="menu-btn">Menu ►</a>
		</div>

		<ul id="menu-collections">
			<li class="menu-playlist">
				<ul>
					<li><a href="#">playlist1</a></li>
					<li><a href="#">playlist2</a></li>
					<li><a href="#">playlist3</a></li>
				</ul>
			</li>
			<li class="menu-playlist">
				<ul>
					<li><a href="#">video1</a></li>
					<li><a href="#">video2</a></li>
					<li><a href="#">video3</a></li>
				</ul>
			</li>

			<li class="menu-assets">
				<ul>
					<li><a href="#">asset1</a></li>
					<li><a href="#">asset2</a></li>
					<li><a href="#">asset3</a></li>
				</ul>
			</li>
		</ul>

	</div>









	<video id="video-player"class="video-js vjs-default-skin"
	controls preload="auto" width="100%" height="100%" poster="" data-setup="{}">

	<source src="http://media.w3.org/2010/05/sintel/trailer.mp4" type='video/mp4'>
		Your browser does not support the video tag.


	</video>


	<script src="/bower/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>


	<script type="text/javascript" src="/assets/js/player.js"></script>
	<script type="text/javascript">
		player = new Player($("#video-player"), $("#player-menu"))

	</script>
	<script src="/bower/underscore/underscore.js"></script>
</body>
</html>
 -->