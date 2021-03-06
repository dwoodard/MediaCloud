@extends('backend/layouts/admin')

{{-- Page title --}}
@section('title')
User Management ::
@parent
@stop

@section('scripts')

<script>
	$(document).ready(function() {

		$("[id*='delete-']").click(function(e){
			e.preventDefault()
			btn = $(this);
			url = this.action;
		// confirm dialog
		alertify.confirm("Whooo are you Sure?! Once it's gone, it ain't comin' back!", function (e) {
			if (e) {
				$.ajax({
					url: url,
					type: 'DELETE',
					success: function(data) {
						data = $.parseJSON(data);
						console.log(data);
						if(data.result == "success"){
							$(btn).closest('tr').hide('slow');
						}
					}
				});
			}
		});

		})
	});
</script>
@stop


@section('content')
			   {{Breadcrumbs::render('assets')}}

<div class="page-header">

<h1>All Assets

<div class="pull-right">
			<a href="{{ URL::route('asset.upload') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> Upload</a>
		</div>
</h1>
</div>

@if (count($assets) >= 1)
<div class="pull-right">
{{$assets->appends(array('sort' => 'created_at'))->links(); }}
</div>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>title</th>
				<th>id</th>
				<th>filename</th>
				<th>users</th>
				<!-- <th>filename_original</th> -->
				<th>type</th>
				<th>status</th>
				<th>filesize</th>
				<!-- <th>filepath</th> -->
				<!-- <th>permissions</th> -->
				<!-- <th>last_viewed</th> -->
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($assets as $asset)
				<tr>
					<td>{{{ $asset->title}}}</td>
					<td>{{{ $asset->id}}}</td>
					<td> {{link_to(route('asset.file', $asset->alphaID), $asset->alphaID);}}</td>
					<td>
						@foreach ($asset['users'] as $user)

						<a href="/admin/users/{{$user->id}}/edit">{{{ $user->username}}}</a>

						@endforeach
					</td>
					<td>{{{ $asset->type}}}</td>
					<td>{{{ $asset->status}}}</td>
					<td>{{{ humanFileSize($asset->filesize)}}}</td>
					<!-- <td>{{{ $asset->filepath}}}</td> -->
					<!-- <td>{{{ $asset->permissions}}}</td> -->
					<!-- <td>{{{ $asset->last_viewed}}}</td> -->
					<td>{{ link_to_route('asset.edit', 'Edit', array($asset->id), array('class' => 'btn btn-info')) }}</td>
					<td>
						 <form id="delete-{{ $asset->id}}" method="POST" action="{{action('AssetsController@destroy',$asset->id )}}" accept-charset="UTF-8">
							<input type="hidden" name="_method" value="DELETE" />
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}

						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>


@else
	There are no assets
@endif

@stop
