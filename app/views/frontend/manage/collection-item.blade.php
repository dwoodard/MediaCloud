<header>
	<h2>{{$item->name}}</h2>
	<button class="share btn btn-primary">Share ... </i></button>
</header>



<div class="app-folders-container" style="margin-top: 0px;">
	@foreach($playlists_group as $key => $playlists)






	<div class="jaf-row jaf-container">
		@foreach ($playlists as $key => $playlist)
		<div class="folder" id="{{camel_case($playlist->name)}}" style="opacity: 1;">
			<a href="#">
				<img src="/assets/img/collection-icon-close.png" alt="">
				<p class="album-name">{{$playlist->name}} </p>
			</a>
		</div>
		@endforeach
		<br class="clear">
	</div>


	@foreach ($playlists as $key => $playlist)
	<div class="folderContent {{camel_case($playlist->name)}}" style="display: none; background-color: rgb(224, 232, 233);">
		<div class="jaf-container">
			<div class="row">
				<div class="col-sm-12">
					<div class="assets row">
						<div class="col-sm-12">
							<h2> {{$playlist->name}} </h2>
							<ul>
							@foreach ($playlist->assets as $key => $asset)
								<li><a href="#">{{$asset->name}}</a> </li>
							@endforeach
								
							</ul>

						</div>
					</div>
				</div>
				

			</div>


				<!-- <div class="assets">
					assets
				</div> -->




				<br class="clear">
			</div>

		</div> <!-- /.folderContent -->
		@endforeach

		 

		@endforeach

	</div> <!-- .app-folders-container -->








