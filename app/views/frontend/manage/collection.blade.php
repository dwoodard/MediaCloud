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
						<div class="art-wrap" >
							<img src="/assets/img/collection-icon-open.png" alt="">
						</div>
						<h2><a href="#" target="_blank" class="primaryColor">{{$cpa->name}}</a></h2>
						<h3 class="secondaryColor">Radiohead (1997)</h3>
						<div id="playlists">
							<ul>
								@foreach ($cpa->playlists as $playlist)
								<li><a href="#">{{$playlist->name}}</a></li>
								@endforeach
							</ul>
						</div>
						<br class="clear">
					</div>
					<a href="#" class="close">×</a>
				</div>
				@endforeach

			@endforeach

		</div>
	</div>
</div>
@stop

@section('scripts')
<script src="http://app-folders.com/barebones/js/jquery.app-folders.js"></script>

<script type="text/javascript">
	$(document).ready(function () {

		$('.app-folders-container').appFolders({
			opacity: .5, 								// Opacity of non-selected items
			marginTopAdjust: true, 						// Adjust the margin-top for the folder area based on row selected?
			marginTopBase: 0, 							// If margin-top-adjust is "true", the natural margin-top for the area
			marginTopIncrement: 0,						// If margin-top-adjust is "true", the absolute value of the increment of margin-top per row
			animationSpeed: 200,						// Time (in ms) for transitions
			// URLrewrite: true, 							// Use URL rewriting?
			// URLbase: "/barebones/",						// If URL rewrite is enabled, the URL base of the page where used. Example (include double-quotes): "/services/"
			internalLinkSelector: ".jaf-internal a",	// a jQuery selector containing links to content within a jQuery App Folder
			instaSwitch: true
		});

		$("#search_bar a").on( "click", function(e) {
			setTimeout(function(){
				$("#srch-term")[0].focus();
			}, 0);
		});
	});
</script>

@stop

@section('style')
<link href="/assets/css/jquery.app-folder.css" rel="stylesheet" type="text/css"/>

@stop
