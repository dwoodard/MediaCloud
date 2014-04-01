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

					<div class="row settings-container">

						<div class="collection-settings col-sm-12"  >

							<span>{{$cpa->name}}</span>
							<h2> Collection Settings</h2>

							<div class="container">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a href="#home">Home</a></li>
									<li><a href="#profile">Profile</a></li>
									<li><a href="#messages">Messages</a></li>
									<li><a href="#settings">Settings</a></li>
								</ul>

								<div class="tab-content">
									<div class="tab-pane active" id="home">Home content...</div>
									<div class="tab-pane" id="profile">Content here...
										<br>asdf
										<br>
										<br>
										<br>asdf
										<br>
									</div>
									<div class="tab-pane" id="messages">Messages...</div>
									<div class="tab-pane" id="settings">Settings...</div>
								</div>
							</div>
						</div>

						<div class="playlist-settings col-sm-12"  >

							<span>{{$cpa->name}}</span>
							<h2> playlist Settings</h2>

							<div class="container">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a href="#home">Home</a></li>
									<li><a href="#profile">Profile</a></li>
									<li><a href="#messages">Messages</a></li>
									<li><a href="#settings">Settings</a></li>
								</ul>

								<div class="tab-content">
									<div class="tab-pane active" id="home">Home content...</div>
									<div class="tab-pane" id="profile">Content here...
										<br>asdf
										<br>
										<br>
										<br>asdf
										<br>
									</div>
									<div class="tab-pane" id="messages">Messages...</div>
									<div class="tab-pane" id="settings">Settings...</div>
								</div>
							</div>
						</div>

						<div class="asset-settings col-sm-12"  >

							<span>{{$cpa->name}}</span>
							<h2> Asset Settings</h2>

							<div class="container">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a href="#home">Home</a></li>
									<li><a href="#profile">Profile</a></li>
									<li><a href="#messages">Messages</a></li>
									<li><a href="#settings">Settings</a></li>
								</ul>

								<div class="tab-content">
									<div class="tab-pane active" id="home">Home content...</div>
									<div class="tab-pane" id="profile">Content here...
										<br>asdf
										<br>
										<br>
										<br>asdf
										<br>
									</div>
									<div class="tab-pane" id="messages">Messages...</div>
									<div class="tab-pane" id="settings">Settings...</div>
								</div>
							</div>
						</div>


					</div>
					<div class="row">

						<div id="col1" class="col-sm-12">
							<div class="playlists">
								<div class="pull-right">
									<button type="button" data-toggle="toggle" class="btn-asset-settings btn btn-primary"><i class="fa fa-ellipsis-h"></i></button>
									<button type="button" data-toggle="toggle" class="btn-playlist-settings btn btn-primary"><i class="fa fa-list"></i></button>
									<button type="button" data-toggle="toggle" class="btn-collection-settings btn btn-primary"><i class="fa fa-cog"></i></button>
								</div>
								<h2> {{$cpa->name}} </h2>
								<ul>
									@foreach ($cpa->playlists as $playlist)
									<li><a href="#">{{$playlist->name}}</a></li>
									@endforeach
								</ul>
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
<!-- <script src="/bower/jquery-mobile-bower/js/jquery.mobile-1.4.2.min.js"></script> -->

<script src="/assets/js/manage.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		Manage.init()
	});

	$(document).ready(function(){
		$(".btn-collection-settings, .btn-playlist-settings, .btn-asset-settings").click(function  (e) {
			var currentBtn =  /(btn-(.*)-settings)/.exec(e.currentTarget.className)[1]
			var elmName =  /(btn-(.*)-settings)/.exec(e.currentTarget.className)[2]
			var element = $(e.currentTarget).closest('.folderContent')[0];
			var settingsContainer = $(element).find('.settings-container')[0];

			$(settingsContainer).children().each(function(key, elm){

				console.log($(elm).is(":visible"))
				if($(elm).is(":visible")){
					$(elm).show()
				}
				else{
					$(elm).hide()
				}
				
				// switch(currentBtn){
				// 	case "btn-collection-settings":
				// 	break;
				// 	case "btn-playlist-settings":
				// 	break;
				// 	case "btn-asset-settings":
				// 	break;
				// }

				
			});
			// console.log("."+elmName+"-settings", $("."+elmName+"-settings"));
			$(element).find("."+elmName+"-settings").slideToggle();
			// elmName-settings.show()

			




		})
	});






</script>

<script type="text/javascript">
	$( document ).ready(function( $ ) {





		$('.dropdown.keep-open').on({
			"shown.bs.dropdown": function() { $(this).data('closable', false); },
			"click":             function() { $(this).data('closable', true);  },
			"hide.bs.dropdown":  function() { return $(this).data('closable'); }
		});







		$(".btn-getUserInfo").click(function(e){
			e.preventDefault();
			showDropzone();
		})

		function doComplete(){
			console.log('all complete')
		}

		var myDropzone;
		Dropzone.options.filedrop = {
			maxFilesize: 2048,
			addRemoveLinks: true,
			init: function () {

				myDropzone = this;

				var totalFiles = 0,
				completeFiles = 0;

				this.on("sending", function (file, xhr, formData) {
					formData.append("userId", $("#userId").val());
					console.log('sending', xhr)
				});
				this.on("addedfile", function (file, xhr, formData) {
					totalFiles += 1;
				});

				this.on("error", function (file) {
					if(file.status == "error"){
						console.log("do something");
					}
				});

				this.on("removed file", function (file, xhr, formData) {
					totalFiles -= 1;
				});
				this.on("complete", function (file) {
					completeFiles += 1;
					if (completeFiles === totalFiles) {
						doComplete();
					}
				});
			}
		};
	});

</script>




@stop

@section('style')
<link href="/assets/css/manage.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/jquery.app-folder.css" rel="stylesheet" type="text/css"/>
<!-- <link rel="stylesheet" href="/bower/jquery-mobile-bower/css/jquery.mobile-1.4.2.min.css"> -->
<style>


</style>

@stop
