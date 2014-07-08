<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Weber State University - Media Player</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href="/assets/js/video-js/video-js.min.css" rel="stylesheet">
	<script src="/assets/js/video-js/video.js"></script>
	<style type="text/css">
		html, body {
			margin: 0;
			padding: 0;
			width: 100%;
			height: 100%;
		}

		.vjs-default-skin {
			color: #dedede
		}

		.vjs-play-progress, .vjs-volume-level {
			background-color: #501794 !important;
		}

		.vjs-control-bar, .vjs-big-play-button {
			background: rgba(97, 97, 97, 0.7)
		}

		.vjs-slider {
			background: rgba(97, 97, 97, 0.2333333333333333)
		}

		.vjs-control-bar {
			font-size: 100%
		}
	</style>

</head>
<body>
	<video id="video-player" class="video-js vjs-default-skin" controls
	preload="auto" width="100%" height="100%"

	@if(isset($asset->thumb))
	poster="{{$asset->thumb}}"
	@endif

	data-setup="{}">
	<source src="/asset/{{$asset->id}}" type='video/mp4'>
		Your browser does not support the video tag.
	</video>



	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-44578411-1', 'weber.edu');
		ga('send', 'pageview');

	</script>
</body>
</html>