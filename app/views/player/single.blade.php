<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weber State University - Media Player</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href="/js/vendor/video-js/video-js.css" rel="stylesheet">
    <script src="/js/vendor/video-js/video.js"></script>
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
       preload="auto" width="99%" height="99%" poster="{{$asset->thumb}}"
       data-setup="{}">
    <source src="{{$asset->transcoded_url}}" type='video/mp4'>
    Your browser does not support the video tag.
</video>
</body>
</html>