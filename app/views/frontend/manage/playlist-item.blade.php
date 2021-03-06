@foreach($playlists_group as $key => $playlists)
<div class="jaf-row jaf-container">
	@foreach ($playlists as $key => $playlist)
	<div class="folder" id="{{camel_case($playlist['name'].$playlist['id'])}}" style="opacity: 1;">
		<a href="">
			<img src="/assets/img/collection-icon-close.png" alt="">
			<p class="album-name">{{Str::limit($playlist['name'], 18 )}} </p>
		</a>
	</div>
	@endforeach
	<br class="clear">
</div>
@foreach ($playlists as $key => $playlist)
<div id="playlistId-{{$playlist['id']}}" class="folderContent {{camel_case($playlist['name'].$playlist['id'])}}" style="display: none;">
	<div class="jaf-container">
		<div class="row">
			<div class="col-sm-12">
				<div class="assets row">
					<div class="col-sm-9">
						<h2><a href="#" class="editable" data-name="name" data-editable-data="playlist-{{$playlist['id']}}" data-editable-type="text">{{$playlist['name']}}</a></h2>
						<div class="playlist-description-container"><a href="#" class="editable" data-name="description" data-editable-data="playlist-{{$playlist['id']}}" data-editable-type="text">
							@if(isset($playlist['description']))
							{{$playlist['description']}}
							@else
							Add Description
							@endif
						</a></div>
						<div id="playlist-toolbar"  role="toolbar">
							<div class="btn-group ">
								<button class="share-select btn btn-primary " data-toggle="modal" data-target="#playlistShare-{{$playlist['id']}}">Share Playlist ...</button>

								<!-- Playlist Settings ContextMenu -->
								<div class="context-menu-container dropdown keep-open pull-right">

									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-ellipsis-h"></i>
									</button>
									<ul class="dropdown-menu">
										<li>
											@include('frontend.manage.context-menu')
										</li>
									</ul>
								</div>
							</div>
							<!-- / Playlist ContextMenu -->
						</div>


						<div class="col-sm-9 ">
							<table id="cp-{{$collection['id']}}-{{$playlist['id']}}" class="table table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Title</th>
										<th>Description</th>
										<th></th>
									</tr>
								</thead>
								<tbody class="sortable">
									@foreach ($playlist['assets'] as $key => $asset)
									<tr id="cpa-{{$collection['id']}}-{{$playlist['id']}}-{{$asset['id']}}" data-asset-id="{{$asset['id']}}">
										<td width="7px">
											@if($asset['status'] == "transcoded:complete")
											<a class="asset-player-btn" href="#"><i class="fa fa-play-circle-o play-icon"></i></a>
											@else
											<i class="fa fa-clock-o fa-spin"></i>
											@endif
										</td>
										<td><a href="#" class="editable" data-name="title" data-editable-data="asset-{{$asset['id']}}" data-editable-type="text">{{$asset['title']}}</a></td>

										<td>
											<a href="#" class="editable" data-name="description" data-editable-data="asset-{{$asset['id']}}" data-editable-type="text">
												@if(isset($asset['description']))
												{{$asset['description']}}
												@else
												Add Description
												@endif
											</a>
										</td>

										<td>

											<!-- Playlist Assets ContextMenu -->
											<div class="context-menu-container dropdown keep-open pull-right">

												<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
													<i class="fa fa-ellipsis-h"></i>
												</button>
												<ul class="dropdown-menu">
													<li>
														@include('frontend.manage.context-menu')
													</li>
												</ul>

											</div>
											<!-- / ContextMenu -->
										</td>

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

<div class="playlistModal">
<div class="modal fade" id="playlistShare-{{$playlist['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Share This Playlist</h4>
			</div>
			<div class="modal-body">

				<p>Hit <strong>(CTRL/CMD)+C</strong> to copy the link to your clipboard!</p>

				<br>
				<input id="current-playlist-direct-link" class="form-control share-select " type="text" value="{{URL::to('/').'/player/playlist/'.$playlist['id'] }}">
				<br>
				<p>Embed this playlist on your webpage!</p>
				<br>
				<input id="current-playlist-embed-link" class="form-control share-select" type="text" value="<iframe width='800px' height='600px' src='{{URL::to('/').'/player/playlist/'.$playlist['id'] }}' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>">
				<br>
				<i class="fa fa-external-link-square"></i><a href="{{URL::to('/').'/player/playlist/'.$playlist['id'] }}" target="_blank">Preview Here</a>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			</div>
		</div>
	</div>
</div>
</div>
@endforeach
@endforeach
