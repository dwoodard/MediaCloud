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


	<div id="mediaplayer-wrapper" data-type="collections-{{$collection->id}}">
		<div id="video-player-wrapper">
			<video id="video-player">Your browser does not support the video tag.</video>
		</div>
		<div id="meida-menu"></div>
	</div>



	<script src="/bower/webshim/js-webshim/minified/polyfiller.js"></script>
	<script src="/bower/jquery/dist/jquery.min.js"></script>
	<script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/assets/js/player.js"></script>

	<script type="text/javascript">
		player = new Player($("#video-player"));
	</script>

</body>
</html>