


<div id="current-collection" data-current-collection-id="{{$item->id}}">


	<header>
		<h2>{{$item->name}}</h2>
		<button class="share btn btn-primary">Share ... </i></button>
	</header>

	<?php //var_dump($item->assets) ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#playlists-container" data-toggle="tab">Playlists</a></li>
		<li><a href="#assets-container" data-toggle="tab">Assets</a></li>
		<li><a href="#settings-container" data-toggle="tab">Settings</a></li>
		<li><a href="#deployments-container" data-toggle="tab">Deployments</a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="playlists-container">

			<!-- .app-folders-container -->
			<div class="app-folders-container" style="margin-top: 0px;">
				@foreach($playlists_group as $key => $playlists)
				<div class="jaf-row jaf-container">
					@foreach ($playlists as $key => $playlist)
					<div class="folder" id="{{camel_case($playlist->name)}}" style="opacity: 1;">
						<a href="">
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
									<div class="col-sm-9">
										<h2> {{$playlist->name}} </h2>

										<div class="col-sm-9 ">
											<table id="cp-{{$item->id}}-{{$playlist->id}}" class="table table-striped">
												<thead>
													<tr>
														<th></th>
														<th>Title</th>
														<th>Description</th>
													</tr>
												</thead>
												<tbody class="sortable">
													@foreach ($playlist->assets as $key => $asset)
													<tr id="cpa-{{$item->id}}-{{$playlist->id}}-{{$asset->id}}" class="" data-asset-id="{{$asset->id}}">
														<td width="7px"><a class="asset-player-btn" href="#"><i class="fa fa-play-circle-o"></i></a></td>
														<td>{{$asset->name}}</td>
														<td>{{$asset->description}}</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>

									</div>
								</div>
							</div>
						</div>
						<br class="clear">
					</div>

				</div> <!-- /.folderContent -->
				@endforeach
				@endforeach

			</div> <!-- .app-folders-container -->

		</div>
		<div class="tab-pane droppable clearfix" id="assets-container">


			@if(isset($item->assets))
			<div class="col-md-9">
				<table id="cp-{{$item->id}}-0" class="table table-striped">
					<thead>
						<tr>
							<th></th>
							<th>Title</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody class="sortable">
						@foreach ($item->assets as $key => $asset)
						<tr id="cpa-{{$item->id}}-0-{{$asset->id}}" data-asset-id="{{$asset->id}}">
							<td width="7px"><a class="asset-player-btn" href="#"><i class="fa fa-play-circle-o"></i></a></td>
							<td class="col-md-4">{{$asset->name}}</td>
							<td>{{$asset->description}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			@else

			No Assets to load

			@endif



		</div>
		<div class="tab-pane" id="settings-container">Settings</div>
		<div class="tab-pane" id="deployments-container">Deployments</div>
	</div>

</div>

