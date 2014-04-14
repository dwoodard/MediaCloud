<div class="browse-assets-container">
	
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody >
		@foreach($assets as $key => $asset)
		<tr id="asset-{{$asset->id}}" data-asset-id="{{$asset->id}}" class="draggable-asset">
			<td>
			<a href="#" class="asset-player-btn"><i class="fa fa-play-circle"></i></a>
			{{$asset->title}}
			</td>
			<td>{{$asset->description}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>