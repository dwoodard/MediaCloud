@extends('backend/layouts/default')

@section('content')

<h1>All Assets</h1>

<p>{{ link_to_route('create/asset', 'Add new asset') }}</p>

@if (count($assets) > 1)
{{$assets->appends(array('sort' => 'created_at'))->links(); }}
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Title</th>
				<th>Description</th>
				<th>Filepath</th>
				<th>Filename</th>
				<th>Transcoded_url</th>
				<th>Thumbnail_url</th>
				<th>Url</th>
				<th>Type</th>
				<th>Status</th>
				<th>Tags</th>
				<th>Last_viewed</th>
				<th>Views</th>
				<th>Created_at</th>
				<th>Updated_at</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($assets as $asset)
				<tr>
					<td>{{{ $asset->title }}}</td>
					<td>{{{ $asset->description }}}</td>
					<td>{{{ $asset->filepath }}}</td>
					<td>{{{ $asset->filename }}}</td>
					<td>{{{ $asset->transcoded_url }}}</td>
					<td>{{{ $asset->thumbnail_url }}}</td>
					<td>{{{ $asset->url }}}</td>
					<td>{{{ $asset->type }}}</td>
					<td>{{{ $asset->status }}}</td>
					<td>{{{ $asset->tags }}}</td>
					<td>{{{ $asset->last_viewed }}}</td>
					<td>{{{ $asset->views }}}</td>
					<td>{{{ $asset->created_at }}}</td>
					<td>{{{ $asset->updated_at }}}</td>
                    <td>{{ link_to_route('update/asset', 'Edit', array($asset->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('delete/asset', $asset->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>


@else
	There are no assets
@endif

@stop
