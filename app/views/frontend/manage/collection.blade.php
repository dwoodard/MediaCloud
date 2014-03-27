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

					<div class="flip_container ">
						<div class="flip_card">
							<div class="face front" style="">
								<button class="btn btn-toggleSettings pull-right"> <i class="fa fa-cog"></i></button>
								<div class="playlists">
									<h2><a href="#" target="_blank" class="primaryColor">{{$cpa->name}}</a></h2>
									<ul>
										@foreach ($cpa->playlists as $playlist)
										<li><a href="#">{{$playlist->name}}</a></li>
										@endforeach
									</ul>
								</div>

							</div>
							<div class="face back">
								<button class="btn btn-toggleSettings"> <i class="fa fa-cog"></i></button>

								<div class="container">
									<ul class="nav nav-tabs" id="myTab">
										<li class="active"><a href="#home">Home</a></li>
										<li><a href="#profile">Profile</a></li>
										<li><a href="#messages">Messages</a></li>
										<li><a href="#settings">Settings</a></li>
									</ul>
									
									<div class="tab-content">
										<div class="tab-pane active" id="home">Home content...</div>
										<div class="tab-pane" id="profile">Content here...</div>
										<div class="tab-pane" id="messages">Messages...</div>
										<div class="tab-pane" id="settings">Settings...</div>
									</div>
								</div>
							</div>
						</div>
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

<script src="/assets/js/manage.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		Manage.init()
	});
</script>




@stop

@section('style')
<link href="/assets/css/manage.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/jquery.app-folder.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/flippant.css" rel="stylesheet" type="text/css"/>

<style>


</style>

@stop
