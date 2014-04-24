<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="/assets/css/manage.css" rel="stylesheet">
<script src="/bower/jquery/dist/jquery.min.js"></script>
<script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
 -->


<div id="context-menu" class="carousel slide bs-docs-carousel-example">
	<div class="carousel-inner">
		<div class="item active">
			<ul id="menu-collection">
				<li><a href="#" id="share">Share...</a></li>
				<li><a href="#" id="play">Play</a></li>
				<li class="slide-submenu">
					<a href="#" id="rename" data-target="#context-menu" data-slide-to="2"> Rename </a>
				</li>
				<li class="slide-submenu">
					<a data-target="#context-menu" data-slide-to="1">
						<span id="collection-label">Add to...</span>
						<span id="collection-check"></span>
					</a>
				</li>
				<li><a href="#" id="publish">Make public</a></li>
				<li><a href="#" id="copy-url">Copy URL<span></span></a></li>
				<li><a href="#" id="delete-collection">Delete<span class="delete-check"></span></a></li>
			</ul>
		</div>

		<div class="item">
			<div class="playlist">
				<a data-target="#context-menu" data-slide-to="0">Back</a>
				<div>Add to...</div>
			</div>
		</div>

		<div class="item">
			<a data-target="#context-menu" data-slide-to="0">Back</a>
			<div>Rename</div>
		</div>

	</div>
</div>

<!--
<script>

$('.carousel').carousel({
  interval: 2000
})

$('#myCarousel').on('slide.bs.carousel', function () {
  console.log('slide.bs.carousel')
})
$('#myCarousel').on('slid.bs.carousel', function () {
  console.log('slid.bs.carousel')
})


</script>
 -->