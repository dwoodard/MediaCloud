@extends('backend/layouts/admin')

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
			<th>Description</th>
			<!-- <th>Author</th> -->
			<th>Date Created</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>



	<tbody>
		@foreach ($playlists as $playlist)
		<tr>
			<td>{{{ $playlist->name}}}</td>
			<td>{{{ $playlist->description}}}</td>
			<td>{{{ $playlist->created_at}}}</td>
			<td>{{ link_to_route('playlist.edit', 'Edit', array($playlist->id), array('class' => 'btn btn-info')) }}</td>
			<td>
				<form id="delete-{{ $playlist->id}}" method="POST" action="{{action('PlaylistsController@destroy',$playlist->id )}}" accept-charset="UTF-8">
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