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
			@foreach ($assets as $asset)
			<tr>

				<td>{{$asset->id}}</td>
				<td>{{$asset->alphaID}}</td>
				<td><a href="/asset/{{$asset->alphaID}}">{{$asset->title}}</a></td>
				<td>{{$asset->description}}</td>
				<td>{{$asset->users}}</td>
				<td>{{$asset->created_at}}</td>
				<td> <a href="" class="btn btn-danger delete" data-asset-id="{{$asset->id}}">Delete</a></td>
			</tr>

			@endforeach
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
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.10/alertify.core.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.10/alertify.default.css">
<link href="/bower/dynatable/jquery.dynatable.css" rel="stylesheet" type="text/css"/>

<style>

</style>

<style>
	#files-assets-contianer{
		margin-top: 101px;
	}

	th a {color: inherit; }
	th a:hover {color: inherit; }

</style>

@stop




@section('scripts')
<script src="/bower/app-folders/index.js"></script>
<script src="/assets/js/manage.js"></script>
<script src="/bower/tag-it/js/tag-it.min.js"></script>
<script src="/bower/underscore/underscore.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.10/alertify.min.js" type="text/javascript"></script>


<script src="/bower/dynatable/jquery.dynatable.js"></script>

<script type="text/javascript">

	$(document).ready(function() {
		$('#userAssets').dynatable();

		$(".btn.delete").on('click', function(e) {
			e.preventDefault();

			var id = $(e.currentTarget).data('assetId');
			var row = $(e.currentTarget).closest('tr')[0];

			alertify.confirm("Whooo are you Sure?! Once it's gone, it ain't comin' back!", function(e){
				if (e) {
					$.ajax({
						url: "/manage/asset/destroy/"+ id,
						type: 'DELETE',
						success: function(data) {
							data = $.parseJSON(data);
							console.log(data);
							if(data.result == "success"){
								$(row).hide('slow');
							}
						}
					});
				}
			});

		})

	} );




	/*
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
	*/
</script>
@stop

