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
<div class="folderContent {{camel_case($playlist['name'].$playlist['id'])}}" style="display: none;">
	<div class="jaf-container">
		<div class="row">
			<div class="col-sm-12">
				<div class="assets row">
					<div class="col-sm-9">
						<h2><a href="#" class="editable" data-name="name" data-editable-data="playlist-{{$playlist['id']}}" data-editable-type="text">{{$playlist['name']}}</a></h2>
						<p><a href="#" class="editable" data-name="description" data-editable-data="playlist-{{$playlist['id']}}" data-editable-type="text">
							@if(isset($playlist['description']))
							{{$playlist['description']}}
							@else
							Add Description
							@endif
						</a></p>
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
											<a class="asset-player-btn" href="#"><i class="fa fa-play-circle-o"></i></a>
											@else
											<i class="fa fa-clock-o fa-spin"></i>
											@endif
										</td>
										<td><a href="#" class="editable" data-name="title" data-editable-data="asset-{{$asset['id']}}" data-editable-type="text">{{$asset['title']}}</a></td>

										<td>
											<a href="#" class="editable" data-name="description" data-editable-data="asset-{{$asset['id']}}" data-editable-type="text">
												@if(isset($asset->description))
												{{$asset['description']}}
												@else
												Add Description
												@endif

											</a>
										</td>

										<td> <a href="#" class="context-menu" data-type="asset"><i class="fa fa-ellipsis-h fa-border"></i></a> </td>

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