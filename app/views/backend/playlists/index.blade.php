@extends('backend/layouts/admin')

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
{{Breadcrumbs::render('playlists')}}

<div class="page-header">

	<h1>All Playlists

		<div class="pull-right">
			<a href="{{ URL::route('playlist.create') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i>   Add Playlist</a>
		</div>
	</h1>
</div>


@if (count($playlists) >= 1)
<div class="pull-right">
</div>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<!-- <th>User</th> -->
			<th>Description</th>
			<!-- <th>Author</th> -->
			<th>Date Created</th>
			<th>Actions</th>
		</tr>
	</thead>



	<tbody>
		@foreach ($playlists as $playlist)
		<tr>
			<td> <a href="/player/playlist/{{{ $playlist->id}}}">{{{ $playlist->name}}}</a></td>
			<!-- <td> (will fix soon) </td> -->
			<td>{{{ $playlist->description}}}</td>
			<td>{{{ $playlist->created_at}}}</td>
			<td>
				{{ link_to_route('playlist.edit', 'Edit', array($playlist->id), array('class' => 'btn btn-info')) }}

				<form style="display:inline" id="delete-{{ $playlist->id}}" method="POST" action="{{action('PlaylistsController@destroy',$playlist->id )}}" accept-charset="UTF-8">
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
There are no Playlists
@endif



@stop