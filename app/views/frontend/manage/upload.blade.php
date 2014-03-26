@extends('frontend/layouts/manage')


@section('content')
@include('_partials.subnav-manage')



<div class="row">
	<div class="col-md-12">
		<div id="uploads-area" class="">

			<form id="filedrop" method="post" action="/manage/upload" class="dropzone" enctype="multipart/form-data">
				<input id="userId" type="hidden" value="{{Sentry::getUser()->id}}">
				<div class="fallback">
					<input name="files[]" type="file" multiple=""/>
				</div>
			</form>
		</div>
	</div>
</div>


@stop

@section('scripts')
<script src="/assets/js/dropzone.js"></script>

<script>
// $(document).ready(function($){
// 	$(".lookUpUser").lookUpUser('/allusers', getUserInfo);
// 	$('#owner').focus()
// });


	$( document ).ready(function( $ ) {


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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.7.1/css/dropzone.css" rel="stylesheet" type="text/css"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.7.1/css/basic.css" rel="stylesheet" type="text/css"/>

@stop
