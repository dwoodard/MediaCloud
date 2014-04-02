@extends('frontend/layouts/manage')


@section('content')
@include('_partials.subnav-manage')


<div id="app" >

	<div id="main">

		<!--  -->
		<nav id="collections-container" class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left cbp-spmenu-open">
			<h3>Collections</h3>
			<a href="#"><i class="fa fa-plus"> </i> New Collection</a>
			@foreach($cpas as $key => $cpa)

			<a href="#">{{$cpa->name}}</a>

			@endforeach



		</nav>
		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
			<h3>Menu</h3>
			<a href="#">Celery seakale</a>
			<a href="#">Dulse daikon</a>
			<a href="#">Zucchini garlic</a>
			<a href="#">Catsear azuki bean</a>
			<a href="#">Dandelion bunya</a>
			<a href="#">Rutabaga</a>
		</nav>
		<nav class="cbp-spmenu cbp-spmenu-horizontal cbp-spmenu-top" id="cbp-spmenu-s3">
			<h3>Menu</h3>
			<a href="#">Celery seakale</a>
			<a href="#">Dulse daikon</a>
			<a href="#">Zucchini garlic</a>
			<a href="#">Catsear azuki bean</a>
			<a href="#">Dandelion bunya</a>
			<a href="#">Rutabaga</a>
			<a href="#">Celery seakale</a>
			<a href="#">Dulse daikon</a>
			<a href="#">Zucchini garlic</a>
			<a href="#">Catsear azuki bean</a>
			<a href="#">Dandelion bunya</a>
			<a href="#">Rutabaga</a>
		</nav>
		<nav class="cbp-spmenu cbp-spmenu-horizontal cbp-spmenu-bottom" id="cbp-spmenu-s4">
			<h3>Menu</h3>
			<a href="#">Celery seakale</a>
			<a href="#">Dulse daikon</a>
			<a href="#">Zucchini garlic</a>
			<a href="#">Catsear azuki bean</a>
			<a href="#">Dandelion bunya</a>
			<a href="#">Rutabaga</a>
			<a href="#">Celery seakale</a>
			<a href="#">Dulse daikon</a>
			<a href="#">Zucchini garlic</a>
			<a href="#">Catsear azuki bean</a>
			<a href="#">Dandelion bunya</a>
			<a href="#">Rutabaga</a>
		</nav>
		<!--  -->


		<div class="app-folders-container" style="margin-top: 0px;">

			@foreach($cpa_rows as $key => $cpa_row)

			<div class="jaf-row jaf-container">
				@foreach ($cpa_row as $key => $cpa)
				<div class="folder" id="{{camel_case($cpa->name)}}" style="opacity: 1;">
					<a href="#">
						<img src="/assets/img/collection-icon-close.png" alt="">
						<p class="album-name">{{$cpa->name}} </p>
						<!-- <p class="artist-name">Radiohead</p> -->
					</a>
				</div>
				@endforeach
				<br class="clear">
			</div>


			@foreach ($cpa_row as $key => $cpa)
			<div class="folderContent {{camel_case($cpa->name)}}" style="display: none; background-color: rgb(224, 232, 233);">
				<div class="jaf-container">



					<div class="row">

						<div class="col-sm-3">
							<div class="row">
								<div class="col-sm-12">
									<h2> {{$cpa->name}} </h2>
								</div>
							</div>

							<div class="playlists">

								<ul>
									@foreach ($cpa->playlists as $playlist)
									<li><a href="#">{{$playlist->name}}</a></li>
									@endforeach
								</ul>

							</div>
						</div>
						<div class="col-sm-9">
							<div id="{{camel_case($playlist->name)}}" class="asset">
								<div class="pull-right">
								</div>

								@foreach ($cpa->playlists as $playlist)
								<div>
									<a href="#">{{$playlist->name}}</a>
								</div>
								@endforeach
							</div>
						</div>

					</div>


					<!-- <div class="assets">
						assets
					</div> -->




					<br class="clear">
				</div>

			</div> <!-- /.folderContent -->
			@endforeach

			@endforeach

		</div> <!-- .app-folders-container -->
	</div> <!-- /main -->
</div> <!-- /app -->
@stop

@section('scripts')
<script src="http://app-folders.com/barebones/js/jquery.app-folders.js"></script>
<script src="/bower/classie/classie.js"></script>

<script src="/assets/js/manage.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		Manage.init()


	});

</script>

<script type="text/javascript">
	$( document ).ready(function( $ ) {

		

		

	});



	var menuLeft = document.getElementById( 'collections-container' ),
	menuRight = document.getElementById( 'cbp-spmenu-s2' ),
	menuBottom = document.getElementById( 'cbp-spmenu-s4' ),
	showBottom = document.getElementById( 'subnav-btn-browse' ),
	showLeft = document.getElementById( 'subnav-btn-collections' ),
	showRight = document.getElementById( 'subnav-btn-assets' ),
	body = document.body;

	showBottom.onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( menuBottom, 'cbp-spmenu-open' );
		disableOther( 'showBottom' );
	};
	showLeft.onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( body, 'cbp-spmenu-push-toright' );
		classie.toggle( menuLeft, 'cbp-spmenu-open' );
	};
	showRight.onclick = function() {
		classie.toggle( this, 'active' );
	// classie.toggle( body, 'cbp-spmenu-push-toleft' );
	classie.toggle( menuRight, 'cbp-spmenu-open' );
};

classie.toggle( this, 'active' );
classie.toggle( body, 'cbp-spmenu-push-toright' );
classie.toggle( menuLeft, 'cbp-spmenu-open' );


</script>




@stop

@section('style')
<link href="/assets/css/manage.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/jquery.app-folder.css" rel="stylesheet" type="text/css"/>
<!-- <link rel="stylesheet" href="/bower/jquery-mobile-bower/css/jquery.mobile-1.4.2.min.css"> -->
<style>


</style>

@stop
