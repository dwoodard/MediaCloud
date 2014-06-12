@extends('frontend/layouts/manage')


@section('content')
<!-- subnav -->
<div id="subnav-container" class="navbar navbar-default navbar-fixed-top">
	<div class="container subnav">

		<ul class="nav nav-pills pull-left">
			<li>
				<a id="subnav-btn-back" href="/manage"> <i class="fa fa-arrow-circle-left"></i> Back</a>
			</li>
		</ul>
	</div>
</div>
<!-- / subnav -->



<div id="files-assets-contianer" class="container">



	<table id="userAssets" class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Alphaid</th>
				<th>Title</th>
				<th>Description</th>
				<th>Users</th>
				<th>Created At</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>

</div>
@stop





@section('style')
<link href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.7.1/css/dropzone.css" rel="stylesheet" type="text/css"/>
<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.7.1/css/basic.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/manage.css" rel="stylesheet" type="text/css"/>
<link href="/bower/tag-it/css/jquery.tagit.css" rel="stylesheet" type="text/css"/>
<link href="//cdn.datatables.net/1.10.0/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.10/alertify.core.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.10/alertify.default.css">

<style>

</style>

<style>
	#files-assets-contianer{
		margin-top: 101px;
	}
</style>

@stop




@section('scripts')
<script src="/bower/app-folders/index.js"></script>
<script src="/assets/js/manage.js"></script>
<script src="/bower/tag-it/js/tag-it.min.js"></script>
<script src="/bower/underscore/underscore.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.10/alertify.min.js" type="text/javascript"></script>


<!-- <script src="/bower/datatables/media/js/jquery.dataTables.js"></script> -->
<script src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>

<script type="text/javascript">

	$(document).ready(function() {

		console.log($(".btn.delete"));

		$dt = $('#userAssets')
		.on( 'init.dt', function (j) {
			$(".btn.delete").on('click', function(e) {
				var row = $(e.currentTarget).closest('tr');
				var id =  parseInt($(e.currentTarget).closest('tr').find('.asset-id').text());





				alertify.confirm("Whooo are you Sure?! Once it's gone, it ain't comin' back!", function (e) {
					if (e) {
						$.ajax({
							url: "/manage/asset/destroy/"+ id,
							type: 'DELETE',
							success: function(data) {
								data = $.parseJSON(data);
								console.log(data);
								if(data.result == "success"){
									row.hide('slow');
								}
							}
						});
					}
				});





			})
		})
		.dataTable( {
			// "processing": true,
			// "serverSide": true,
			"ajax": {
				"url": "/manage/data/user_assets"
			},
			"columns": [
			{"data":"id", "class":"asset-id"},
			{"data":"alphaID"},
			{"data":"title"},
			{"data":"description"},
			{"data":"users[].username"},
			{"data":"created_at"},
			{"data":"", "defaultContent": "<button data-asset-id='id' class='delete btn btn-danger'>Delete!</button>"}
			]
		} );

	} );
</script>
@stop

