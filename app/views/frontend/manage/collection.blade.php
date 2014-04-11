@extends('frontend/layouts/manage')


@section('content')
@include('_partials.subnav-manage')

<div id="app" ng-app="manage">
	<div ng-controller="manageController">
		<!-- Slide Push Menus -->
		<nav id="collections-list" class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left cbp-spmenu-open">
			<i class="close fa fa-times-circle-o fa-2x"></i>
			<h3>Collections</h3>


			<ul class="toolbar clearfix">
				<li> <a id="btn-new-collection" href="#"><i class="fa fa-plus"></i> New Collection</a></li>
			</ul>

				<div class="newCollection" href="#" style="display:none">
					<input id="input-new-collection" type="text" value="Collection Name" class="input-sm">
					<button id="btn-save-new-collection"><i class="fa fa-check"></i> </button>
					<button id="btn-save-new-collection"><i class="fa fa-times"></i> </button>
				</div>





			<a href="#"
				ng-repeat="collection in collections"
				ng-cloak
				ng-click="getCollectionView(collection)"
				>[[collection.name]]</a>




			<!-- <a ng-repeat="collection in collections" href=""> [[collection.name]] </a> -->


			<!-- <a ng-repeat="collection in collections" href=""> [[collection.name]] </a> -->


		</nav>
	</div>

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
<script src="/bower/app-folders/index.js"></script>
<script src="/bower/angular/angular.js"></script>
<script src="/bower/angular-resource/angular-resource.min.js"></script>
<script src="/assets/js/manage.js"></script>
<script src="/bower/angular-xeditable/dist/js/xeditable.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.6.0/ui-bootstrap-tpls.min.js"></script>
<script src="/app/app.js"></script>


<script type="text/javascript">
	$(document).ready(function(){
		var data = {{json_encode($cpas)}};
		var userId = {{json_encode(Sentry::getUser()->id)}};
		Manage.init(data);
	});
</script>
@stop

@section('style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.7.1/css/dropzone.css" rel="stylesheet" type="text/css"/>
<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.7.1/css/basic.css" rel="stylesheet" type="text/css"/>
<link href="/bower/angular-xeditable/dist/css/xeditable.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/manage.css" rel="stylesheet" type="text/css"/>

@stop
