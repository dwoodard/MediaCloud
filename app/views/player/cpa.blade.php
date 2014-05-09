<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Weber State University - Media Player</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
	<!-- <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> -->
	<link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link href="/assets/css/player.css" rel="stylesheet">

	<style>
		 .vjs-control.vjs-vidMenu-button:before {
            font-family: helvetica;
            content: "MENU";
        }
	</style>

</head>
<body class="push-menu-open">
	<!-- Player -->
	<div id="mediaplayer-wrapper">
		<div id="player-video-wrapper">
			<video id="player-video" controls src="http://localhost:8080/asset/10"
			width="75%"

			class="video-js vjs-default-skin"
			data-setup='{ "controls": true, "autoplay": false, "preload": "auto" }'
			>
			Your browser does not support the video tag.
		</video>
	</div>
	<nav id="player-menu-nav" class="">
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
	player = new Player({
		dataURL: "/{{$type}}/{{$collection->id}}/cpa",
		type: "{{$type}}"
	});

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