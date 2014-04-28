<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="/assets/css/manage.css" rel="stylesheet">
<script src="/bower/jquery/dist/jquery.min.js"></script>
<script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
 -->

<?php // $key=1; ?>

<div id="context-menu-{{$key}}" class="context-menu carousel slide">
	<div class="carousel-inner">
		<div class="item active">
			<ul id="menu-collection">
				<li><a href="#" id="share">Share...</a></li>
				<li><a href="#" id="play">Play</a></li>
				<li class="slide-submenu">
					<a href="#" id="rename" data-target="#context-menu-{{$key}}" data-slide-to="2"> Rename </a>
				</li>
				<li class="slide-submenu">
					<a href="#" id="add-to" data-target="#context-menu-{{$key}}" data-slide-to="1">
						Add to...
					</a>
				</li>
				<li><a href="#" id="publish">Make public</a></li>
				<li><a href="#" id="copy-url">Copy URL<span></span></a></li>
				<li><a href="#" id="delete-collection">Delete<span class="delete-check"></span></a></li>
			</ul>
		</div>

		<div class="item">
			<header>
				<a class="back" data-target="#context-menu-{{$key}}" data-slide-to="0"> <i class="fa fa-arrow-circle-o-left"></i> Back</a>
			</header>

			<div>Add to...</div>

		</div>

		<div class="item">
			<header>
				<a class="back" data-target="#context-menu-{{$key}}" data-slide-to="0"> <i class="fa fa-arrow-circle-o-left"></i> Back</a>
			</header>

			<div>Rename</div>
		</div>

	</div>
</div>
