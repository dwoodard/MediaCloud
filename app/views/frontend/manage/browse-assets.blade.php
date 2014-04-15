<div class="browse-assets-container">



	<ul>
		@foreach($assets as $key => $asset)
		<li >
			<a  href="#" class="asset-player-btn" data-asset-id="{{$asset->id}}"><i class="fa fa-play-circle"></i></a>
			<span class="draggable-asset">{{$asset->title}}</span>
		</li>
		@endforeach
	</ul>





	<!-- <table class="table table-striped">
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
	</table> -->
</div>