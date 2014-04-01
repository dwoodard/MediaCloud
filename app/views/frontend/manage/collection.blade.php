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
					<button class="btn-collection-settings"><i class="fa fa-ellipsis-h"></i></button>

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
					$(elm).show();
				}
				else{
					$(elm).hide();
				}
			});


			$(element).find("."+elmName+"-settings").slideToggle();

		})
	});






</script>

<script type="text/javascript">
	$( document ).ready(function( $ ) {


		$('.btn-collection-settings').click(function (e) {
			console.log('click')
		})


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
