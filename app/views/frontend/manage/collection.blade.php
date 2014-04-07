@extends('frontend/layouts/manage')


@section('content')
@include('_partials.subnav-manage')

<div id="app" >

	<!-- Slide Push Menus -->
	<nav id="collections-list" class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left cbp-spmenu-open">
		<i class="close fa fa-times-circle-o fa-2x"></i>
		<h3>Collections</h3>

		<ul class="toolbar clearfix">
			<li> <a id="btn-new-collection" href="#"><i class="fa fa-plus"></i> New Collection</a></li>
		</ul>

		<div class="newCollection" href="#" style="display:none">
			<input type="text" value="Collection Name" class="input-sm">
			<button id="btn-save-new-collection"><i class="fa fa-check"></i> </button>
			<button id="btn-save-new-collection"><i class="fa fa-times"></i> </button>
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
	<!-- / Slide Push Menus -->

	<div id="collection-view"> </div>

</div> <!-- /app -->
@stop

@section('scripts')
<script src="http://app-folders.com/barebones/js/jquery.app-folders.js"></script>
<script src="/assets/js/manage.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		var data = {{json_encode($cpas)}};

		Manage.init(data);
	});
</script>
@stop

@section('style')
<link href="/assets/css/manage.css" rel="stylesheet" type="text/css"/>
@stop
