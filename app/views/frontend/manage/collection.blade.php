@extends('frontend/layouts/manage')


@section('content')
@include('_partials.subnav-manage')


<div id="app" >

	<div id="main">

		<!--  -->
		<nav id="collections-list" class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left cbp-spmenu-open">
			<i class="close fa fa-times-circle-o fa-2x"></i>
			<h3>Collections</h3>

			<ul class="toolbar clearfix">
				<li> <a href="#"><i class="fa fa-plus"></i> New Collection</a></li>
			</ul>

			<div class="newCollection" href="#">
				<input type="text" value="Collection Name" class="input-sm">
				<button><i class="fa fa-check"></i> </button>
			</div>
			@foreach($cpas as $key => $cpa)

			<a data-collection-id="{{$cpa->id}}" href="#">{{$cpa->name}}</a>

			@endforeach



		</nav>
		<nav id="asset-view" class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">
			<i class="close fa fa-times-circle-o fa-2x"></i>
			<div id="asset-player"></div>

		</nav>

		<nav id="browse-view" class="cbp-spmenu cbp-spmenu-horizontal cbp-spmenu-bottom">
			<i class="close fa fa-times-circle-o fa-2x"></i>
			<h3>Browse</h3>
			<a href="#">Asset</a>
			<a href="#">Asset</a>
			<a href="#">Asset</a>
			<a href="#">Asset</a>
		</nav>
		<!--  -->


		<div id="collection-view">

		</div>

	</div> <!-- /main -->
</div> <!-- /app -->
@stop

@section('scripts')
<script src="http://app-folders.com/barebones/js/jquery.app-folders.js"></script>
<script src="/bower/classie/classie.js"></script>

<script src="/assets/js/manage.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		var data = {{json_encode($cpas)}}
		Manage.init(data);
	});

</script>

<script type="text/javascript">
	// $("#collections-list h3")
	// .hammer()
	// .on("hold", function(e) {
	// 	console.log($(e.currentTarget));
	// });

	var menuLeft = document.getElementById( 'collections-list' ),
	showLeft = document.getElementById( 'subnav-btn-collections' ),
	showRight = document.getElementById( 'subnav-btn-assets' ),
	menuRight = document.getElementById( 'asset-view' ),
	menuBottom = document.getElementById( 'browse-view' ),
	showBottom = document.getElementById( 'subnav-btn-browse' ),
	body = document.body;

	showBottom.onclick = function() {
		// classie.toggle( this, 'active' );
		classie.toggle( menuBottom, 'cbp-spmenu-open' );
	};
	showLeft.onclick = function() {
		// classie.toggle( this, 'active' );
		classie.toggle( body, 'cbp-spmenu-push-toright' );
		classie.toggle( menuLeft, 'cbp-spmenu-open' );
	};
	showRight.onclick = function() {
		// classie.toggle( this, 'active' );
	// classie.toggle( body, 'cbp-spmenu-push-toleft' );
	classie.toggle( menuRight, 'cbp-spmenu-open' );
};

// classie.toggle( this, 'active' );
// classie.toggle( body, 'cbp-spmenu-push-toright' );
// classie.toggle( menuLeft, 'cbp-spmenu-open' );


</script>




@stop

@section('style')
<link href="/assets/css/manage.css" rel="stylesheet" type="text/css"/>


<style>


</style>

@stop
