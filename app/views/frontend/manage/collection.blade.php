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




					<div class="playlists">
						<div class="pull-right">
							<button type="button" class="btn-collection-settings btn btn-primary"><i class="fa fa-cog"></i> Collection Settings</button>
						</div>
						<h2> {{$cpa->name}} </h2>
						<ul>
							@foreach ($cpa->playlists as $playlist)
							<li><a href="#">{{$playlist->name}}</a></li>
							@endforeach
						</ul>
					</div>


					<div class="collection-settings" style="display: none">
						<div class="pull-right">
							<button type="button" class="btn-collection-settings-close btn btn-primary"><i class="fa fa-cog"></i> Close </button>
						</div>
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
<script src="bower/flippy/jquery.flippy.min.js"></script>

<script src="/assets/js/manage.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		Manage.init()
	});

	$(document).ready(function(){
		$(".btn-collection-settings,.btn-collection-settings-close").on("click",function (e) {
			var element = $(e.currentTarget).closest('.folderContent')[0];


			var classList =$(this).attr('class').split(/\s+/);
			$.each( classList, function(index, item){
				if (item === 'settings-active') {
					console.log(item)

				}
			});


			if($(element).has('settings-active')){
				$(element).find('.playlists').slideUp();
				$(element)
				.find('.collection-settings')
				.removeClass('hide')
				.slideToggle()
				.animate({ 'min-height': "400px" }, 'fast');
			}
			else{
				$(element).removeClass('settings-active')

				$(element).find('.playlists').slideDown();
				$(element).find('.collection-settings')
				.animate({ 'min-height': "0px" }, 'fast');

			}


		})
	});



	// $(function(){



	// 	$(".btn-collection-settings").on("click",function(e){
	// 		e.preventDefault();
	// 		$active = $(e.currentTarget).is('.active')
	// 		$flipbox = $(e.currentTarget).closest('.folderContent').find('.flipbox')
	// 		console.log($flipbox);
	// 		if(!$active){
	// 			Manage.collections.push($flipbox)
	// 			$flipbox.flippy({
	// 				// color_target: "blue",
	// 				direction: "top",
	// 				depth: 1,
	// 				// duration: "250",
	// 				verso: $(".collection-settings").clone(true).html(),
	// 			});
	// 		}
	// 		else{

	// 			$flipbox.flippy({
	// 				// color_target: "blue",
	// 				direction: "top",
	// 				depth: 1,
	// 				// duration: "250",
	// 				verso: $($flipbox).original.html()
	// 			});
	// 		}

	// 	});

	// 	$(".btn-temp2").on("click",function(e){
	// 		$(".flipbox").flippy({
	// 			color_target: "red",
	// 			depth: 1,
	// 			direction: "left",
	// 				// duration: "250",
	// 				verso: $("#temp2").clone(true).html(),
	// 			});
	// 		e.preventDefault();
	// 	});

	// 	$(".btn-temp3").on("click",function(e){
	// 		$(".flipbox").flippy({
	// 			color_target: "#b6d635",
	// 			depth: 1,
	// 			direction: "top",
	// 				// duration: "250",
	// 				verso: $("#temp3").clone(true).html(),
	// 			});
	// 		e.preventDefault();
	// 	});
	// });



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
<link href="/assets/css/flippant.css" rel="stylesheet" type="text/css"/>

<style>


</style>

@stop
