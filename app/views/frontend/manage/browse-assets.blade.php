<div class="browse-assets-container">
	<ul>
		@foreach($assets as $key => $asset)
		<li >
			<a href="#" class="asset-player-btn" data-asset-id="{{$asset->id}}"><i class="fa fa-play-circle"></i></a>
			<span class="draggable-asset">{{$asset->title}}</span>
		</li>
		@endforeach
	</ul>
</div>