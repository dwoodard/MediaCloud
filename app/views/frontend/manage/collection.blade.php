@extends('frontend/layouts/manage')


@section('content')
@include('_partials.subnav-manage')
<div id="app" ng-app="mcApp">

	<div id="main" class="">
		<div class="app-folders-container" style="margin-top: 0px;">

			@foreach($cpa_rows as $key => $cpa_row)

			<div class="jaf-row jaf-container">
				@foreach ($cpa_row as $key => $cpa)
				<div class="folder" id="{{camel_case($cpa->name)}}" style="opacity: 1;">
					<a href="#">
						<img src="/assets/img/collection-icon-close.png" alt="">
						<p class="album-name">{{$cpa->name}}</p>
						<!-- <p class="artist-name">Radiohead</p> -->
					</a>
				</div>
				@endforeach
				<br class="clear">
			</div>


			@foreach ($cpa_row as $key => $cpa)
			<div class="folderContent {{camel_case($cpa->name)}}" style="display: none; background-color: rgb(224, 232, 233);">
				<div class="jaf-container">

					<a id="left-menu" href="#left-menu">Left Menu</a> 
					<a id="right-menu" href="#right-menu">Right Menu</a>


					<div id="navigation">
						<nav class="nav">
							<ul>
								<li><a href="#download">Download</a></li>
								<li><a href="#getstarted">Get started</a></li>
								<li><a href="#usage">Demos &amp; Usage</a></li>
								<li><a href="#documentation">Documentation</a></li>
								<li><a href="#themes">Themes</a></li>
								<li><a href="#support">Support</a></li>
							</ul>
						</nav>
					</div>

					<h2><a href="#" target="_blank" class="primaryColor">{{$cpa->name}}</a></h2>
					<div id="playlists">
						<ul>
							@foreach ($cpa->playlists as $playlist)
							<li><a href="#">{{$playlist->name}}</a></li>
							@endforeach
						</ul>
					</div>
					<br class="clear">
				</div>

			</div> <!-- folderContent -->
			@endforeach

			@endforeach

		</div> <!-- .app-folders-container -->
	</div> <!-- /main -->
</div> <!-- /app -->
@stop

@section('scripts')
<script src="http://app-folders.com/barebones/js/jquery.app-folders.js"></script>
<script src="/bower/flippant.js/index.js"></script>

<script src="/assets/js/manage.js"></script>
<script src="/bower/sidr/jquery.sidr.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		Manage.init()
	});
</script>

<script>
	$(document).ready(function() {
		$('#left-menu').sidr({
			name: 'sidr-left',
			side: 'left' // By default
		});
		$('#right-menu').sidr({
			name: 'sidr-right',
			side: 'right'
		});
	});
</script>


@stop

@section('style')
<link href="/assets/css/jquery.app-folder.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/flippant.css" rel="stylesheet" type="text/css"/>
<link href="/bower/sidr/stylesheets/jquery.sidr.dark.css" rel="stylesheet" type="text/css"/>

@stop
